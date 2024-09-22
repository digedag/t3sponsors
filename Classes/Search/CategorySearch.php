<?php

namespace System25\T3sponsors\Search;

use Sys25\RnBase\Database\Query\Join;
use Sys25\RnBase\Search\SearchBase;
use System25\T3sponsors\Model\Category;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2009-2024 Rene Nitzsche
 *  Contact: rene@system25.de
 *  All rights reserved
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 ***************************************************************/

/**
 * Class to search categories from database
 *
 * @author Rene Nitzsche
 */
class CategorySearch extends SearchBase
{
    protected function getTableMappings()
    {
        $tableMapping = [];
        $tableMapping['SPONSOR'] = 'tx_t3sponsors_companies';
        $tableMapping['CATMM'] = 'tx_t3sponsors_categories_mm';
        $tableMapping[$this->getBaseTableAlias()] = $this->getBaseTable();
        return $tableMapping;
    }

    protected function getBaseTableAlias()
    {
        return 'CAT';
    }

    protected function getBaseTable()
    {
        return 'tx_t3sponsors_categories';
    }

    public function getWrapperClass()
    {
        return Category::class;
    }

    protected function getJoins($tableAliases)
    {
        $join = [];
        if (isset($tableAliases['CATMM']) || isset($tableAliases['SPONSOR'])) {
            $join[] = new Join('CAT', 'tx_t3sponsors_categories_mm', 'CAT.uid = CATMM.uid_local', 'CATMM');
        }
        if (isset($tableAliases['SPONSOR'])) {
            $join[] = new Join('CATMM', 'tx_t3sponsors_companies', 'SPONSOR.uid = CATMM.uid_foreign', 'SPONSOR');
        }
        return $join;
    }
}
