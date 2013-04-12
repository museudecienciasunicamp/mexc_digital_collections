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

/* MexcDigitalCollection Test cases generated on: 2012-01-25 11:01:05 : 1327496405*/
App::import('Model', 'MexcDigitalCollection.MexcDigitalCollection');

class MexcDigitalCollectionTestCase extends CakeTestCase {
	function startTest() {
		$this->MexcDigitalCollection =& ClassRegistry::init('MexcDigitalCollection');
	}

	function endTest() {
		unset($this->MexcDigitalCollection);
		ClassRegistry::flush();
	}

}
?>
