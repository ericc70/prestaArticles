<?php 
namespace Ericc70\Openarticles\CommandHandler;

use Ericc70\Openarticles\Command\DeleteArticleCommandInterface;
use Ericc70\Openarticles\ValueObject\ArticleId;

interface DeleteArticleCommandHandlerInterface {

    public function handle(DeleteArticleCommandInterface $command) :ArticleId;
}