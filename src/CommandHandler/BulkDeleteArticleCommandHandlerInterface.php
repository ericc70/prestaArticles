<?php
namespace Ericc70\Openarticles\CommandHandler;

use Ericc70\Openarticles\Command\BulkArticleCommandInterface;

Interface BulkDeleteArticleCommandHandlerInterface{

    public function handle(BulkArticleCommandInterface $command);
}