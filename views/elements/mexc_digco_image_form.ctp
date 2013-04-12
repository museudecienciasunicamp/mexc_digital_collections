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
			'model' => 'MexcDigitalCollections.MexcDigcoImage'
		)
	);
	
	echo $this->Buro->input(
		array(),
		array(
			'fieldName' => 'id',
			'type' => 'hidden'
		)
	);
	
	echo $this->Buro->input(
		array(),
		array(
			'fieldName' => 'image_id',
			'type' => 'image',
			'options' => array(
				'version' => 'backstage_preview'
			),
			'label' => __d('mexc_digital_collection_image', 'form - image_id (upload) label', true),
			'instructions' => __d('mexc_digital_collection_image', 'form - image_id (upload) instructions', true)
		)
	);
	
	echo $this->Buro->submit(
		array(),
		array(
			'label' => __d('mexc_digital_collection_image', 'save button label', true),
			'cancel' => array(
				'label' => __d('mexc_digital_collection_image', 'cancel link label', true)
			)
		)
	);
	
echo $this->Buro->eform();

