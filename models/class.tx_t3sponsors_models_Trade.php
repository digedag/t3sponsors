<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2015 Rene Nitzsche (rene@system25.de)
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/


// Die Datenbank-Klasse
//require_once(t3lib_extMgm::extPath('rn_base') . 'util/class.tx_rnbase_util_DB.php'); // Prüfen

tx_rnbase::load('tx_rnbase_util_DB');
tx_rnbase::load('tx_rnbase_model_base');


/**
 */
class tx_t3sponsors_models_Trade extends tx_rnbase_model_base {

  function getTableName(){return 'tx_t3sponsors_trades';}

}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/t3sponsors/models/class.tx_t3sponsors_models_Trade.php']) {
  include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/t3sponsors/models/class.tx_t3sponsors_models_Trade.php']);
}
