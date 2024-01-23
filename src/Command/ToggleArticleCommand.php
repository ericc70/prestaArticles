<?php
namespace Ericc70\Openarticles\Command;

use Ericc70\Openarticles\ValueObject\ArticleId;

class ToggleArticleCommand implements ToggleArticleCommandInterface
 {
    use AbstractArticleIdentifierCommand;

    private $active;
  

 public function __construct(ArticleId $articleId, bool $active){

      $this->articleId = $articleId;

        $this->active = $active;

     }

     public function getActive() :bool
     {
        return $this->active;
     }

 }