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

class MexcDigcoLocation extends MexcDigitalCollectionsAppModel {
	var $name = 'MexcDigcoLocation';
	var $displayField = 'city';

	var $validate = array(
		'city' => 'notEmpty',
		'country' => 'notEmpty',
	);

	function findBurocrataAutoComplete($data)
	{
		if (empty($data['autocomplete'][$this->name][$this->displayField]))
			return array();

		$data = $this->find('all', array('conditions' => array(
			'OR' => array(
				'city LIKE' => '%'.$data['autocomplete'][$this->name][$this->displayField].'%',
				'state LIKE' => '%'.$data['autocomplete'][$this->name][$this->displayField].'%',
				'country LIKE' => '%'.$data['autocomplete'][$this->name][$this->displayField].'%',
			),
		)));
		$locations = array();
		foreach ($data as $key => $mexcLocation)
		{
			$location = array();
			if (!empty($mexcLocation[$this->name]['city']))
				$location[] = $mexcLocation[$this->name]['city'];
			if (!empty($mexcLocation[$this->name]['state']))
				$location[] = $mexcLocation[$this->name]['state'];
			if (!empty($mexcLocation[$this->name]['city']))
				$location[] = $mexcLocation[$this->name]['country'];
			$locations[$mexcLocation[$this->name]['id']] = implode(', ', $location);
		}
		return $locations;
	}
}
?>
