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

echo $this->Bl->sbox(array(), array('size' => array('M' => 12, 'g' => -1), 'type' => 'cloud'));
	
	echo $this->Bl->anchor(
		array('class' => 'fact_link_search'),
		array('url' => array('plugin' => 'mexc_digital_collections',
		'controller' => 'mexc_digital_collections',
		'action' => 'index', 'space' => $currentSpace)),
						'Voltar para busca'
	);
	echo $this->Bl->floatBreak();

	echo $this->Bl->h2Dry('documento');
	
	if (count($mexcDigitalCollection) > 0)
		echo $this->Jodel->insertModule('MexcDigitalCollections.MexcDigitalCollection', array('full'), $mexcDigitalCollection);
	
echo $this->Bl->ebox();

echo $this->Bl->br();


