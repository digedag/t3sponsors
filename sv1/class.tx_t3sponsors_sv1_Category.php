<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2009-2012 Rene Nitzsche (rene@system25.de)
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
tx_rnbase::load('tx_rnbase_util_DB');


/**
 * Service for accessing category information
 *
 * @author Rene Nitzsche
 */
class tx_t3sponsors_sv1_Category extends t3lib_svbase {

	/**
	 * Search database for teams
	 *
	 * @param array $fields
	 * @param array $options
	 * @return array[tx_t3sponsors_models_Category]
	 */
	public function search($fields, $options) {
		tx_rnbase::load('tx_rnbase_util_SearchBase');
		$searcher = tx_rnbase_util_SearchBase::getInstance('tx_t3sponsors_search_Category');
		return $searcher->search($fields, $options);
	}

}


if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/t3sponsors/sv1/class.tx_t3sponsors_sv1_Category.php']) {
  include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/t3sponsors/sv1/class.tx_t3sponsors_sv1_Category.php']);
}
