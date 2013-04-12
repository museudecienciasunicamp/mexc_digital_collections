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

/* MexcDigitalCollections Test cases generated on: 2012-01-25 11:01:14 : 1327497314*/
App::import('Controller', 'MexcDigitalCollection.MexcDigitalCollections');

class TestMexcDigitalCollectionsController extends MexcDigitalCollectionsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class MexcDigitalCollectionsControllerTestCase extends CakeTestCase {
	function startTest() {
		$this->MexcDigitalCollections =& new TestMexcDigitalCollectionsController();
		$this->MexcDigitalCollections->constructClasses();
	}

	function endTest() {
		unset($this->MexcDigitalCollections);
		ClassRegistry::flush();
	}

}
?>
