<?php
namespace System25\T3sponsors\Frontend\Action;

use Sys25\RnBase\Frontend\Controller\AbstractAction;
use Sys25\RnBase\Frontend\Request\RequestInterface;
use System25\T3sponsors\Frontend\View\SponsorShowView;
use System25\T3sponsors\Model\Sponsor;
use tx_rnbase;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2009-2024 Rene Nitzsche (rene@system25.de)
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

/**
 * Single view for sponsors
 */
class SponsorShow extends AbstractAction
{

    /**
     *
     * @param array_object $parameters
     * @param tx_rnbase_configurations $configurations
     * @param array_object $viewData
     * @return string error msg or null
     */
    protected function handleRequest(RequestInterface $request)
    {
        $configurations = $request->getConfigurations();
        $parameters = $request->getParameters();
        $viewData = $request->getViewContext();

        // Im Flexform kann direkt ein Sponsor ausgwählt werden
        $itemId = intval($configurations->get('sponsorshow.sponsorid'));
        if (! $itemId) {
            // Alternativ ist eine Parameterübergabe möglich
            $itemId = $parameters->getInt('sponsor');
        }
        if (! intval($itemId)) {
            return 'Sorry, no item-id found.';
        }
        $item = tx_rnbase::makeInstance(Sponsor::class, $itemId);

        $viewData->offsetSet('sponsor', $item);
        return null;
    }

    protected function getTemplateName()
    {
        return 'sponsorshow';
    }

    protected function getViewClassName()
    {
        return SponsorShowView::class;
    }
}
