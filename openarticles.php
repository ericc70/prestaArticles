<?php

declare(strict_types=1);

if (!defined('_PS_VERSION_')) {
    exit;
}

require_once __DIR__.'/vendor/autoload.php';

use Ericc70\Openarticles\install\Installer;

class OpenArticles extends Module{

    public function __construct()
    {

        $this->name = 'openarticles';
        $this->tab = 'administration';
        $this->version='1.0.0';
        $this->author = 'ericc70';
        $this->need_instance = 0;
        $this->bootstrap  = true;
        parent::__construct();
        $this->displayName = $this->trans("Gestion des articles", [] , 'Modules.OpenArticles.Admin' );
        $this->description = $this->trans("Création et affichage d'articles d'informations" , [] , 'Modules.OpenArticles.Admin' );
        $this->ps_versions_compliancy = ['min' => '1.7.8.0' , 'max' => _PS_VERSION_];

    }

    public function install()
    {
        if(!parent::install()) return false;
         $installer = new Installer();
        return $installer->install($this);
    }
    public function uninstall()
    {
        if(!parent::uninstall()) return false;
        $installer = new Installer();
        return $installer->uninstall($this);
    }



    public function getContent()
    {
        return "it's work";
    }


    public function hookModuleRoutes(){

    }
}

