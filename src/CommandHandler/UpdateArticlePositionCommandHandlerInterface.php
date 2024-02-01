<?php

namespace Ericc70\Openarticles\CommandHandler;

use Ericc70\Openarticles\Command\UpdateArticlePositionCommand;

interface UpdateArticlePositionCommandHandlerInterface
{
    public function handle(UpdateArticlePositionCommand $command);
}