<?php

namespace Ericc70\Openarticles\CommandHandler;

use Ericc70\Openarticles\Command\BulkDisableArticleCommand;

interface BulkDisableArticleCommandHandlerInterface {

    public function handle(BulkDisableArticleCommand $command);

}