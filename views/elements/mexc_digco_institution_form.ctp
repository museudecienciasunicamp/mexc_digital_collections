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

echo $this->Buro->sform(array(), array('model' => 'MexcDigitalCollections.MexcDigcoInstitution'));
	echo $this->Buro->input(array(), array('fieldName' => 'id', 'type' => 'hidden'));
	
	// institution title
	echo $this->Buro->input(
		array(),
		array(
			'fieldName' => 'title',
			'type' => 'text',
			'label' => __d('mexc_digital_collection', 'digco institution form - title label', true),
			'instructions' => __d('mexc_digital_collection', 'digco institution form - title instructions', true)
		)
	);

	echo $this->Bl->br();
	
	echo $this->Buro->submit(
		array(),
		array(
			'label' => __d('mexc_digital_collection', 'save button label', true),
			'cancel' => array(
				'label' => __d('mexc_digital_collection', 'cancel link label', true)
			)
		)
	);
	
echo $this->Buro->eform();
echo $this->Bl->floatBreak();
?>


