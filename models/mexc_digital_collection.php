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

class MexcDigitalCollection extends MexcDigitalCollectionsAppModel
{
	var $name = 'MexcDigitalCollection';

	var $displayField = 'title';

	var $actsAs = array(
		'Containable',
		'Dashboard.DashDashboardable', 
		'Status.Status' => array('publishing_status'),
		//'JjMedia.StoredFileHolder' => array('image_id'),
		'Tags.Taggable' => array(
			'separator' => ',',
			'field' => 'tags',
			'tagAlias' => 'Tag',
			'tagClass' => 'Tags.Tag',
			'taggedClass' => 'Tags.Tagged',
			'foreignKey' => 'foreign_key',
			'associationForeignKey' => 'tag_id',
			'automaticTagging' => true,
			'unsetInAfterFind' => false,
			'resetBinding' => false,
		)
	);
	
	var $hasAndBelongsToMany = array(
		'MexcDigitalCollections.MexcDigcoLanguage'
	);

	var $hasMany = array(
		'MexcDigitalCollections.MexcDigcoImage'
	);

	var $belongsTo = array(
		'MexcSpace.MexcSpace',
		'MexcDigitalCollections.MexcDigcoSupport',
		'MexcDigitalCollections.MexcDigcoInstitution',
		'MexcDigitalCollections.MexcDigcoResponsibleInstitution',
		'MexcDigitalCollections.MexcDigcoLocation'
	);


/** 
 * Make some adjustments before saving.
 * 
 * @access public
 * @return The result of parent::save method
 */
	function save($data = null, $validate = true, $fieldList = array())
	{
		// arrumar o $data[$this->alias]['date'], que chega em forma de array
		if (empty($data[$this->alias]['date']['day']))
			$data[$this->alias]['date']['day'] = '00';
		if (empty($data[$this->alias]['date']['month']))
			$data[$this->alias]['date']['month'] = '00';
		return parent::save($data, $validate, $fieldList);
	}

/** 
 * Creates a blank row in the table. It is part of the backstage contract.
 * 
 * @access public
 * @return The result of save method
 */
	function createEmpty()
	{
		$data = array();
		$data[$this->alias]['publishing_status'] = 'draft';
		return $this->save($data, false);
	}
	
/** 
 * The data that must be saved into the dashboard. Part of the Dashboard contract.
 *
 * @access public
 * @return array 
 */	
	function getDashboardInfo($id)
	{
		$this->contain();
		$data = $this->findById($id);
		
		if (empty($data))
			return null;
		
		$dashdata = array(
			'dashable_id' => $data[$this->alias][$this->primaryKey],
			'mexc_space_id' => $data[$this->alias]['mexc_space_id'],
			'dashable_model' => $this->name,
			'type' => 'digital_collection',
			'status' => $data[$this->alias]['publishing_status'],
			'created' => $data[$this->alias]['created'],
			'modified' => $data[$this->alias]['modified'], 
			'name' => $data[$this->alias]['title'],
			'info' => $data[$this->alias]['title_original'],
			'idiom' => array()
		);
		
		return $dashdata;
	}
}
