<?php

namespace Ericc70\Openarticles\CommandBuilder;

use Ericc70\Openarticles\Command\AddArticleCommand;
use Ericc70\Openarticles\Command\EditArticleCommand;
use Ericc70\Openarticles\ValueObject\ArticleId;

interface ArticleCommandBuilderInterface{

    public function buildAddCommand(array $data) :AddArticleCommand;
    public function buildEditCommand(ArticleId $articleId,array $data) :EditArticleCommand;
}