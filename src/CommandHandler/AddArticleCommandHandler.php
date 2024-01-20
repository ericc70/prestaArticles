<?php

namespace Ericc70\Openarticles\CommandHandler;

use Doctrine\ORM\EntityManagerInterface;
use Ericc70\Openarticles\Command\AddArticleCommand;
use Ericc70\Openarticles\Entity\OpenArticles as EntityOpenArticles;
use Ericc70\Openarticles\Entity\OpenArticlesLang;
use Ericc70\Openarticles\Exception\CannotAddArticleException;
use Ericc70\Openarticles\ValueObject\ArticleId;

use PrestaShopBundle\Entity\Repository\LangRepository;

class AddArticleCommandHandler implements AddArticleCommandHandlerInterface
{
    /***
     * @var LanRepository
     */
    private $langRepository;

    /**
     * Undocumented variable
     *
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;

    public function __construct(LangRepository $langRepository, EntityManagerInterface  $entityManager)
    {
        $this->langRepository = $langRepository;
        $this->entityManager = $entityManager;
    }

    public function handle(AddArticleCommand $command): ArticleId
    {
        $entity = new EntityOpenArticles();
        $this->createArticleFromCommand($entity, $command);
        return new ArticleId($entity->getId());
    }


    private function createArticleFromCommand(EntityOpenArticles $entity, AddArticleCommand $command)
    {
        try {

            $entity->setActive($command->isActive());
            $entity->setPosition($command->getPosition());
            $entity->setProductId($command->getProductId());

            $languages = $this->langRepository->findAll();


            foreach ($languages as $l) {
                $articleLang = new OpenArticlesLang();
                $articleLang->setLang($l);

                if (isset($command->getTitle()[$l->getId()])) {
                    $articleLang->setTitle($command->getTitle()[$l->getId()]);
                }
                if (isset($command->getResume()[$l->getId()])) {
                    $articleLang->setResume($command->getResume()[$l->getId()]);
                }
                if (isset($command->getDescription()[$l->getId() ])) {
                    $articleLang->setDescription($command->getDescription()[$l->getId()]);
                }
                $entity->addArticleLangs($articleLang);
            }

                $this->entityManager->persist($entity);
                $this->entityManager->flush();

        } catch (CannotAddArticleException $th) {
            throw new CannotAddArticleException("Une erreur c'est produite, impossible d'ajouter un article");
        }
    }
}
