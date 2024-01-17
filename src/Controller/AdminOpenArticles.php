<?php

namespace Ericc70\Openarticles\Controller;

use Ericc70\Openarticles\Grid\Filters\ArticleFilters;
use PrestaShopBundle\Controller\Admin\FrameworkBundleAdminController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminOpenArticles extends FrameworkBundleAdminController
{

     public function indexAction(Request $request, ArticleFilters $articleFilters)
   // public function indexAction(Request $request)
    {

         $gridFactory = $this->get('openarticles.grid.grid_factory');
         $grid = $gridFactory->getGrid($articleFilters);
        return $this->render('@Modules/openarticles/views/templates/admin/articles.html.twig',[

            'enableSidebar' => true,
            'layoutTitle' => $this->trans( 'Liste des articles', 'Module.Openarticles.Admin'),
             'articleGrid' => $this->presentGrid($grid)
        ]);
    }
}