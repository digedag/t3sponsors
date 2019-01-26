<?php
use Sys25\RnBase\Frontend\Controller\AbstractAction;
use Sys25\RnBase\Frontend\Request\RequestInterface;

/***************************************************************
*  Copyright notice
*
*  (c) 2009-2017 Rene Nitzsche (rene@system25.de)
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
class tx_t3sponsors_actions_SponsorList extends AbstractAction {

	/**
	 *
	 *
	 * @param RequestInterface $request
	 * @return string error msg or null
	 */
	protected function handleRequest(RequestInterface $request)
	{
        $configurations = $request->getConfigurations();
		$srv = tx_t3sponsors_util_ServiceRegistry::getSponsorService();
		$filter = tx_rnbase_filter_BaseFilter::createFilter($request->getParameters(), $configurations, $request->getViewContext(), $this->getConfId(). 'sponsor.filter.');
		$fields = array();
		$options = array();
		$filter->init($fields, $options);

		$service = tx_t3sponsors_util_ServiceRegistry::getSponsorService();
		$cfg = array();
		$cfg['colname'] = 'name1';
		$cfg['searchcallback'] = array($service, 'search');
		tx_rnbase_filter_BaseFilter::handleCharBrowser($configurations, $this->getConfId().'sponsor.charbrowser', $request->getViewContext(), $fields, $options, $cfg);
		tx_rnbase_filter_BaseFilter::handlePageBrowser($configurations, $this->getConfId().'sponsor.pagebrowser', $request->getViewContext(), $fields, $options, $cfg);

		$sponsors = $srv->search($fields, $options);
		$request->getViewContext()->offsetSet('sponsors', $sponsors);
		return null;
	}

	protected function getTemplateName() { return 'sponsorlist';}
	protected function getViewClassName() { return 'tx_t3sponsors_views_SponsorList';}
}

