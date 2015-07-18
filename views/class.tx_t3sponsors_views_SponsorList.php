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


tx_rnbase::load('tx_rnbase_view_Base');
tx_rnbase::load('tx_rnbase_util_BaseMarker');
tx_rnbase::load('tx_rnbase_util_Templates');


/**
 * Viewklasse für die Darstellung einer Sponsorenliste
 */
class tx_t3sponsors_views_SponsorList extends tx_rnbase_view_Base {

  function createOutput($template, &$viewData, &$configurations, &$formatter) {
  	// Wir holen die Daten von der Action ab
    $sponsors =& $viewData->offsetGet('sponsors');

	  $listBuilder = tx_rnbase::makeInstance('tx_rnbase_util_ListBuilder');

    $template = $listBuilder->render($sponsors,
    								$viewData, $template, 'tx_t3sponsors_marker_Sponsor',
    								'sponsorlist.sponsor.', 'SPONSOR', $formatter);

		return $template;
  }

  /**
   * Subpart der im HTML-Template geladen werden soll. Dieser wird der Methode
   * createOutput automatisch als $template übergeben.
   *
   * @return string
   */
  function getMainSubpart() {
  	return '###SPONSORLIST###';
  }



}


if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/t3sponsors/views/class.tx_t3sponsors_views_SponsorList.php'])
{
  include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/t3sponsors/views/class.tx_t3sponsors_views_SponsorList.php']);
}
?>