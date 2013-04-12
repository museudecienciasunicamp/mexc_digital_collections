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

	echo $this->Bl->sbox(array('class' => 'digital-collection'), array('size' => array('M' => 12, 'g' => -1), 'type' => 'cloud'));
		
		echo $this->Bl->h2Dry('acervo digital');
		if (empty($this->params['named']['search']))
			echo $this->Jodel->insertModule('MexcDigitalCollections.MexcDigitalCollection', array('simple_search'));
		else
			echo $this->Jodel->insertModule('MexcDigitalCollections.MexcDigitalCollection', array('advanced_search'));
		
		echo $this->Bl->sdiv(array('id' => 'digco_results'), array());
			echo $this->Bl->sboxContainer(array('class' => 'digital-collection-pagination-numbers'),array('size' => array('M' => 12, 'g' => -2)));
				echo $this->Bl->sdiv(array('class' => 'results'), array());
					if ($mexcDigitalCollections && count($mexcDigitalCollections))
						echo $this->Paginator->counter('Mostrando resultados de %start% a %end% de %count% para a busca.');
					else
						echo $this->Bl->spanDry("Essa busca não obteve resultados.");
				echo $this->Bl->ediv();
					
				echo $this->element('pagination', array('modules' => 6));
				echo $this->Bl->floatBreak();
			echo $this->Bl->eboxContainer();

			echo $this->Bl->hr();

			echo $this->Bl->sboxContainer(array(), array('size' => array('M' => 12), 'type' => 'column_container'));
				$index = 0;
				if ($mexcDigitalCollections)
				foreach ($mexcDigitalCollections as $digco)
				{
					if (!empty($digco['MexcDigitalCollection']))
					{
						echo $this->Bl->sbox(array('class' => 'inner_column one_piece'),array('size' => array('M' => 4, 'g' => -1, 'm' => -2)));
							echo $this->Jodel->insertModule('MexcDigitalCollections.MexcDigitalCollection', array('digco_results'), $digco);
						echo $this->Bl->ebox();
						if ($index % 3 == 2 && $digco != end($mexcDigitalCollections))
						{
							echo $this->Bl->eboxContainer();
							echo $this->Bl->floatBreak();
							echo $this->Bl->verticalSpacer();
							echo $this->Bl->hr();
							echo $this->Bl->sboxContainer(array(), array('size' => array('M' => 12), 'type' => 'column_container'));
						}
						elseif ($index % 3 == 2)
							echo $this->Bl->sboxContainer(array(), array('size' => array('M' => 12), 'type' => 'column_container'));
						$index++;
					}
				}
			echo $this->Bl->eboxContainer();
			echo $this->Bl->floatBreak();
			echo $this->Bl->verticalSpacer();
			echo $this->Bl->ediv();
			echo $this->element('pagination');
			echo $this->Bl->floatBreak();
		echo $this->Bl->ediv();
	echo $this->Bl->ebox();
	echo $this->Bl->br();


