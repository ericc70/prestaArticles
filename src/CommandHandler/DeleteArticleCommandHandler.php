<?php
declare(strict_types=1);
namespace Ericc70\Openarticles\CommandHandler;

use Doctrine\ORM\EntityManagerInterface;
use Ericc70\Openarticles\Command\DeleteArticleCommandInterface;
use Ericc70\Openarticles\CommandHandler\DeleteArticleCommandHandlerInterface;
use Ericc70\Openarticles\Exception\CannotDeleteArticleExeption;
use Ericc70\Openarticles\Repository\ArticleRepository;
use Ericc70\Openarticles\ValueObject\ArticleId;
use PhpParser\Node\Stmt\TryCatch;
use PrestaShop\PrestaShop\Core\Domain\Category\Exception\CannotDeleteImageException;

class DeleteArticleCommandHandler implements DeleteArticleCommandHandlerInterface {



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


    public function handle(DeleteArticleCommandInterface $command) :ArticleId
    {

        try {
           $article = $this->repositoryArticle->findOneBy(
            ['id' => $command->getArticleId()->getValue() ]
           );

           if($article){
             $this->entityManager->remove($article);
             $this->entityManager->flush();
           }

           return $command->getArticleId();

        } catch (CannotDeleteArticleExeption $th) {
            throw new CannotDeleteArticleExeption('impossible a supprimer l\'article'); 
        }
    }


}