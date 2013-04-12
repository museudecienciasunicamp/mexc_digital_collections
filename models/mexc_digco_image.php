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

class MexcDigcoImage extends MexcDigitalCollectionsAppModel
{
	var $name = 'MexcDigcoImage';
	
	var $actsAs = array(
		'Containable',
		'JjMedia.StoredFileHolder' => array('image_id'),
		'JjUtils.Ordered' => array(
			'field' => 'order',
			'foreign_key' => 'mexc_digital_collection_id'
		)
	);
	
	var $belongsTo = array('MexcDigitalCollections.MexcDigitalCollection');
	
	var $validate = array(
		'image_id' => array(
			'rule' => 'notEmpty',
			'required' => true
		),
	);
}

