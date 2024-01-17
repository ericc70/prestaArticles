<?php
declare(strict_types=1);
namespace Ericc70\Openarticles\Grid\Data\Factory;

use PrestaShop\PrestaShop\Core\Grid\Data\Factory\GridDataFactoryInterface;
use PrestaShop\PrestaShop\Core\Grid\GridFactoryInterface;
use PrestaShop\PrestaShop\Core\Grid\Record\RecordCollection;
use PrestaShop\PrestaShop\Core\Grid\Search\SearchCriteriaInterface;
use PrestaShop\PrestaShop\Core\Grid\Data\GridData;

class ArticleGridDataFactory  implements GridDataFactoryInterface
{

    private $gridDataFactory;

    public function __construct(GridDataFactoryInterface $gridDataFactory)
    {
        $this->gridDataFactory = $gridDataFactory;
    }

    public function getData(SearchCriteriaInterface $searchCriteria){

        $articleData = $this->gridDataFactory->getData($searchCriteria);
        $modifiedReccors = $this->applyModification($articleData->getRecords()->all());
        return new GridData(
            new RecordCollection($modifiedReccors),
            $articleData->getRecordsTotal(),
            $articleData->getQuery()
        );
    }
     
    private function applyModification(array $rows)
    {
        return $rows;
    }
}