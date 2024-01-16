<?php

namespace Ericc70\Openarticles\Controller;

use PrestaShopBundle\Controller\Admin\FrameworkBundleAdminController;
use Symfony\Component\HttpFoundation\Response;

class AdminOpenArticles extends FrameworkBundleAdminController
{

    public function indexAction()
    {
        return $this->render('@Modules/openarticles/views/templates/admin/articles.html.twig',[

            'enableSidebar' => true,
            'layoutTitle' => $this->trans( 'Liste des articles', 'Module.Openarticles.Admin')
        ]);
    }
}