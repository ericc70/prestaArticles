<?php
declare(strict_type=1);

namespace Ericc70\Openarticles\Repository;

use Doctrine\ORM\EntityRepository;
use Exception;

class ArticleRepository extends EntityRepository
{

    public function getProducts(int $lang_id = 0) {
        $lang_id = $lang_id ? $lang_id :  \Context::getContext()->language->id;


        $query = new \DbQuery();
        $query->from('product_lang')
        ->select('name, id_product')
        -> where('id_lang='.$lang_id)
                ;

        $products = \Db::getInstance()->executeS($query);
        $data = [];
        foreach ($products as $p){
            $data[$p['name']] = $p['id_product'];
        }

        return $data;
    }

 
        /**
     * @param array $positionsData
     * @return void
     * @throws ConnectionException
     */
    public function updatePositions(array $positionsData = []): void
    {
        try {
            $this->_em->getConnection()->beginTransaction();

            $i = 0;
            foreach ($positionsData['positions'] as $position) {
                $qb = $this->_em->getConnection()->createQueryBuilder();
                $qb
                    ->update(_DB_PREFIX_ . 'open_articles')
                    ->set('position', ':position')
                    ->andWhere('id = :articleId')
                    ->setParameter('articleId', $position['rowId'])
                    ->setParameter('position', $i);

                ++$i;

                $qb->execute();
            }
            $this->_em->getConnection()->commit();
        } catch (Exception $e) {
            $this->_em->getConnection()->rollBack();
        }
    }
}