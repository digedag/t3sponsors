<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2007-2018 Rene Nitzsche (rene@system25.de)
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
tx_rnbase::load('tx_rnbase_view_Base');
tx_rnbase::load('tx_rnbase_util_BaseMarker');
tx_rnbase::load('tx_rnbase_util_Templates');

/**
 * View class for sponsor details
 */
class tx_t3sponsors_views_SponsorShow extends tx_rnbase_view_Base
{

    public function createOutput($template, &$viewData, &$configurations, &$formatter)
    {
        // Wir holen die Daten von der Action ab
        $sponsor = $viewData->offsetGet('sponsor');
        $marker = tx_rnbase::makeInstance('tx_t3sponsors_marker_Sponsor');

        $template = $marker->parseTemplate($template, $sponsor, $formatter, 'sponsorshow.sponsor.', 'SPONSOR');

        $markerArray = $subpartArray = $wrappedSubpartArray = [];
        $params = [];
        $params['confid'] = $this->getController()->getConfId();
        $params['marker'] = $marker;
        $params['sponsor'] = $sponsor;
        tx_rnbase_util_BaseMarker::callModules($template, $markerArray, $subpartArray, $wrappedSubpartArray, $params, $formatter);
        $out = tx_rnbase_util_Templates::substituteMarkerArrayCached($template, $markerArray, $subpartArray, $wrappedSubpartArray);

        return $out;
    }

    /**
     * Subpart der im HTML-Template geladen werden soll.
     * Dieser wird der Methode
     * createOutput automatisch als $template übergeben.
     *
     * @return string
     */
    public function getMainSubpart(&$viewData)
    {
        return '###SPONSORDETAILS###';
    }
}
