<?php
 namespace Ericc70\Openarticles\CommandHandler;

use Ericc70\Openarticles\Command\AddArticleCommand;
use Ericc70\Openarticles\ValueObject\ArticleId;

 interface AddArticleCommandHandlerInterface
 {

    public function handle(AddArticleCommand $command) :ArticleId;
 }