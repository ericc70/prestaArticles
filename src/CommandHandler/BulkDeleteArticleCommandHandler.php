<?php

namespace Ericc70\Openarticles\CommandHandler;

use Doctrine\ORM\EntityManagerInterface;
use Ericc70\Openarticles\Command\BulkArticleCommandInterface;
use Ericc70\Openarticles\CommandHandler\BulkDeleteArticleCommandHandlerInterface;

use Ericc70\Openarticles\Exception\InvalidBulkArticleExeption;
use Ericc70\Openarticles\Repository\ArticleRepository;
use PhpParser\Node\Stmt\TryCatch;

class BulkDeleteArticleCommandHandler implements BulkDeleteArticleCommandHandlerInterface
{

    /**
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

    public function handle(BulkArticleCommandInterface $command)
    {
           
        try {

            foreach ($command->getArticleIds() as $aId) {
                $article = $this->repositoryArticle->findOneBy([
                    'id' => $aId->getValue()
                ]);
                if (!$article) {
                    throw new InvalidBulkArticleExeption("L'article [ " . $aId->getValue() . " ] n'est pas valid");
                }


                $this->entityManager->remove($article);
                $this->entityManager->flush();
            }
        } catch (InvalidBulkArticleExeption $th) {
            throw new InvalidBulkArticleExeption('Une erreur est survenu, impossible de supprimer les articles selectionnés');
        }
    }
}
