<?php

namespace Ericc70\Openarticles\CommandHandler;

use Doctrine\ORM\EntityManagerInterface;
use Ericc70\Openarticles\Repository\ArticleRepository;
use Ericc70\Openarticles\Command\BulkEnableArticleCommand;
use Ericc70\Openarticles\Exception\CannotToggleeExeption;
use Ericc70\Openarticles\Exception\InvalidArticleExcaption;

class BulkEnableArticleCommandHandler implements BulkEnableArticleCommandHandlerInterface
{

    /*
    * @var ArticleRepository
    */
    private $repositoryArticle;

    /**
     * Undocumented variable
     *
     * @var EntityManagerInterface
     */
    private  $entityManager;



    public function __construct(

        ArticleRepository $repositoryArticle,
        EntityManagerInterface  $entityManager
    ) {

        $this->entityManager = $entityManager;
        $this->repositoryArticle = $repositoryArticle;
    }


    public function handle(BulkEnableArticleCommand $command)
    {


        try {

            foreach ($command->getArticleIds() as $articleId) {
                $id = $articleId->getValue();
                $entity = $this->repositoryArticle->findOneBy(
                    [
                        'id' => $id
                    ]
                );

                if (!$entity) {
                    throw new InvalidArticleExcaption("Impossible de trouver l'article " . $id);
                }
                $entity->setActive(true);
                $this->entityManager->persist($entity);
                $this->entityManager->flush();
            }
        } catch (CannotToggleeExeption $th) {
            throw new CannotToggleeExeption('une erreur c\'est produite pendant le changememnt de status');
        }
    }
}
