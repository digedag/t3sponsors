<?php

namespace System25\T3sponsors\Frontend\Marker;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2007-2024 Rene Nitzsche (rene@system25.de)
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

use Sys25\RnBase\Domain\Repository\RepositoryRegistry;
use Sys25\RnBase\Frontend\Marker\BaseMarker;
use Sys25\RnBase\Frontend\Marker\ListBuilder;
use Sys25\RnBase\Frontend\Marker\Templates;
use Sys25\RnBase\Search\SearchBase;
use System25\T3sponsors\Model\Sponsor;
use tx_rnbase;

/**
 * Renders categories
 */
class CategoryMarker extends BaseMarker
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
        $subpartArray = [];
        $wrappedSubpartArray = [];

        if (self::containsMarker($template, $marker . '_SPONSORS')) {
            $template = $this->_addSponsors($template, $item, $formatter, $confId . 'sponsor.', $marker . '_SPONSOR');
        }

        $out = Templates::substituteMarkerArrayCached($template, $markerArray, $subpartArray, $wrappedSubpartArray);
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
        $repo = RepositoryRegistry::getRepositoryForClass(Sponsor::class);
        $fields['CATMM.UID_LOCAL'][OP_EQ_INT] = $item->getUid();
        $options = array();
        SearchBase::setConfigFields($fields, $formatter->getConfigurations(), $confId . 'fields.');
        SearchBase::setConfigOptions($options, $formatter->getConfigurations(), $confId . 'options.');
        $children = $repo->search($fields, $options);
        $listBuilder = tx_rnbase::makeInstance(ListBuilder::class);
        $out = $listBuilder->render($children, false, $template, SponsorMarker::class, $confId, $markerPrefix, $formatter);

        return $out;
    }
}
