<?php

/**
 *
 * Copyright 2011-2013, Museu Exploratório de Ciências da Unicamp (http://www.museudeciencias.com.br)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2011-2013, Museu Exploratório de Ciências da Unicamp (http://www.museudeciencias.com.br)
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @link          https://github.com/museudecienciasunicamp/mexc_digital_collections.git Mexc Digital Collections public repository
 */

class MexcDigitalCollectionsController extends MexcDigitalCollectionAppController {

	var $name = 'MexcDigitalCollections';
	var $uses = array('MexcDigitalCollections.MexcDigitalCollection');

	var $paginate = array(
		'MexcDigitalCollection' => array(
			'limit' => 6,
			'contain' => array('MexcDigcoImage' => array('limit' => 1), 'Tag', 'MexcDigcoSupport','MexcDigcoInstitution','MexcDigcoResponsibleInstitution','MexcDigcoLanguage','MexcDigcoLocation'),
		),
		'MexcDigcoImage' => array(
			'limit' => 1,
			'contain' => array('MexcDigitalCollection' => array('Tag', 'MexcDigcoResponsibleInstitution', 'MexcDigcoInstitution',
 		   	'MexcDigcoSupport', 'MexcDigcoLanguage','MexcDigcoLocation'))
		),
	);
 	var $tagNames = array('Museus e centros de ciência', 'Exposições', 'Fornecedores', 'Material Didático');

	function index()
	{
		$this->search();
	}
	
	function results()
	{
		$this->layout = 'ajax';
		$this->search(true);
	}
	
	function search($paginate = false)
	{
		if (!$paginate)
		{
			$this->Session->write('MexcDigitalCollection.language', false);
			$this->Session->write('MexcDigitalCollection.tags', false);
			$this->Session->write('MexcDigitalCollection.conditions', array());
			
			$conditions = $this->MexcSpace->getConditionsForSpaceFiltering($this->currentSpace);

			// in case user click on a tag link it would change the tag input field.
			if ($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($this->params['named']['tag']) &&
				array_key_exists((int)$this->params['named']['tag']-1, $this->tagNames))
			{
				$tags = $this->tagNames[(int)$this->params['named']['tag']-1];
				$this->data = array('MexcDigitalCollection' => array('tags' => $tags)); 
			}

			$this->paginate['MexcDigitalCollection']['joins'] = array();
			if (!empty($this->params['named']['search']))
			{
				$fields = array('title', 'title_original', 'institution', 'tags', 'support', 'language', 'date', 'location');

				foreach($fields as $field)
				{
					if (isset($this->data['MexcDigitalCollection'][$field]))
						${$field} = $this->data['MexcDigitalCollection'][$field]; 
					else
						${$field} = "";
				}
				$relation = 'and';
			}
			else
			{
				if (!empty($this->params['url']['search']))
				{
					$title = $title_original = $institution = $tags = $support = $language = $location = 
						$date = $this->data['MexcDigitalCollection']['search'] = $this->params['url']['search'];
				}
				$relation = 'or';
			}
			$this->Session->write('MexcDigitalCollection.relation', $relation);

			if (!empty($this->params['url']['search']))
			{
				$conditions['or'] = array(
					'MexcDigcoSupport.title' => $support,
					'MexcDigcoInstitution.title' => $institution,
					'MexcDigcoResponsibleInstitution.title' => $institution,
					'MexcDigcoLocation.city' => $location,
					'MexcDigcoLocation.state' => $location,
					'MexcDigcoLocation.country' => $location,
					'MexcDigitalCollection.title LIKE' => "%$title%",
					'MexcDigitalCollection.title_original LIKE' => "%$title_original%",
					'MexcDigitalCollection.date LIKE' => "%$date%", //TODO verify this
				);
			}
			elseif (!empty($this->params['named']['search']))
			{
				if ($support)
					$conditions['and']['MexcDigitalCollection.mexc_digco_support_id'] = $support;
				if (!empty($institution))
				{
					$conditions['and']['or']['MexcDigcoInstitution.title'] = $institution;
					$conditions['and']['or']['MexcDigcoResponsibleInstitution.title'] = $institution;
				}
				if ($location)
				{
					$conditions['and']['or']['MexcDigcoLocation.city'] = $location;
					$conditions['and']['or']['MexcDigcoLocation.state'] = $location;
					$conditions['and']['or']['MexcDigcoLocation.country'] = $location;
				}
				if ($title)
					$conditions['and']['MexcDigitalCollection.title LIKE'] = "%$title%";
				if ($date)
					$conditions['and']['MexcDigitalCollection.date LIKE'] = "%$date%";

			}
			
			$this->Session->write('MexcDigitalCollection.conditions', $conditions);
		}
		else
		{
			$conditions = $this->Session->read('MexcDigitalCollection.conditions');
			$relation = $this->Session->read('MexcDigitalCollection.relation');
			$language = $this->Session->read('MexcDigitalCollection.language');
			$tags = $this->Session->read('MexcDigitalCollection.tags');
		}
		
		if (!empty($this->params['url']['search']) || !empty($this->params['named']['search']))
		{
			if ($tags)
			{
				$this->Session->write('MexcDigitalCollection.tags', $tags);
				
				$this->loadModel('Tags.Tag');
				$foundTags = array();
				$tags = split(',', $tags);
				foreach($tags as $tag)
					$tag = trim($tag);
				if ($tag)
					$foundTags += $this->Tag->find('all', array(
						'recursive' => -1,
						'conditions' => array(
							'Tag.name LIKE' => "%$tag%"
						)
					));
				$tags = $foundTags;
				
				//$this->paginate['MexcDigitalCollection']['group'] = 'MexcDigitalCollection.id';
				$this->paginate['MexcDigitalCollection']['joins'][] = array(
					'table' => 'tagged',
					'alias' => 'Tagged',
					'type' => 'LEFT',
					'conditions' => array(
						'Tagged.foreign_key = MexcDigitalCollection.id',
						'Tagged.model' => $this->MexcDigitalCollection->alias
					)
				);
				
				if (!empty($tags))
					$conditions[$relation]['Tagged.tag_id'] = Set::extract('/Tag/id', $tags);
				
			}

			if ($language)
			{
				if ($relation == 'or')
				{
					$languages = $this->MexcDigitalCollection->MexcDigcoLanguage->find('all', array(
						'recursive' => -1, 'conditions' => array('MexcDigcoLanguage.title LIKE' => "%$language%")
					));
					$conditions[$relation]['MexcDigcoLanguageMexcDigitalCollection.mexc_digco_language_id'] = Set::extract('/MexcDigcoLanguage/id', $languages);
				}
				else
					$conditions[$relation]['MexcDigcoLanguageMexcDigitalCollection.mexc_digco_language_id'] = $language;

				//TODO fix language search
				$this->Session->write('MexcDigitalCollection.language', $language);
				$this->MexcDigitalCollection->bindModel(array('hasMany' => array('MexcDigcoLanguagesMexcDigitalCollection')), false);
				$this->paginate['MexcDigitalCollection']['contain'][] = 'MexcDigcoLanguagesMexcDigitalCollection';
				//$conditions[$relation]['MexcDigcoLanguage.id'] = Set::extract('/MexcDigcoLanguage/id', $language;
				
				$this->paginate['MexcDigitalCollection']['joins'][] = array(
					'table' => 'mexc_digco_languages_mexc_digital_collections',
					'alias' => 'MexcDigcoLanguageMexcDigitalCollection',
					'type' => 'LEFT',
					'conditions' => array(
						'MexcDigcoLanguageMexcDigitalCollection.mexc_digital_collection_id = MexcDigitalCollection.id',
					)
				);
				
			}
		}
		
		
		$this->helpers['Paginator'] = array('ajax' => 'Ajax');
		$this->set('mexcDigitalCollections',$this->paginate('MexcDigitalCollection', $conditions));
		$this->set('supported',$this->MexcDigitalCollection->MexcDigcoSupport->find('all'));
		$this->set('languages',$this->MexcDigitalCollection->MexcDigcoLanguage->find('all'));
		$this->set('tagNames', $this->tagNames);
	}
	
	function read($id = null)
	{
		if (empty($id))
			$this->cakeError('error404');
		
		$conditions = $this->MexcSpace->getConditionsForSpaceFiltering($this->currentSpace);
		$this->MexcDigitalCollection->contain(array('MexcDigcoImage', 'Tag',
			'MexcDigcoSupport','MexcDigcoInstitution','MexcDigcoResponsibleInstitution','MexcDigcoLanguage','MexcDigcoLocation'));
		$mexcDigitalCollection = $this->MexcDigitalCollection->findById($id);
		
		if (empty($mexcDigitalCollection))
			$this->cakeError('error404');
		
		$this->set(compact('mexcDigitalCollection'));
	}
}
?>
