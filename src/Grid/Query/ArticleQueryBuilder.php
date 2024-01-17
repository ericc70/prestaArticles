<?php

declare(strict_types=1);

namespace Ericc70\Openarticles\Grid\Query;

use Doctrine\DBAL\Connection;

use Doctrine\DBAL\Query\QueryBuilder;
use PrestaShop\PrestaShop\Core\Grid\Query\Filter\SqlFilters;
use PrestaShop\PrestaShop\Core\Grid\Search\SearchCriteriaInterface;
use PrestaShop\PrestaShop\Core\Grid\Query\AbstractDoctrineQueryBuilder;
use PrestaShop\PrestaShop\Core\Grid\Query\Filter\DoctrineFilterApplicatorInterface;
use PrestaShop\PrestaShop\Core\Grid\Query\DoctrineSearchCriteriaApplicatorInterface;

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
        $db = $this->getQueryBuilder($searchCriteria->getFilters());
        $db->select('oa.id, oa.position, oa.active')
        ->addSelect('oal.lang_id, oal.title') ;
        $this->searchCriteriaApplicator
        ->applyPagination($searchCriteria, $db)
        ->applySorting($searchCriteria,$db);

        return $db;
    }


    public function getCountQueryBuilder(SearchCriteriaInterface $searchCriteria)
    {
          $db = $this->getQueryBuilder( $searchCriteria->getFilters());
          $db->select('COUNT(oa.id)');

          return $db;
    }

    private function getQueryBuilder(array $filterValues) :QueryBuilder
    {
        $db = $this->connection
        ->createQueryBuilder()
        ->from($this->dbPrefix.'open_articles', 'oa')
        ->leftjoin(
            'oa',
            $this->dbPrefix.'open_articles_lang',
            'oal',
            'oal.open_article_id = oa.id AND oal.lang_id = :lang_id'
        ); 

        $sqlFilters = new SqlFilters();
        $sqlFilters->addFilter(
            'id',
            'oa.id',
            SqlFilters::WHERE_STRICT
        );
        $this->filterApplicator->apply($db, $sqlFilters, $filterValues);
        $db->setParameter('lang_id', $this->contextLangId);

        foreach ($filterValues as $filterName => $filter){
            if('active' === $filterName){
                $db->andWhere('oa.active = :active' );
                $db->setParameter('active', $filter);

                continue;
            }
            if('title' === $filterName){
                $db->andWhere('oa.title LIKE :title' );
                $db->setParameter('title ','%'. $filter.'%');

                continue;
            }
            if('position' === $filterName){
                $db->andWhere('oa.position LIKE :position' );
                $db->setParameter('position ','%'. $filter.'%');

                continue;
            }
         
        }
            return $db;
    }
}
