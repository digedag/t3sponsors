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

tx_rnbase::load('tx_rnbase_action_BaseIOC');
tx_rnbase::load('tx_rnbase_filter_BaseFilter');




/**
 * Controller to show a sponsor list
 * 
 */
class tx_t3sponsors_actions_SponsorList extends tx_rnbase_action_BaseIOC {
	
	/**
	 * 
	 *
	 * @param array_object $parameters
	 * @param tx_rnbase_configurations $configurations
	 * @param array_object $viewData
	 * @return string error msg or null
	 */
	function handleRequest(&$parameters,&$configurations, &$viewData){
		$srv = tx_t3sponsors_util_ServiceRegistry::getSponsorService();

		$filter = tx_rnbase_filter_BaseFilter::createFilter($parameters, $configurations, $viewData, 'sponsorlist.');
		$fields = array();
		$options = array();
		$filter->init($fields, $options, $parameters, $configurations, 'sponsorlist.');
		$this->handleCharBrowser($parameters,$configurations, $viewData, $fields, $options);
		$this->handlePageBrowser($parameters,$configurations, $viewData, $fields, $options);
		
  	$sponsors = $srv->search($fields, $options);
		$viewData->offsetSet('sponsors', $sponsors);
		return null;
	}

	function handlePageBrowser(&$parameters,&$configurations, &$viewdata, &$fields, &$options) {
		if(is_array($configurations->get('sponsorlist.sponsor.pagebrowser.'))) {
			$service = tx_t3sponsors_util_ServiceRegistry::getSponsorService();
			// Mit Pagebrowser benötigen wir zwei Zugriffe, um die Gesamtanzahl der Teams zu ermitteln
			$options['count']= 1;
			$listSize = $service->search($fields, $options);
			unset($options['count']);
			// PageBrowser initialisieren
			$pageBrowser = tx_rnbase::makeInstance('tx_rnbase_util_PageBrowser', 'sponsor');
	  	$pageSize = intval($configurations->get('sponsorlist.sponsor.pagebrowser.limit'));
			$pageBrowser->setState($parameters, $listSize, $pageSize);
			$limit = $pageBrowser->getState();
			// Ist schon ein Limit per TS < PB-Limit gesetzt, dann hat dieses Vorrang
			if(intval($options['limit']) && (intval($options['limit']) < intval($limit['limit'])))
				$limit['limit'] = intval($options['limit']);
			$options = array_merge($options, $limit);
			$viewdata->offsetSet('pagebrowser', $pageBrowser);
		}
	}

	function handleCharBrowser(&$parameters,&$configurations, &$viewData, &$fields, &$options) {
		if($configurations->get('sponsorlist.sponsor.charbrowser')) {
			$srv = tx_t3sponsors_util_ServiceRegistry::getSponsorService();
			$pagerData = $this->findPagerData($srv, $configurations);
			$firstChar = $parameters->offsetGet('charpointer');
			$firstChar = (strlen(trim($firstChar)) > 0) ? substr($firstChar,0,1) : $pagerData['default'];
			$viewData->offsetSet('pagerData', $pagerData);
			$viewData->offsetSet('charpointer', $firstChar);
		}
		$filter = $viewData->offsetGet('filter');
		// Der CharBrowser beachten wir nur, wenn keine Suche aktiv ist
		// TODO: Der Filter sollte eine Methode haben, die sagt, ob ein Formular aktiv ist
		if($firstChar && !$filter->inputData) {
			$specials = tx_rnbase_util_SearchBase::getSpecialChars();
			$firsts = $specials[$firstChar];
			if($firsts) {
				$firsts = implode('\',\'',$firsts);
			}
			else $firsts = $firstChar;

			if($fields[SEARCH_FIELD_CUSTOM]) $fields[SEARCH_FIELD_CUSTOM] .= ' AND ';
			$fields[SEARCH_FIELD_CUSTOM] .= "LEFT(UCASE(name),1) IN ('$firsts') ";;
		}
	}
	/**
	 * Wir verwenden einen alphabetischen Pager. Also muß zunächst ermittelt werden, welche
	 * Buchstaben überhaupt vorkommen.
	 * @param tx_t3sponsors_sv1_Sponsor $service
	 * @param tx_rnbase_configurations $configurations
	 */
	function findPagerData(&$service, &$configurations) {

		$options['what'] = 'LEFT(UCASE(name),1) As first_char, count(LEFT(UCASE(name),1)) As size';
		$options['groupby'] = 'LEFT(UCASE(name),1)';
		$fields = array();
		tx_rnbase_util_SearchBase::setConfigFields($fields, $configurations, 'sponsorlist.fields.');
		tx_rnbase_util_SearchBase::setConfigOptions($options, $configurations, 'sponsorlist.options.');

		$rows = $service->search($fields, $options);

		$specials = tx_rnbase_util_SearchBase::getSpecialChars();
		$wSpecials = array();
		foreach($specials As $key => $special) {
			foreach ($special As $char) {
				$wSpecials[$char] = $key;
			}
		}

		$ret = array();
		foreach($rows As $row) {
			if(array_key_exists(($row['first_char']), $wSpecials)) {
				$ret[$wSpecials[$row['first_char']]] = intval($ret[$wSpecials[$row['first_char']]]) + $row['size'];
			}
			else
				$ret[$row['first_char']] = $row['size'];
		}

		$current = 0;
		if(count($ret)) {
			$keys = array_keys($ret);
			$current = $keys[0];
		}
		$data['list'] = $ret;
		$data['default'] = $current;
		return $data;
	}

	function getTemplateName() { return 'sponsorlist';}
	function getViewClassName() { return 'tx_t3sponsors_views_SponsorList';}
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/t3sponsors/actions/class.tx_t3sponsors_actions_SponsorList.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/t3sponsors/actions/class.tx_t3sponsors_actions_SponsorList.php']);
}

?>