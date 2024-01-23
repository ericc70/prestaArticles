<?php

namespace Ericc70\Openarticles\Controller;

use Ericc70\Openarticles\Command\BulkDeleteArticleCommand;
use Ericc70\Openarticles\Command\DeletetArticleCommand;
use Ericc70\Openarticles\Command\ToggleArticleCommand;
use Ericc70\Openarticles\CommandHandler\DeleteArticleCommandHandler;
use Ericc70\Openarticles\Exception\InvalidArticleExcaption;
use Ericc70\Openarticles\Grid\Filters\ArticleFilters;
use Ericc70\Openarticles\Query\getArticleState;
use Ericc70\Openarticles\ValueObject\ArticleId;
use PhpParser\Node\Stmt\TryCatch;

use PrestaShopBundle\Controller\Admin\FrameworkBundleAdminController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminOpenArticles extends FrameworkBundleAdminController
{

    public function indexAction(Request $request, ArticleFilters $articleFilters)
    // public function indexAction(Request $request)
    {

        $gridFactory = $this->get('openarticles.grid.grid_factory');
        $grid = $gridFactory->getGrid($articleFilters);
        return $this->render('@Modules/openarticles/views/templates/admin/articles.html.twig', [

            'enableSidebar' => true,
            'layoutTitle' => $this->trans('Liste des articles', 'Module.Openarticles.Admin'),
            'articleGrid' => $this->presentGrid($grid),
            'layoutHeaderToolbarBtn' => $this->getToolBarButtons()
        ]);
    }

    public function createAction(Request $request,)
    // public function indexAction(Request $request)
    {
        $formBuilder = $this->get('openarticles.form.identifiable.object.builder');
        $form = $formBuilder->getForm();

        $form->handleRequest($request);
        $formHandler = $this->get('openarticles.form.identifiable.object.handler');
        $result = $formHandler->handle($form);
        if ($result->getIdentifiableObjectId() !== null) {
            $this->addFlash('succes', $this->trans('Article ajouter avec succes', 'Modules.OpenArticles.Admin'));
            return $this->redirectToRoute('oit_article_index');
        }

        return $this->render('@Modules/openarticles/views/templates/admin/create.html.twig', [

            'enableSidebar' => true,
            'articleForm' => $form->createView(),
            'layoutTitle' => $this->trans('Ajouter un article', 'Module.Openarticles.Admin'),



        ]);
    }


    public function editAction($articleId, Request $request)
    {


        $formBuilder = $this->get('openarticles.form.identifiable.object.builder');
        $form = $formBuilder->getFormFor($articleId);
        $form->handleRequest($request);
        $formHandler = $this->get('openarticles.form.identifiable.object.handler');
        $result = $formHandler->handleFor($articleId, $form);
        if ($result->getIdentifiableObjectId() !== null) {
            $this->addFlash('succes', $this->trans('Article modifier avec succes', 'Modules.OpenArticles.Admin'));
            return $this->redirectToRoute('oit_article_index');
        }

        return $this->render('@Modules/openarticles/views/templates/admin/create.html.twig', [
            'enableSidebar' => true,
            'articleForm' => $form->createView(),
            'layoutTitle' => $this->trans('Modifier un article', 'Module.Openarticles.Admin'),



        ]);
    }


    public function deleteBulkAction(Request $request)
    {


        try {

            $articleToDelete = $request->request->get('open_article_article_id');
            if (!empty($articleToDelete)) {
                $articleToDelete = array_map(function ($i) {
                    return (int) $i;
                }, $articleToDelete);
            }

            $this->getCommandBus()->handle(new BulkDeleteArticleCommand($articleToDelete));

            $this->addFlash('success', $this->trans('Article supprimé', "Modules.OpenArticles.Admin"));

            return $this->redirectToRoute('oit_article_index');
        } catch (InvalidArticleExcaption $th) {

            $this->addFlash(
                'error',
                $this->trans('Erreur survenu, article n\'a pas été supprimé !', "Module.Openarticles.Admin")
            );
        }
    }

    public function deleteAction(int $articleId)
    {

        $res = $this->getCommandBus()->handle(new DeletetArticleCommand(new ArticleId($articleId)));
        if ($res) {
            // $this->deleteUploadedImage($articleId);
            $this->addFlash(
                'succes',
                $this->trans('Article supprimé avec succeess !', "Module.Openarticles.Admin")
            );
        } else {
            $this->addFlash(
                'error',
                $this->trans('Erreur survenu, article n\'a pas été supprimé !', "Module.Openarticles.Admin")
            );
        }
        return $this->redirectToRoute('oit_article_index');
    }

    public function toogleAction(int $articleId): JsonResponse
    {


        try {
            $isEnabled = $this->getQueryBus()->handle(new GetArticleState($articleId));
            $this->getCommandBus()->handle(new ToggleArticleCommand(new ArticleId($articleId), !$isEnabled));
            $response = [
                "status" => true,
                "message" => $this->trans('Le status à bien été mis à jour', 'Module.Openarticle.Admin')
            ];
        } catch (InvalidArticleExcaption $th) {
         
            $$response = [
                "status" => "error",
                "message" => $this->trans('Le status à bien été mis à jour', 'Module.Openarticle.Admin')
            ];
        }

        return $this->json($response);
    }

    public function getToolBarButtons()
    {
        return [
            'add' => [
                'desc' => $this->trans('Ajouter un article', 'Module.Openarticles.Admin'),
                'icon' => 'add_circle_outline',
                'href' => $this->generateUrl('ec_article_create'),
            ]
        ];
    }
}
