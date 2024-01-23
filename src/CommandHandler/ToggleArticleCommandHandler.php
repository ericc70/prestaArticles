<?php

namespace Ericc70\Openarticles\CommandHandler;

use Doctrine\ORM\EntityManagerInterface;
use Ericc70\Openarticles\Command\ToggleArticleCommand;
use Ericc70\Openarticles\Command\ToggleArticleCommandInterface;
use Ericc70\Openarticles\Exception\CannotToggleeExeption;
use Ericc70\Openarticles\Exception\InvalidArticleExcaption;
use Ericc70\Openarticles\Repository\ArticleRepository;
use Ericc70\Openarticles\ValueObject\ArticleId;

class ToggleArticleCommandHandler implements ToggleArticleCommandHandlerInterface
{



    private $repository;

    private $entityManager;

    public function __construct(
        ArticleRepository $repository,
        EntityManagerInterface $entityManager
    ) {
        $this->repository = $repository;
        $this->entityManager = $entityManager;
    }

    public function handle(ToggleArticleCommandInterface $command)
    {
        try {

            $articleId =  $command->getArticleId()->getValue();
            $entity = $this->repository->findOneBy([
                'id' => $articleId
            ]);

            if ($entity) {
                $entity->setActive($command->getActive());
                $this->entityManager->persist($entity);
                $this->entityManager->flush($entity);

                return $command->getArticleId();
            } else {
                throw new InvalidArticleExcaption('Impossible de trouver l\'article ' . $articleId);
            }
        } catch (CannotToggleeExeption $th) {
            throw new CannotToggleeExeption("Impossible de changer le status de l'article");
        }
    }
}
