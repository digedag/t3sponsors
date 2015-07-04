<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2007-2012 Rene Nitzsche (rene@system25.de)
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

require_once(t3lib_extMgm::extPath('rn_base') . 'class.tx_rnbase.php');

// Die Datenbank-Klasse
//require_once(t3lib_extMgm::extPath('rn_base') . 'util/class.tx_rnbase_util_DB.php'); // Prüfen

tx_rnbase::load('tx_rnbase_model_base');


/**
 * Model für eine Arbeitsgruppe.
 */
class tx_t3sponsors_models_sponsor extends tx_rnbase_model_base {
  
  function getTableName(){return 'tx_t3sponsors_companies';}

  /**
   * Whether or not the single view is enabled
   *
   * @return boolean
   */
  function hasReport() {
  	return intval($this->record['hasreport']) > 0;
  }
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/t3sponsors/models/class.tx_t3sponsors_models_sponsor.php']) {
  include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/t3sponsors/models/class.tx_t3sponsors_models_sponsor.php']);
}

?>