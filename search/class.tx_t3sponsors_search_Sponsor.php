<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2006-2012 Rene Nitzsche
 *  Contact: rene@system25.de
 *  All rights reserved
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 ***************************************************************/

require_once(t3lib_extMgm::extPath('rn_base') . 'class.tx_rnbase.php');

tx_rnbase::load('tx_rnbase_util_SearchBase');


/**
 * Class to search teams from database
 * 
 * @author Rene Nitzsche
 */
class tx_t3sponsors_search_Sponsor extends tx_rnbase_util_SearchBase {

	protected function getTableMappings() {
		$tableMapping['SPONSOR'] = 'tx_t3sponsors_companies';
		$tableMapping['CATMM'] = 'tx_t3sponsors_categories_mm';
		$tableMapping['CAT'] = 'tx_t3sponsors_categories';
		// Hook to append other tables
		tx_rnbase_util_Misc::callHook('t3sponsors','search_Sponsor_getTableMapping_hook',
			array('tableMapping' => &$tableMapping), $this);
		return $tableMapping;
	}

  protected function getBaseTable() {
  	return 'tx_t3sponsors_companies';
  }
  function getWrapperClass() {
  	return 'tx_t3sponsors_models_sponsor';
  }
	
  protected function getJoins($tableAliases) {
  	$join = '';
    if(isset($tableAliases['CATMM']) || isset($tableAliases['CAT'])) {
    	$join .= ' JOIN tx_t3sponsors_categories_mm ON tx_t3sponsors_companies.uid = tx_t3sponsors_categories_mm.uid_foreign AND tx_t3sponsors_categories_mm.tablenames = \'tx_t3sponsors_companies\'';
    }
    if(isset($tableAliases['CAT'])) {
    	$join .= ' JOIN tx_t3sponsors_categories ON tx_t3sponsors_categories.uid = tx_t3sponsors_categories_mm.uid_local';
    }
  	// Hook to append other tables
		tx_rnbase_util_Misc::callHook('t3sponsors','search_Sponsor_getJoins_hook',
			array('join' => &$join, 'tableAliases' => $tableAliases), $this);
    
    return $join;
  }
}


if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/t3sponsors/search/class.tx_t3sponsors_search_Sponsor.php']) {
  include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/t3sponsors/search/class.tx_t3sponsors_search_Sponsor.php']);
}

?>