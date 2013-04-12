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

echo $this->Buro->sform(
	array(), 
	array(
		'model' => $fullModelName,
		'callbacks' => array(
			'onStart' => array('lockForm', 'js' => 'form.setLoading()'),
			'onComplete' => array('unlockForm', 'js' => 'form.unsetLoading()'),
			'onReject' => array('js' => '$("content").scrollTo(); showPopup("error");', 'contentUpdate' => 'replace'),
			'onSave' => array('js' => '$("content").scrollTo(); showPopup("notice");'),
		)
	));
	
	// ID
	echo $this->Buro->input(
		array(),
		array(
			'type' => 'hidden',
			'fieldName' => 'id'
		)
	);
	
	// SPACE
	echo $this->Buro->input(
		array(),
		array(
			'type' => 'mexc_space'
		)
	);
	
	// TITLE
	echo $this->Buro->input(
		array(),
		array(
			'type' => 'text',
			'fieldName' => 'title',
			'label' => __d('mexc_digital_collection', 'form - MexcDigitalCollection.title label', true),
			'instructions' => __d('mexc_digital_collection', 'form - MexcDigitalCollection.title instructions', true)
		)
	);
	
	// ORIGINAL TITLE
	echo $this->Buro->input(
		array(),
		array(
			'type' => 'text',
			'fieldName' => 'title_original',
			'label' => __d('mexc_digital_collection', 'form - MexcDigitalCollection.title_original label', true),
			'instructions' => __d('mexc_digital_collection', 'form - MexcDigitalCollection.title_original instructions', true)
		)
	);
	
	// DATE
	echo $this->Buro->input(
		array(),
		array(
			'fieldName' => 'date',
			'type' => 'datetime',
			'options' => array(
				'dateFormat' => 'DMY',
				'timeFormat' => false,
				'empty' => __d('mexc_digital_collection', 'form - non defined date', true),
				'separator' => '',
				'minYear' => 500,
				'maxYear' => date('Y')+3
			),
			'label' => __d('mexc_digital_collection', 'form - date label', true),
			'instructions' => __d('mexc_digital_collection', 'form - date instructions', true)
		)
	);
	
	// LOCATION
	echo $this->Buro->input(
		array(),
		array(
			'type' => 'relational',
			'label' => __d('mexc_digital_collection', 'form - mexc_digital_collection_location relational label', true),
			'instructions' => __d('mexc_digital_collection', 'form - mexc_digital_collection_location relational instructions', true),
			'options' => array(
				'type' => 'unitaryAutocomplete',
				'model' => 'MexcDigitalCollections.MexcDigcoLocation',
				'queryField' => 'MexcDigcoLocation.title',
			)
		)
	);

	// SUPORTE
	echo $this->Buro->input(
		array(),
		array(
			'type' => 'relational',
			'label' => __d('mexc_digital_collection', 'form - mexc_digital_collection_support relational label', true),
			'instructions' => __d('mexc_digital_collection', 'form - mexc_digital_collection_support relational instructions', true),
			'options' => array(
				'type' => 'unitaryAutocomplete',
				'model' => 'MexcDigitalCollections.MexcDigcoSupport',
				'queryField' => 'MexcDigcoSupport.title',
			)
		)
	);

	//  INSTITUTION HOSTING THE EXPOSITION
	echo $this->Buro->input(
		array(),
		array(
			'type' => 'relational',
			'label' => __d('mexc_digital_collection', 'form - mexc_institution_id relational label', true),
			'instructions' => __d('mexc_digital_collection', 'form - mexc_institution_id relational instructions', true),
			'options' => array(
				'type' => 'unitaryAutocomplete',
				'model' => 'MexcDigitalCollections.MexcDigcoInstitution',
				'queryField' => 'MexcDigcoInstitution.title',
			)
		)
	);

	// RESPONSIBLE INSTITUTION
	echo $this->Buro->input(
		array(),
		array(
			'type' => 'relational',
			'label' => __d('mexc_digital_collection', 'form - mexc_digco_responsible_institution_id relational label', true),
			'instructions' => __d('mexc_digital_collection', 'form - mexc_digco_responsible_institution_id relational instructions', true),
			'options' => array(
				'type' => 'unitaryAutocomplete',
				'model' => 'MexcDigitalCollections.MexcDigcoResponsibleInstitution',
				'queryField' => 'MexcDigcoResponsibleInstitution.title',
			)
		)
	);

	// LANGUAGE
	echo $this->Buro->input(
		array(),
		array(
			'type' => 'relational',
			'label' => __d('mexc_digital_collection', 'form - mexc_digital_collection_language relational label', true),
			'instructions' => __d('mexc_digital_collection', 'form - mexc_digital_collection_language relational instructions', true),
			'options' => array(
				'type' => 'editable_list',
				'model' => 'MexcDigitalCollections.MexcDigcoLanguage',
				'allow' => array('relate', 'create')
			)
		)
	);

	// Palavras-chave
	echo $this->Buro->input(array(), 
		array(
			'type' => 'tags',
			'fieldName' => 'tags',
			'label' => __d('mexc_digital_collection', 'form - tags input label', true),
			'instructions' => __d('mexc_digital_collection', 'form - tags input instructions', true),
			'options' => array(
				'type' => 'comma'
			)
		)
	);
	
	// IMAGE
	echo $this->Buro->input(
		array(),
		array(
			'type' => 'relational',
			'label' => __d('mexc_digital_collection', 'form - digital collection images (relational) label', true),
			'instructions' => __d('mexc_digital_collection', 'form - digital collection images (relational) instructions', true),
			'options' => array(
				'type' => 'many_children',
				'model' => 'MexcDigitalCollections.MexcDigcoImage',
				'title' => __d('mexc_digital_collection', 'form - digital collection image title', true)
			)
		)
	);

	echo $this->Buro->submitBox(array(),array('publishControls' => false));
echo $this->Buro->eform();
