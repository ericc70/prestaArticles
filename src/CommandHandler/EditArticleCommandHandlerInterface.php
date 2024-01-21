<?php 
namespace Ericc70\Openarticles\CommandHandler;

use Ericc70\Openarticles\Command\EditArticleCommandInterface;
use Ericc70\Openarticles\ValueObject\ArticleId;

interface EditArticleCommandHandlerInterface {

    public function handle(EditArticleCommandInterface $command) :ArticleId;
}