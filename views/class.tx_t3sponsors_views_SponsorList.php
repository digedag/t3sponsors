<?php
use Sys25\RnBase\Frontend\View\Marker\BaseView;
use Sys25\RnBase\Frontend\Request\RequestInterface;

/***************************************************************
*  Copyright notice
*
*  (c) 2007-2015 Rene Nitzsche (rene@system25.de)
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

tx_rnbase::load ( 'tx_rnbase_view_Base' );
tx_rnbase::load ( 'tx_rnbase_util_BaseMarker' );
tx_rnbase::load ( 'tx_rnbase_util_Templates' );

/**
 * Viewklasse für die Darstellung einer Sponsorenliste
 */
class tx_t3sponsors_views_SponsorList extends BaseView {

	protected function createOutput($template, RequestInterface $request, $formatter)
	{
	    $viewData = $request->getViewContext();
		$markerArray = array();
		$subpartArray = array();
		// Wir holen die Daten von der Action ab
		$items = $viewData->offsetGet('sponsors');
		$filter = $viewData->offsetGet('filter');
		if($filter->hideResult()) {
			$subpartArray['###SPONSORS###'] = '';
			$items = array();
			$template = $filter->getMarker()->parseTemplate($template, $formatter, $request->getConfId().'sponsor.filter.', 'SPONSOR');
		}
		else {
			$listBuilder = tx_rnbase::makeInstance ( 'tx_rnbase_util_ListBuilder' );
			$template = $listBuilder->render($items, $viewData, $template, 'tx_t3sponsors_marker_Sponsor', $request->getConfId().'sponsor.', 'SPONSOR', $formatter );
		}

		if (tx_rnbase_util_BaseMarker::containsMarker ( $template, 'SPONSORMAP' )) {
			$markerArray['###SPONSORMAP###'] = $this->getMap ( $items, $request->getConfigurations(), $request->getConfId() . 'sponsor._map.', 'SPONSOR' );
		}
		$template = tx_rnbase_util_Templates::substituteMarkerArrayCached($template, $markerArray, $subpartArray); //, $wrappedSubpartArray);

		return $template;
	}

	private function getMap($items, $configurations, $confId, $markerPrefix) {
		tx_rnbase::load('tx_rnbase_maps_Factory');
		$ret = '###LABEL_mapNotAvailable###';
		try {
			$map = tx_rnbase_maps_Factory::createGoogleMap($configurations, $confId);
			tx_rnbase::load('tx_rnbase_maps_Util');
			$template = tx_rnbase_maps_Util::getMapTemplate($configurations, $confId);
			if(!$template)
				return 'MAP TEMPLATE NOT FOUND';
			$itemMarker = tx_rnbase::makeInstance('tx_t3sponsors_marker_Sponsor');
			tx_rnbase::load('tx_rnbase_maps_google_Icon');
			tx_rnbase::load('tx_rnbase_maps_DefaultMarker');
			foreach($items As $item) {
				$bubble = tx_rnbase_maps_Util::createMapBubble($item);
				if(!$bubble) continue;
				// Den Inhalt generieren
				$bubbleContent = $itemMarker->parseTemplate($template, $item, $configurations->getFormatter(), $confId.'sponsor.', $markerPrefix);
				$bubble->setDescription($bubbleContent);


// 				tx_rnbase::load('tx_cfcleaguefe_util_Maps');
// 				tx_cfcleaguefe_util_Maps::addIcon($map, $configurations,
// 					$this->getController()->getConfId().'map.icon.clublogo.', $bubble, 'sponsor_'.$item->getUid(), $item->getFirstLogo());
				//$this->addIcon($map, $marker, $item, $configurations);
				$map->addMarker($bubble);
			}
			if($configurations->get($confId.'showBasePoint')) {
				$lng = doubleval($configurations->get($confId.'sponsor._basePosition.longitude'));
				$lat = doubleval($configurations->get($confId.'sponsor._basePosition.latitude'));
				$coords = tx_rnbase::makeInstance('tx_rnbase_maps_Coord');
				$coords->setLongitude($lng);
				$coords->setLatitude($lat);
				$marker = tx_rnbase::makeInstance('tx_rnbase_maps_DefaultMarker');
				$marker->setCoords($coords);
				$marker->setDescription('###LABEL_BASEPOINT###');
				$map->addMarker($marker);
			}

			$ret = $map->draw();
		} catch (Exception $e) {
			$ret = '###LABEL_mapNotAvailable###: '.$e->getMessage();
		}
		return $ret;
	}
	/**
	 * Setzt ein Icon für die Map
	 *
	 * @param tx_rnbase_maps_DefaultMarker $marker
	 * @param tx_cfcleague_models_Club $club
	 * @param tx_rnbase_configurations $configurations
	 */
	private function addIcon($map, &$marker, $club, $configurations) {
		$logo = $club->getFirstLogo();
		if($logo) {
			$imgConf = $configurations->get($this->getController()->getConfId().'map.icon.clublogo.');
			$imgConf['file'] = $logo;
			$url = $configurations->getCObj()->IMG_RESOURCE($imgConf);
			$icon = new tx_rnbase_maps_google_Icon($map);
			$icon->setName('club_'.$club->getUid());

			$height = intval($imgConf['file.']['maxH']);
			$width = intval($imgConf['file.']['maxW']);
			$height = $height ? $height : 20;
			$width = $width ? $width : 20;
			$icon->setImage($url, $width, $height);
			$icon->setShadow($url, $width, $height);
			$icon->setAnchorPoint($width/2, $height/2);
			$marker->setIcon($icon);
		}
	}

	/**
	 * Subpart der im HTML-Template geladen werden soll.
	 * Dieser wird der Methode
	 * createOutput automatisch als $template übergeben.
	 *
	 * @return string
	 */
	function getMainSubpart(&$viewData) {
		return '###SPONSORLIST###';
	}
}
