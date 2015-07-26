<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2009-2015 Rene Nitzsche (rene@system25.de)
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


tx_rnbase::load('tx_rnbase_action_BaseIOC');
tx_rnbase::load('tx_rnbase_filter_BaseFilter');
tx_rnbase::load('tx_rnbase_util_TYPO3');

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
	protected function handleRequest(&$parameters,&$configurations, &$viewdata){
		$srv = tx_t3sponsors_util_ServiceRegistry::getSponsorService();
		$filter = tx_rnbase_filter_BaseFilter::createFilter($parameters, $configurations, $viewdata, $this->getConfId(). 'sponsor.filter.');
		$fields = array();
		$options = array();
		$filter->init($fields, $options);

		$service = tx_t3sponsors_util_ServiceRegistry::getSponsorService();
		$cfg = array();
		$cfg['colname'] = 'name1';
		$cfg['searchcallback'] = array($service, 'search');
		tx_rnbase_filter_BaseFilter::handleCharBrowser($configurations, $this->getConfId().'sponsor.charbrowser', $viewdata, $fields, $options, $cfg);
		tx_rnbase_filter_BaseFilter::handlePageBrowser($configurations, $this->getConfId().'sponsor.pagebrowser', $viewdata, $fields, $options, $cfg);

  	$sponsors = $srv->search($fields, $options);
		$viewdata->offsetSet('sponsors', $sponsors);
		return null;
	}

	function getTemplateName() { return 'sponsorlist';}
	function getViewClassName() { return 'tx_t3sponsors_views_SponsorList';}
}

if (!tx_rnbase_util_TYPO3::isTYPO60OrHigher() && defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/t3sponsors/actions/class.tx_t3sponsors_actions_SponsorList.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/t3sponsors/actions/class.tx_t3sponsors_actions_SponsorList.php']);
}
