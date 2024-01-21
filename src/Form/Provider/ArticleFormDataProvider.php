<?php
namespace Ericc70\Openarticles\Form\Provider;

use Ericc70\Openarticles\Repository\ArticleRepository;
use PrestaShop\PrestaShop\Core\Form\IdentifiableObject\DataProvider\FormDataProviderInterface;
use Ericc70\Openarticles\Entity\OpenArticles as OpenArticlesEntity;
use Ericc70\Openarticles\Entity\OpenArticlesLang;

class ArticleFormDataProvider implements FormDataProviderInterface
{

    /**
     * Undocumented variable
     *
     * @var ArticleRepository
     */
    private $repository;



    public function __construct(ArticleRepository $repository)
    {
            $this->repository = $repository;
    }
/**
 * Undocumented function
 *
 * @pvar OpenArticlesEntity $articleId
 * @return void
 */
    public function getData($articleId)
    {
        $article = $this->repository->find($articleId);
        $data =[
            'active' => $article->getActive(),
            'product_id' => $article->getProductId(),
            
        ] ;

        /**
         * @var OpenArticlesLang $al
         */
        foreach ($article->getArticleLangs() as $al)
        {
    
             $data['title'][$al->getLang()->getId()] = $al->getTitle();
             $data['resume'][$al->getLang()->getId()] = $al->getResume();
             $data['description'][$al->getLang()->getId()] = $al->getDescription();
      
    
        }
        return $data;
    }

    public function getDefaultData()
    {
        return [
                'active' => true
        ];
    }
}
