<?php
namespace Ericc70\Openarticles\Form\DataHandler;

use Ericc70\Openarticles\CommandBuilder\ArticleCommandBuilderInterface;
use PrestaShop\PrestaShop\Core\CommandBus\CommandBusInterface;
use PrestaShop\PrestaShop\Core\Form\IdentifiableObject\DataHandler\FormDataHandlerInterface;

class ArticleFormDataHandler implements FormDataHandlerInterface
{

    /**
     *
     * @var CommandBusInterface
     */
    private $commandBus;
    
    /**
     * 
     * @var ArticleCommanBuilderInterface
     */
    private $builder;


    public function __construct(
        CommandBusInterface  $commandBus,
        ArticleCommandBuilderInterface $builder
    ){
        $this->commandBus = $commandBus;
        $this->builder = $builder;
    }


    public function create(array $data)
    {
        $command = $this->builder->buildAddCommand($data);
        $articleId = $this->commandBus->handle($command);
        return $articleId;
    }

    public function update( $id, array $data)
    {

    }


}