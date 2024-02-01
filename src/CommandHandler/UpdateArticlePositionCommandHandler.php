<?php

namespace Ericc70\Openarticles\CommandHandler;

use Doctrine\ORM\EntityManagerInterface;
use Ericc70\Openarticles\Command\UpdateArticlePositionCommand;
use Ericc70\Openarticles\Exception\CannotUpdateArticlePositionException;
use Ericc70\Openarticles\Repository\ArticleRepository;

final class UpdateArticlePositionCommandHandler implements UpdateArticlePositionCommandHandlerInterface
{
    /**
     * @var ArticleRepository
     */
    public $repository;

    /**
     * @var EntityManagerInterface
     */
    public $entityManager;

    /**
     * @param ArticleRepository $repository
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        ArticleRepository $repository,
        EntityManagerInterface $entityManager
    )
    {
        $this->repository = $repository;
        $this->entityManager = $entityManager;
    }

    /**
     * @throws CannotUpdateArticlePositionException
     */
    public function handle(UpdateArticlePositionCommand $command)
    {
        try {
            $this->repository->updatePositions($command->getData());
        } catch(\Exception $e) {
            throw new CannotUpdateArticlePositionException('An error occured durring update article position');
        }
    }
}