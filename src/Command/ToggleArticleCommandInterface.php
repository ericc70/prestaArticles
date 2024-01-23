<?php
namespace Ericc70\Openarticles\Command;

use Ericc70\Openarticles\ValueObject\ArticleId;

Interface ToggleArticleCommandInterface extends ArticleIdentifierCommandInterface {
 


     public function getActive() :bool;
   

 }