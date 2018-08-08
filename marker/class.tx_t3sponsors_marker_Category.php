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
tx_rnbase::load('tx_rnbase_util_BaseMarker');
tx_rnbase::load('tx_rnbase_util_Templates');

/**
 * Renders categories
 */
class tx_t3sponsors_marker_Category extends tx_rnbase_util_BaseMarker
{

    /**
     *
     * @param string $template
     *            das HTML-Template
     * @param tx_t3sponsors_models_Category $item
     *            category
     * @param tx_rnbase_util_FormatUtil $formatter
     *            der zu verwendente Formatter
     * @param string $confId
     *            Pfad der TS-Config des Vereins, z.B. 'listView.club.'
     * @param array $links
     *            Array mit Link-Instanzen, wenn Verlinkung möglich sein soll. Zielseite muss vorbereitet sein.
     * @param string $marker
     *            name of marker, z.B. CLUB
     *            Von diesem String hängen die entsprechenden weiteren Marker ab: ###CLUB_NAME###, ###COACH_ADDRESS_WEBSITE###
     * @return String das geparste Template
     */
    public function parseTemplate($template, &$item, &$formatter, $confId, $marker = 'CATEGORY')
    {
        if (! is_object($item)) {
            // On default use an empty instance.
            $item = self::getEmptyInstance('tx_t3sponsors_models_Category');
        }

        // Es wird das MarkerArray gefüllt.
        $markerArray = $formatter->getItemMarkerArrayWrapped($item->getProperty(), $confId, 0, $marker . '_', $item->getColumnNames());

        if (self::containsMarker($template, $marker . '_SPONSORS')) {
            $template = $this->_addSponsors($template, $item, $formatter, $confId . 'sponsor.', $marker . '_SPONSOR');
        }

        $out = tx_rnbase_util_Templates::substituteMarkerArrayCached($template, $markerArray, $subpartArray, $wrappedSubpartArray);
        return $out;
    }

    /**
     *
     * @param string $template
     * @param tx_t3sponsors_models_Category $item
     * @param tx_rnbase_util_FormatUtil $formatter
     * @param string $confId
     * @param string $markerPrefix
     * @return string
     */
    protected function _addSponsors($template, &$item, &$formatter, $confId, $markerPrefix)
    {
        $srv = tx_t3sponsors_util_ServiceRegistry::getSponsorService();
        $fields['CATMM.UID_LOCAL'][OP_EQ_INT] = $item->getUid();
        $options = array();
        tx_rnbase_util_SearchBase::setConfigFields($fields, $formatter->getConfigurations(), $confId . 'fields.');
        tx_rnbase_util_SearchBase::setConfigOptions($options, $formatter->getConfigurations(), $confId . 'options.');
        $children = $srv->search($fields, $options);
        $listBuilder = tx_rnbase::makeInstance('tx_rnbase_util_ListBuilder');
        $out = $listBuilder->render($children, false, $template, 'tx_t3sponsors_marker_Sponsor', $confId, $markerPrefix, $formatter);
        return $out;
    }
}
