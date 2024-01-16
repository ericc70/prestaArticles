<?php

namespace Ericc70\Openarticles\Grid\Definition\Factory;

use PrestaShop\PrestaShop\Core\Grid\Action\Row\RowActionCollection;
use PrestaShop\PrestaShop\Core\Grid\Action\Row\Type\LinkRowAction;
use PrestaShop\PrestaShop\Core\Grid\Action\Row\Type\SubmitRowAction;
use PrestaShop\PrestaShop\Core\Grid\Column\ColumnCollection;
use PrestaShop\PrestaShop\Core\Grid\Column\Type\Common\ActionColumn;
use PrestaShop\PrestaShop\Core\Grid\Column\Type\Common\DataColumn;
use PrestaShop\PrestaShop\Core\Grid\Column\Type\Common\IdentifierColumn;
use PrestaShop\PrestaShop\Core\Grid\Definition\Factory\AbstractGridDefinitionFactory;

class ArticleDefinitionFactory extends AbstractGridDefinitionFactory
{
    const GRID_ID = "open_article";

    
    protected function getId()
    {
        return self::GRID_ID;
    } 
    protected function getName()
    {
        return $this->trans( 'Mes articles', [], 'Modules.OpenArticles.Admin');
    }
    protected function getColumns(){
        return (new ColumnCollection())
            ->add((new IdentifierColumn('id'))
            ->setName($this->trans('ID', [],'AdminGlobal' ))
            ->setOptions([
                'identifier_field' => 'id',
                'bulk_field' => 'id',
                'with_bulk_field' => true,
                'clickable' => false
            ])
            )
            ->add((new DataColumn('title'))
            ->setName($this->trans('Titre', [],'Modules.OpenArticles.Admin' ))
            ->setOptions([
                'field'=> 'title',
            ])
            )
            ->add((new DataColumn('product'))
            ->setName($this->trans('Produit', [],'Modules.OpenArticles.Admin' ))
            ->setOptions([
                'field'=> 'product',
            ])
            )
            ->add(
                (new ActionColumn('actions'))
                ->setName($this->trans('Actions', [], 'Admin.Global'))
                ->setOptions([
                    'actions' => (new RowActionCollection())
                    ->add(
                        (new LinkRowAction('edit'))
                        ->setName('Edit')
                        ->setIcon('edit')
                        ->setOptions([
                            'route' => 'oit_article_edit',
                            'route_param_name' => 'articleId',
                            'route_param_field' => 'article_id',
                            // A click on the row will have the same effect as this action
                            'clickable_row' => true,
                        ])
                    )
                    ->add(
                        (new SubmitRowAction('delete'))
                        ->setName('Delete')
                        ->setIcon('delete')
                        ->setOptions([
                            'confirm_message' => 'Delete selected item?',
                            'route' => 'oit_article_delete',
                            'route_param_name' => 'articleId',
                            'route_param_field' => 'article_id',
                            'confirm_message' => $this->trans(
                                'Delete selected item',
                                [],
                                'Admin.Notifications.Warning'
                            )
                        ])
                    )
                ])
            )
        ;
    }
}
