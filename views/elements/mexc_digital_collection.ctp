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

if (isset($type))
{
	switch ($type[0])
	{
		case 'buro':
			switch ($type[1])
			{
				case 'form':
					echo $this->element('mexc_digital_collection_form', array('plugin' => 'mexc_digital_collections', 'data' => $this->data));
				break;
			}
		break;

		case 'simple_search':
			echo $this->Bl->sbox(array("class" => 'search-button'));
				echo $this->Bl->h5(array(), array(), 'busca');
			echo $this->Bl->ebox();
			echo $this->Bl->sbox(array("class" => 'search-button-categories'));
				$url = array('space' => $currentSpace,'plugin' => 'mexc_digital_collections',
					'controller' => 'mexc_digital_collections', 'action' => 'index');
				foreach ($tagNames as $key => $name)
				{
					echo $this->Bl->anchor(null, array('url' => $url + array('search' => 'advanced','tag' => $key+1)),$name);
					echo " | ";
				}
				echo $this->Bl->anchor(null, array('url' => $url), 'Outros');
			echo $this->Bl->ebox();
			if (empty($this->params['named']['search']))
			echo $this->Bl->sbox(array('id' => 'digco-simple-search', 'class' => 'digital-collection-search-box'), array('size' => array('M' => 12, 'g' => 0, 'm' => 1), 'type' => 'dark_featured'));
				echo $this->Form->create('', array('url' => $url,'type' => 'get'));
					echo $this->Bl->sbox(null, array('size' => array('M' => 9, 'g' => 2, 'm' => 0)));
						echo $this->Form->text('search', array('id' => 'search_input'));
					echo $this->Bl->ebox();
					echo $this->Bl->sbox(null, array('size' => array('M' => 2, 'g' => -1)));
						echo $bl->sbutton(array('class' => 'digital-collection-search-button'));
							echo $this->Bl->span(array('class' => 'digital-collection-search'), null, 'buscar');
							echo $bl->div(array('class' => 'digital-collection-search-icon'));
						echo $bl->ebutton();
					echo $this->Bl->ebox();
							echo $this->Bl->sbox(array('class' => 'search-button'), array('size' => array('M' => 1, 'g' => 1, 'm' => 1)));
							echo $this->Bl->spanDry($this->Bl->anchor(null, array('url' => $this->here . DS . 'search:advanced'),"busca avançada"));
					echo $this->Bl->ebox();
				echo $form->end();
			echo $this->Bl->ebox();
			break;

		case 'advanced_search':
			echo $this->Bl->sbox(array("class" => 'search-button'));
				echo $this->Bl->h5(array(), array(), 'busca avançada');
			echo $this->Bl->ebox();
			echo $this->Bl->sbox(array("class" => 'search-button-categories'));
				$url = array('space' => $currentSpace,'plugin' => 'mexc_digital_collections',
					'controller' => 'mexc_digital_collections', 'action' => 'index',
					'search' => 'advanced');
				foreach ($tagNames as $key => $name)
				{
					echo $this->Bl->anchor(null, array('url' => $url + array('tag' => $key+1)),$name);
					echo " | ";
				}
				echo $this->Bl->anchor(null, array('url' => $url), 'Outros');
			echo $this->Bl->ebox();
			echo $this->Bl->sbox(array('id' => 'digco-advanced-search', 'class' => 'digital-collection-search-box'), array('size' => array('M' => 12, 'g' => -1, 'm' => 2), 'type' => 'dark_featured'));
				echo $this->Bl->sboxContainer(null, array('size' => array('M' => 12, 'g' => -1, 'm' => 2)));
					echo $this->Form->create('', array('url' => $this->here,));
					echo $this->Bl->sbox(null, array('size' => array('M' => 2, 'g' => 2)));
						echo $this->Bl->strongDry(__d('mexc_digital_collection',"Document Title",true));
						echo $this->Form->text('title');
					echo $this->Bl->ebox();
					echo $this->Bl->sbox(null, array('size' => array('M' => 5, 'g' => 2)));
						echo $this->Bl->strongDry(__d('mexc_digital_collection',"form - tags input label",true));
						echo $this->Form->text('tags');
					echo $this->Bl->ebox();
					$supports = array();
					foreach( $supported as $supp)
						$supports[$supp['MexcDigcoSupport']['id']] = $supp['MexcDigcoSupport']['title'];
					echo $this->Bl->sbox(null, array('size' => array('M' => 2, 'g' => 2)));
						echo $this->Bl->strongDry(__d('mexc_digital_collection',"format supported",true));
						echo $this->Form->select('support',$supports);
					echo $this->Bl->ebox();
					echo $this->Bl->floatBreak();
					echo $this->Bl->sbox(null, array('size' => array('M' => 2, 'g' => 2)));
						echo $this->Bl->strongDry(__d('mexc_digital_collection',"Local",true));
						echo $this->Form->text('location');
					echo $this->Bl->ebox();
					echo $this->Bl->sbox(null, array('size' => array('M' => 2, 'g' => 2)));
						echo $this->Bl->strongDry(__d('mexc_digital_collection',"Date",true));
						echo $this->Form->text('date');
					echo $this->Bl->ebox();
					echo $this->Bl->sbox(null, array('size' => array('M' => 2, 'g' => 2)));
						echo $this->Bl->strongDry(__d('mexc_digital_collection',"Instituição",true));
						echo $this->Form->text('institution');
					echo $this->Bl->ebox();
					$langs = array();
					foreach( $languages as $language)
						$langs[$language['MexcDigcoLanguage']['id']] = $language['MexcDigcoLanguage']['title'];
					echo $this->Bl->sbox(null, array('size' => array('M' => 2, 'g' => 2)));
						echo $this->Bl->strongDry(__d('mexc_digital_collection',"Language",true));
						echo $this->Form->select('language', $langs);
					echo $this->Bl->ebox();
					echo $this->Bl->sboxContainer(array('class' => 'search-button'), array('size' => array('M' => 3, 'g' => 1)));
					echo $this->Bl->sbox(null, array('size' => array('M' => 1, 'g' => 1)));
							echo $this->Bl->spanDry($this->Bl->anchor(null, array('url' => array('plugin' => 'mexc_digital_collections',
								'controller' => 'mexc_digital_collections', 'action' => 'index',
								'space' => $currentSpace)),"busca simples"));
						echo $this->Bl->ebox();
						echo $this->Bl->sbox(null, array('size' => array('M' => 1, 'g' => 0)));
							echo $bl->sbutton(array('class' => 'digital-collection-search-button'));
								echo $this->Bl->span(array('class' => 'digital-collection-search'), null, 'buscar');
								echo $bl->div(array('class' => 'digital-collection-search-icon'));
							echo $bl->ebutton();
						echo $this->Bl->ebox();
					echo $this->Bl->eboxContainer();
					echo $form->end();
				echo $this->Bl->eboxContainer();
			echo $this->Bl->ebox();
			break;

		case 'digco_results':
			$date = split('-', $data['MexcDigitalCollection']['date']);
			if (!empty($data['MexcDigcoLocation']['city']))
			{
				if (!empty($data['MexcDigcoLocation']['country']))
				{
					$subtitle = $data['MexcDigcoLocation']['city'].', ' . $data['MexcDigcoLocation']['country'].', ' . $date[0];
				}
				else
				{
					$subtitle = $data['MexcDigcoLocation']['city'].', ' . $date[0];
				}
			}
			else
			{
				$subtitle = $date[0];
			}
 			echo $this->Bl->divDry($this->Bl->smallDry($subtitle));
			$url = array('plugin' => 'mexc_digital_collections',
				'controller' => 'mexc_digital_collections', 'action' => 'read', $data['MexcDigitalCollection']['id'],
				'space' => $data['MexcDigitalCollection']['mexc_space_id']);
			echo $this->Bl->anchor(null, array('url' => $url), $data['MexcDigitalCollection']['title']);

			if (!empty($data['MexcDigcoImage'][0]['image_id']))
			{
				echo $this->Bl->verticalSpacer();
				echo $this->Bl->sanchor(null, array('url' => $url));
					echo $this->Bl->img(array(), array('id' => $data['MexcDigcoImage'][0]['image_id'], 'version' => 'preview'));
				echo $this->Bl->eanchor();
			}
			break;

		case 'full':
			echo $this->Bl->sboxContainer(array('class' => 'digital-collection'), array('size' => array('M' => 12, 'g' => -1, 'm' => -2)));
				echo $this->Bl->sboxContainer(array('class' => 'digital-collection'), array('size' => array('M' => 8, 'g' => -1)));

					$total = count($data['MexcDigcoImage']);
					foreach ($data['MexcDigcoImage'] as $index => $image)
					{
						echo $this->Bl->sbox(array('class' => 'digital-collection-image'), array('size' => array('M' => 8, 'g' => -1)));
							echo $this->Bl->sdiv(array('id' => "digco-image-$index"));
								if ($index > 0)
								{
									echo $this->Bl->span(
										array('class' => 'pagination'), null, 
										$this->Bl->anchor(null, array('url' => "#digco-image-0"), "primeira")
									);
									echo "&ensp;";
									$previous = $index - 1;
									echo $this->Bl->span(
										array('class' => 'pagination'), null, 
										$this->Bl->anchor(null, array('url' => "#digco-image-$previous"), "anterior")
									);
									echo "&ensp;";
								}
								
								//@todo make a better paginator logical
								$midRange = 5;
								for ($i = ($index - $midRange); $i < (($index + $midRange) + 1); $i++){
									if (($i >= 0) && ($i < $total))
									{
										if ($i == $index) 
										{ 
											echo $this->Bl->span(array('class' => 'current'), null, $i+1);
										}
										else 
										{ 
											echo $this->Bl->span(
												array('class' => 'pagination'), null,
												$this->Bl->anchor(
													array('class' => 'current'), 
													array('url' => "#digco-image-$i"),
													$i+1
												)
											);
										}
										echo "&ensp;";
									}
								}
								 
								if ($index < $total-1)
								{
									$next = $index + 1;
									echo $this->Bl->span(
										array('class' => 'pagination'), null, 
										$this->Bl->anchor(
											array('class' => 'current'), 
											array('url' => "#digco-image-$next"), 
										"próximo")
									);
									echo "&ensp;";
									echo $this->Bl->span(
										array('class' => 'pagination'), null, 
										$this->Bl->anchor(
											array('class' => 'current'), 
											array('url' => "#digco-image-".($total-1)), 
										"última")
									);
								}
			
								echo $this->Bl->br();
								echo $this->Bl->sanchor(null, array('url' => $this->Bl->fileURL($image['image_id'], '', false)));
									echo $this->Bl->img(array(), array('id' => $image['image_id'], 'version' => 'full'));
								echo $this->Bl->eanchor();
							echo $this->Bl->ediv();
							$index++;
						echo $this->Bl->ebox();
					}
				echo $this->Bl->eboxContainer();

				echo $this->Bl->small(array('class' => 'digital-collection-box-title'), null, 'Ficha Técnica');

				echo $this->Bl->sbox(array('class' => 'digital-collection-data'), array('size' => array('M' => 4, 'g' => -1, 'm' => -1), 'type' => 'dark_featured'));

					// location and date
					if (!empty($data['MexcDigcoLocation']))
					{
						echo $this->Bl->sbox(array('class' => 'digital-collection-location'), array('size' => array('M' => 3, 'g' => -1, 'm' => -1)));
						$location = array();
						if (!empty($data['MexcDigcoLocation']['city']))
							$location[] = $data['MexcDigcoLocation']['city'];
						if (!empty($data['MexcDigcoLocation']['state']))
							$location[] = $data['MexcDigcoLocation']['state'];
						if (!empty($data['MexcDigcoLocation']['city']))
							$location[] = $data['MexcDigcoLocation']['country'];
							echo $this->Bl->spanDry(implode(', ',$location));
						echo $this->Bl->ebox();
					}

					echo $this->Bl->sbox(array('class' => 'digital-collection-date'), array('size' => array('M' => 1, 'g' => -1, 'm' => -1/2)));
						echo $this->Bl->spanDry($this->Bl->month_year($data['MexcDigitalCollection']['date']));
					echo $this->Bl->ebox();

					// title
					echo $this->Bl->sbox(array('class' => 'digital-collection-content'), array('size' => array('M' => 4, 'g' => -3)));
						echo $this->Bl->paraDry(array($data['MexcDigitalCollection']['title']));
					echo $this->Bl->ebox();

					// title original
					if (strlen($data['MexcDigitalCollection']['title_original'])>0)
					{
						echo $this->Bl->sbox(array('class' => 'digital-collection-content'), array('size' => array('M' => 4, 'g' => -3)));
							echo __d("mexc_digital_collection", "Título Original", false);
							echo $this->Bl->paraDry(array($data['MexcDigitalCollection']['title_original']));
						echo $this->Bl->ebox();
					}

					// responsible institution
					if (!empty($data['MexcDigcoResponsibleInstitution']['title']))
					{
						echo $this->Bl->sbox(array('class' => 'digital-collection-content'), array('size' => array('M' => 4, 'g' => -3)));
							echo __d("mexc_digital_collection", "Responsible Institution", false);
							echo $this->Bl->paraDry(array($data['MexcDigcoResponsibleInstitution']['title']));
						echo $this->Bl->ebox();
					}

					// institution
					if (!empty($data['MexcDigcoInstitution']['title']))
					{
						echo $this->Bl->sbox(array('class' => 'digital-collection-content'), array('size' => array('M' => 4, 'g' => -3)));
							echo __d("mexc_digital_collection", "Institution", false);
							echo $this->Bl->paraDry(array($data['MexcDigcoInstitution']['title']));
						echo $this->Bl->ebox();
					}

					// support and language
					if (!empty($data['MexcDigcoSupport']['title']))
					{
						echo $this->Bl->sbox(array('class' => 'digital-collection-content'), array('size' => array('M' => 2)));
							echo __d("mexc_digital_collection", "Support", false);
							echo $this->Bl->paraDry(array($data['MexcDigcoSupport']['title']));
						echo $this->Bl->ebox();
					}

					if (!empty($data['MexcDigcoLanguage']))
					{
						echo $this->Bl->sbox(null, array('size' => array('M' => 1, 'g' => 1, 'm' => -1)));
							echo $this->Bl->sbox(array('class' => 'digital-collection-content'));
								echo __d("mexc_digital_collection", "Languages", false);
								foreach ($data['MexcDigcoLanguage'] as $key => $language)
								{
									echo $this->Bl->paraDry(array($language['title']));

								}
							echo $this->Bl->ebox();
						echo $this->Bl->ebox();
					}

					if (!empty($data['Tag']))
					{
						echo $this->Bl->sbox(array('class' => 'digital-collection-content'), array('size' => array('M' => 4, 'g' => -3)));
							echo __d("mexc_digital_collection", "Keywords", false);
							foreach ($data['Tag'] as $key => $tag)
							{
								echo $this->Bl->paraDry(array($tag['name']));

							}
						echo $this->Bl->ebox();
					}
				echo $this->Bl->ebox();

			echo $this->Bl->eboxContainer();
			break;
	}
}
