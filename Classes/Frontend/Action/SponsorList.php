<?php

namespace System25\T3sponsors\Frontend\Action;

use Sys25\RnBase\Frontend\Controller\AbstractAction;
use Sys25\RnBase\Frontend\Filter\BaseFilter;
use Sys25\RnBase\Frontend\Filter\Utility\CharBrowserFilter;
use Sys25\RnBase\Frontend\Filter\Utility\PageBrowserFilter;
use Sys25\RnBase\Frontend\Request\RequestInterface;
use System25\T3sponsors\Frontend\View\SponsorListView;
use System25\T3sponsors\Repository\SponsorRepository;
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
 * Controller to show a sponsor list
 *
 */
class SponsorList extends AbstractAction
{
    private $pageBrowserFilter;
    private $sponsorRepo;

    public function __construct(
        PageBrowserFilter $pageBrowserFilter,
        SponsorRepository $sponsorRepo
    ) {
        $this->pageBrowserFilter = $pageBrowserFilter ?: tx_rnbase::makeInstance(PageBrowserFilter::class);
        $this->sponsorRepo = $sponsorRepo ?: tx_rnbase::makeInstance(SponsorRepository::class);
    }

    /**
     *
     * @param RequestInterface $request
     * @return string error msg or null
     */
    protected function handleRequest(RequestInterface $request)
    {
        $configurations = $request->getConfigurations();
        $filter = BaseFilter::createFilter($request, $this->getConfId(). 'sponsor.filter.');
        $fields = [];
        $options = [];
        $filter->init($fields, $options);

        $cfg = [];
        $cfg['colname'] = 'name1';
        $cfg['searchcallback'] = array($this->sponsorRepo, 'search');
        CharBrowserFilter::handle($configurations, $this->getConfId().'sponsor.charbrowser', $request->getViewContext(), $fields, $options, $cfg);
        $this->pageBrowserFilter->handle($configurations, $this->getConfId().'sponsor.pagebrowser', $request->getViewContext(), $fields, $options, $cfg);

        $sponsors = $this->sponsorRepo->search($fields, $options);
        $request->getViewContext()->offsetSet('sponsors', $sponsors);
        return null;
    }

    protected function getTemplateName()
    {
        return 'sponsorlist';
    }
    protected function getViewClassName()
    {
        return SponsorListView::class;
    }
}
