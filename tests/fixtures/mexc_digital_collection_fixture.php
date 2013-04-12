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

/* MexcDigitalCollection Fixture generated on: 2012-01-25 10:01:26 : 1327496366 */
class MexcDigitalCollectionFixture extends CakeTestFixture {
	var $name = 'MexcDigitalCollection';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'location' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'date' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'title' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'support_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'space_id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 30, 'key' => 'index', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'image_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'institutions_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'indexes' => array('PRIMARY' => array('column' => array('id', 'support_id', 'image_id', 'institutions_id'), 'unique' => 1), 'fk_mexc_digital_collections_mexc_supports1' => array('column' => 'support_id', 'unique' => 0), 'fk_mexc_digital_collections_mexc_spaces1' => array('column' => 'space_id', 'unique' => 0), 'fk_mexc_digital_collections_mexc_digital_collection_images1' => array('column' => 'image_id', 'unique' => 0), 'fk_mexc_digital_collections_mexc_institutions1' => array('column' => 'institutions_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'location' => 'Lorem ipsum dolor sit amet',
			'date' => '2012-01-25 10:59:26',
			'title' => 'Lorem ipsum dolor sit amet',
			'support_id' => 1,
			'space_id' => 'Lorem ipsum dolor sit amet',
			'image_id' => 1,
			'institutions_id' => 1
		),
	);
}
?>
