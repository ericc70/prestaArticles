<?php 
namespace Ericc70\Openarticles\CommandHandler;

use Ericc70\Openarticles\Command\ToggleArticleCommand;
use Ericc70\Openarticles\Command\ToggleArticleCommandInterface;
use Ericc70\Openarticles\ValueObject\ArticleId;

interface ToggleArticleCommandHandlerInterface {

    public function handle(ToggleArticleCommandInterface $command) ;
}