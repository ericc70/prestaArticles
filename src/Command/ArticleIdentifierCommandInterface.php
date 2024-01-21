<?php

namespace Ericc70\Openarticles\Command;

use Ericc70\Openarticles\ValueObject\ArticleId;

interface ArticleIdentifierCommandInterface   {

    public function getArticleId() :ArticleId ;
}