<?php

namespace Ericc70\Openarticles\ValueObject;


use Ericc70\Openarticles\Exception\InvalidArticleExcaption;

class ArticleId{

    private $articleId;

    public function __construct(int $articleId){
        $this->assertIsGreaterThanZero($articleId);
        $this->articleId = $articleId;
    }



    public function getValue()
    {
      
        return $this->articleId;
    }

    private function assertIsGreaterThanZero(int $articleId)
    {
        if ( 0>= $articleId)
        {
            throw new InvalidArticleExcaption(sprintf("L'indentifiant n'est pas valide" , var_export($articleId, true)));
            
        } 

    }
}