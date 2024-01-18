<?php

namespace Ericc70\Openarticles\CommandBuilder;

use Ericc70\Openarticles\Command\AddArticleCommand;

interface ArticleCommandBuilderInterface{

    public function buildAddCommand(array $data) :AddArticleCommand;
}