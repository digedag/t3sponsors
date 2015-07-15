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




/**
 * Single view for sponsors
 *
 */
class tx_t3sponsors_actions_SponsorShow extends tx_rnbase_action_BaseIOC {

  /**
   *
   *
   * @param array_object $parameters
   * @param tx_rnbase_configurations $configurations
   * @param array_object $viewData
   * @return string error msg or null
   */
  function handleRequest(&$parameters,&$configurations, &$viewData){

		$this->conf = $configurations;
		$srv = tx_t3sponsors_util_ServiceRegistry::getSponsorService();

		// Im Flexform kann direkt ein Sponsor ausgwählt werden
		$itemId = intval($configurations->get('sponsorshow.sponsorid'));
		if(!$itemId) {
			// Alternativ ist eine Parameterübergabe möglich
			$itemId = intval($parameters->offsetGet('sponsor'));
		}
		if(!intval($itemId)) {
			return 'Sorry, no item-id found.';
		}
		$item = tx_rnbase::makeInstance('tx_t3sponsors_models_Sponsor', $itemId);

		$viewData->offsetSet('sponsor', $item);
		return null;
  }

  function getTemplateName() { return 'sponsorshow';}
	function getViewClassName() { return 'tx_t3sponsors_views_SponsorShow';}

}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/t3sponsors/actions/class.tx_t3sponsors_actions_SponsorShow.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/t3sponsors/actions/class.tx_t3sponsors_actions_SponsorShow.php']);
}
?>