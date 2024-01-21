<?php

namespace Ericc70\Openarticles\CommandBuilder;

use Ericc70\Openarticles\Command\AddArticleCommand;
use Ericc70\Openarticles\Command\ArticleCommandInterface;
use Ericc70\Openarticles\Command\EditArticleCommand;
use Ericc70\Openarticles\ValueObject\ArticleId;

class ArticleCommandBuilder implements ArticleCommandBuilderInterface{

    public function buildAddCommand(array $data) :AddArticleCommand
    {
        $command = new AddArticleCommand();
        $this->build($command, $data);
        return $command;
    }
    public function buildEditCommand(ArticleId $articleId, array $data) :EditArticleCommand
    {
        $command = new EditArticleCommand($articleId);
        $this->build($command, $data);
        return $command;
    }


    private function build(ArticleCommandInterface $command, array $data ){
        if(isset($data['active'])){
            $command->setActive((bool)$data['active']);
        }
        if(isset($data['position'])){
            $command->setPosition((int)$data['position'] ?? 1);
        }
        if(isset($data['product_id'])){
            $command->setProductId((int)$data['product_id'] );
        }
        if(isset($data['resume'])){
            $command->setResume($data['resume'] );
        }
        if(isset($data['title'])){
            $command->setTitle($data['title'] );
        }
        if(isset($data['description'])){
            $command->setDescription($data['description'] );
        }

    }
}