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

if (!isset($modules)) $modules = 12;

$url = array(
	'controller' => 'mexc_digital_collections', 
	'plugin' => 'mexc_digital_collections', 
	'space' =>'acervo', 
	'action' => 'results'
);

if (isset($this->params['url']['search']) || isset($this->params['named']['search']))
{
	if (isset($this->params['url']['url']))
	{
		unset($this->params['url']['url']);
	}
	if (isset($this->params['url']['search']))
		$url = am($url + array('?' => $this->params['url']));
	else
		$url = am($url + array('search' => $this->params['named']['search']));
}

if (!empty($currentSpace))
{
	$this->Paginator->options(
		array(
			'update'=>'digco_results', 
			'url'=> $url,
		)
	); 
}
echo $this->Bl->sboxContainer(array('class' => 'pagination'), array('size' => array('M' => $modules), 'type' => 'column_container'));
	echo $this->Bl->sbox(array(), array());
		$current = $this->Paginator->current();
		if ($this->Paginator->hasPrev())
		{
				if (!isset($labels['prev']))
					$labels['prev'] = __d('mexc','anterior', true);
				echo $this->Paginator->prev($labels['prev']);
				echo $this->Bl->spanDry("&emsp;");
		}
		
			echo $this->Bl->spanDry($this->Paginator->numbers(array('separator' => '&emsp;')));

		if ($this->Paginator->hasNext())
		{
			if (!isset($labels['next']))
				$labels['next'] = __d('mexc','próximo', true);
				
			echo $this->Bl->spanDry("&emsp;");
			echo $this->Paginator->next($labels['next']);
		}
	echo $this->Bl->ebox();
echo $this->Bl->eboxContainer();

