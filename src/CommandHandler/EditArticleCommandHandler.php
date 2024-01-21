<?php

namespace Ericc70\Openarticles\CommandHandler;

use Doctrine\ORM\EntityManagerInterface;
use Ericc70\Openarticles\ValueObject\ArticleId;
use Ericc70\Openarticles\Entity\OpenArticlesLang;

use Ericc70\Openarticles\Command\EditArticleCommand;
use PrestaShopBundle\Entity\Repository\LangRepository;
use Ericc70\Openarticles\Command\EditArticleCommandInterface;

use Ericc70\Openarticles\Entity\OpenArticles as EntityOpenArticles;
use Ericc70\Openarticles\Exception\CannotUpdateArticleException;
use Ericc70\Openarticles\Repository\ArticleRepository;

final class EditArticleCommandHandler implements EditArticleCommandHandlerInterface
{

    /***
     * @var LanRepository
     */
    private $langRepository;

    /**
     * @var ArticleRepository
     */
    private $repositoryArticle;

    /**
     * Undocumented variable
     *
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;

    public function __construct(
        LangRepository $langRepository,
        ArticleRepository $repositoryArticle,
        EntityManagerInterface  $entityManager
    ) {
        $this->langRepository = $langRepository;
        $this->entityManager = $entityManager;
        $this->repositoryArticle = $repositoryArticle;
    }

    public function handle(EditArticleCommandInterface $command): ArticleId
    {

        $entity = $this->repositoryArticle->find($command->getArticleId()->getValue());
        $this->updateArticleFromCommand($entity, $command);
        return new ArticleId($entity->getId());
    }


    private function updateArticleFromCommand(EntityOpenArticles $entity, EditArticleCommand $command)
    {
        try {

            $entity->setActive($command->isActive());
            $entity->setPosition($command->getPosition());
            $entity->setProductId($command->getProductId());

            $languages = $this->langRepository->findAll();


            foreach ($languages as $l) {
                $articleLang = null;
                foreach ($entity->getArticleLangs() as $al) {
                    if ($al->getLang()->getId() == $l->getId()) {
                        $articleLang = $al;
                    }
                }

                if (null === $articleLang) {
                    $articleLang = new OpenArticlesLang();
                }


                $articleLang->setLang($l);

                if (isset($command->getTitle()[$l->getId()])) {
                    $articleLang->setTitle($command->getTitle()[$l->getId()]);
                }
                if (isset($command->getResume()[$l->getId()])) {
                    $articleLang->setResume($command->getResume()[$l->getId()]);
                }
                if (isset($command->getDescription()[$l->getId()])) {
                    $articleLang->setDescription($command->getDescription()[$l->getId()]);
                }
                $entity->addArticleLangs($articleLang);
            }

            $this->entityManager->persist($entity);
            $this->entityManager->flush();
        } catch (CannotUpdateArticleException $th) {
            throw new CannotUpdateArticleException("Une erreur c'est produite, impossible de modifier un article");
        }
    }
}
