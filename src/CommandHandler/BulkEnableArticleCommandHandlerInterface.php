<?php

namespace Ericc70\Openarticles\CommandHandler;

use Ericc70\Openarticles\Command\BulkEnableArticleCommand;

interface BulkEnableArticleCommandHandlerInterface {

    public function handle(BulkEnableArticleCommand $command);

}