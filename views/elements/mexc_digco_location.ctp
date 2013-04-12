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

switch ($type[0])
{
	case 'buro':
		switch ($type[1])
		{
			case 'form':
				echo $this->element('mexc_digco_location_form', array('plugin' => 'mexc_digital_collections', 'type' => $type));
			break;
			
			case 'view':
				echo $this->Bl->br();
				$location = array();
				if (!empty($data['MexcDigcoLocation']['city']))
					$location[] = $data['MexcDigcoLocation']['city'];
				if (!empty($data['MexcDigcoLocation']['state']))
					$location[] = $data['MexcDigcoLocation']['state'];
				if (!empty($data['MexcDigcoLocation']['city']))
					$location[] = $data['MexcDigcoLocation']['country'];
				echo $this->Bl->pDry(implode(', ',$location));
				echo $this->Bl->br();
			break;
		}
	break;
	
	case 'full':
	break;
}

