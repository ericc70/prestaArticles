<?php
namespace Ericc70\Openarticles\QueryHandler;

use Ericc70\Openarticles\Exception\InvalidArticleExcaption;
use Ericc70\Openarticles\Query\GetArticleState;
use Ericc70\Openarticles\Repository\ArticleRepository;

class GetArticleStateHandler implements GetArticleStateHandlerInterface  {

    private $repository;

    public function __construct(ArticleRepository $repository){
        $this->repository = $repository;
    }
    
    public function handle(GetArticleState $query )  {

        $articleId = $query->getArticleId()->getValue();

        $article = $this->repository->findOneBy([
            'id' =>  $articleId 
        ]);

        if ($article->getId() !==  $articleId  ){
            throw new InvalidArticleExcaption('Impossible de trouver l\'article');
        }

        return (bool) $article->getActive();
    }
}