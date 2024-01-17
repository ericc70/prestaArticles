<?php

declare(strict_types=1);

namespace Ericc70\Openarticles\Grid\Querry;

use Doctrine\DBAL\Connection;
use PrestaShop\PrestaShop\Core\Grid\Search\SearchCriteriaInterface;
use PrestaShop\PrestaShop\Core\Grid\Query\AbstractDoctrineQueryBuilder;
use PrestaShop\PrestaShop\Core\Grid\Query\DoctrineSearchCriteriaApplicatorInterface;
use PrestaShop\PrestaShop\Core\Grid\Query\Filter\DoctrineFilterApplicatorInterface;

class ArticleQueryBuilder extends AbstractDoctrineQueryBuilder
{


    private $searchCriteriaApplicator;

    private $contextLangId;

    private $filterApplicator;

    /**
     * @param Connection $connection
     * @param string $dbPrefix
     * @param int $contextLangId
  
     */
    public function __construct(
        Connection $connection,
        string $dbPrefix,
        DoctrineSearchCriteriaApplicatorInterface $searchCriteriaApplicator,
        int  $contextLangId,
        DoctrineFilterApplicatorInterface $filterApplicator
    ) {
        parent::__construct($connection, $dbPrefix);

        $this->contextLangId = $contextLangId;
        $this->searchCriteriaApplicator = $searchCriteriaApplicator;
        $this->filterApplicator = $filterApplicator;
    }


    public function getSearchQueryBuilder(SearchCriteriaInterface $searchCriteria)
    {
        #
    }
    public function getCountQueryBuilder(SearchCriteriaInterface $searchCriteria)
    {
        #   
    }
}
