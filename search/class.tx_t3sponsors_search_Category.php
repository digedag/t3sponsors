<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2009-2017 Rene Nitzsche
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
 * Class to search categories from database
 *
 * @author Rene Nitzsche
 */
class tx_t3sponsors_search_Category extends tx_rnbase_util_SearchBase {

	protected function getTableMappings() {
		$tableMapping['SPONSOR'] = 'tx_t3sponsors_companies';
		$tableMapping['CATMM'] = 'tx_t3sponsors_categories_mm';
		$tableMapping['CAT'] = 'tx_t3sponsors_categories';
		return $tableMapping;
	}

  protected function getBaseTable() {
  	return 'tx_t3sponsors_categories';
  }
  function getWrapperClass() {
  	return 'tx_t3sponsors_models_Category';
  }

  protected function getJoins($tableAliases) {
  	$join = '';
    if(isset($tableAliases['CATMM']) || isset($tableAliases['SPONSOR'])) {
    	$join .= ' JOIN tx_t3sponsors_categories_mm ON tx_t3sponsors_categories.uid = tx_t3sponsors_categories_mm.uid_local';
    }
    if(isset($tableAliases['SPONSOR'])) {
    	$join .= ' JOIN tx_t3sponsors_companies ON tx_t3sponsors_companies.uid = tx_t3sponsors_categories_mm.uid_foreign';
    }
    return $join;
  }
}


if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/t3sponsors/search/class.tx_t3sponsors_search_Category.php']) {
  include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/t3sponsors/search/class.tx_t3sponsors_search_Category.php']);
}

?>