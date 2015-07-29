<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2006-2015 Rene Nitzsche
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

tx_rnbase::load('tx_rnbase_util_SearchBase');


/**
 * Class to search teams from database
 *
 * @author Rene Nitzsche
 */
class tx_t3sponsors_search_Sponsor extends tx_rnbase_util_SearchBase {

	protected function getTableMappings() {
		$tableMapping = array();
		$tableMapping['SPONSOR'] = 'tx_t3sponsors_companies';
		$tableMapping['CATMM'] = 'tx_t3sponsors_categories_mm';
		$tableMapping['CAT'] = 'tx_t3sponsors_categories';
		$tableMapping['TRADEMM'] = 'tx_t3sponsors_trades_mm';
		$tableMapping['TRADE'] = 'tx_t3sponsors_trades';
		// Hook to append other tables
		tx_rnbase_util_Misc::callHook('t3sponsors','search_Sponsor_getTableMapping_hook',
			array('tableMapping' => &$tableMapping), $this);
		return $tableMapping;
	}

  protected function getBaseTable() {
  	return 'tx_t3sponsors_companies';
  }
	protected function getBaseTableAlias() {return 'SPONSOR';}
  function getWrapperClass() {
  	return 'tx_t3sponsors_models_Sponsor';
  }

  protected function getJoins($tableAliases) {
  	$join = '';
    if(isset($tableAliases['CATMM']) || isset($tableAliases['CAT'])) {
    	$join .= ' LEFT JOIN tx_t3sponsors_categories_mm CATMM ON SPONSOR.uid = CATMM.uid_foreign AND CATMM.tablenames = \'tx_t3sponsors_companies\'';
    }
    if(isset($tableAliases['CAT'])) {
    	$join .= ' LEFT JOIN tx_t3sponsors_categories CAT ON CAT.uid = CATMM.uid_local';
    }
    if(isset($tableAliases['TRADEMM']) || isset($tableAliases['TRADE'])) {
    	$join .= ' LEFT JOIN tx_t3sponsors_trades_mm TRADEMM ON SPONSOR.uid = TRADEMM.uid_foreign AND TRADEMM.tablenames = \'tx_t3sponsors_companies\'';
    }
    if(isset($tableAliases['TRADE'])) {
    	$join .= ' LEFT JOIN tx_t3sponsors_trades TRADE ON TRADE.uid = TRADEMM.uid_local';
    }
    // Hook to append other tables
		tx_rnbase_util_Misc::callHook('t3sponsors','search_Sponsor_getJoins_hook',
			array('join' => &$join, 'tableAliases' => $tableAliases), $this);

    return $join;
  }
	protected function useAlias() {
		return TRUE;
	}
}


if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/t3sponsors/search/class.tx_t3sponsors_search_Sponsor.php']) {
  include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/t3sponsors/search/class.tx_t3sponsors_search_Sponsor.php']);
}
