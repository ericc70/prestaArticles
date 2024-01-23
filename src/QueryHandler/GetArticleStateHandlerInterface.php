<?php
namespace Ericc70\Openarticles\QueryHandler;

use Ericc70\Openarticles\Query\getArticleState;

interface GetArticleStateHandlerInterface
{
    public function handle(getArticleState $query )  ;
}