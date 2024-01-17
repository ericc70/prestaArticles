<?php

declare(strict_types=1);

namespace Ericc70\Openarticles\Grid\Filters;

use Ericc70\Openarticles\Grid\Definition\Factory\ArticleDefinitionFactory;
use PrestaShop\PrestaShop\Core\Search\Filters;

class ArticleFilters extends Filters
{



    protected $filterId = ArticleDefinitionFactory::GRID_ID;

    public static function getDefaults()
    {

        return [
            'limit' => 10,
            'offset' => 0,
            'sortBy' => 'id',
            'sortOrder' => 'asc',
            'filters' => [],

        ];
    }
}
