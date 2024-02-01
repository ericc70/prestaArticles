<?php

namespace Ericc70\Openarticles\Grid\Definition\Factory;

use PrestaShop\PrestaShop\Core\Grid\Action\Bulk\BulkActionCollection;
use PrestaShop\PrestaShop\Core\Grid\Action\Bulk\Type\SubmitBulkAction;
use PrestaShop\PrestaShop\Core\Grid\Action\GridActionCollection;
use PrestaShop\PrestaShop\Core\Grid\Action\Row\RowActionCollection;
use PrestaShop\PrestaShop\Core\Grid\Action\Row\Type\LinkRowAction;
use PrestaShop\PrestaShop\Core\Grid\Action\Row\Type\SubmitRowAction;
use PrestaShop\PrestaShop\Core\Grid\Action\Type\LinkGridAction;
use PrestaShop\PrestaShop\Core\Grid\Action\Type\SimpleGridAction;
use PrestaShop\PrestaShop\Core\Grid\Column\ColumnCollection;
use PrestaShop\PrestaShop\Core\Grid\Column\Type\Common\ActionColumn;
use PrestaShop\PrestaShop\Core\Grid\Column\Type\Common\DataColumn;
use PrestaShop\PrestaShop\Core\Grid\Column\Type\Common\IdentifierColumn;
use PrestaShop\PrestaShop\Core\Grid\Column\Type\Common\PositionColumn;
use PrestaShop\PrestaShop\Core\Grid\Column\Type\Common\ToggleColumn;
use PrestaShop\PrestaShop\Core\Grid\Definition\Factory\AbstractGridDefinitionFactory;
use PrestaShop\PrestaShop\Core\Grid\Definition\Factory\BulkDeleteActionTrait;
use PrestaShop\PrestaShop\Core\Grid\Filter\Filter;
use PrestaShop\PrestaShop\Core\Grid\Filter\FilterCollection;
use PrestaShopBundle\Form\Admin\Type\SearchAndResetType;
use PrestaShopBundle\Form\Admin\Type\YesAndNoChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ArticleDefinitionFactory extends AbstractGridDefinitionFactory
{   
    use BulkDeleteActionTrait;

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
            ->add((new IdentifierColumn('article_id'))
            ->setName($this->trans('ID', [],'AdminGlobal' ))
            ->setOptions([
                'identifier_field' => 'article_id',
                'bulk_field' => 'article_id',
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
            ->add((new ToggleColumn('active'))
            ->setName($this->trans('Displyed', [],'Admin.Global' ))
            ->setOptions([
                'field'=> 'active',
                'primary_field' => 'article_id',
                'route' => 'ec_toggle_status',
                'route_param_name' => 'articleId',

            ])
            )
            ->add(
                (new PositionColumn('position'))
                    ->setName($this->trans('Position', [], 'Admin.Global'))
                    ->setOptions([
                        'id_field' => 'article_id',
                        'position_field' => 'position',
                        'update_route' => 'ec_update_positions',
                        'update_method' => 'POST',
                        'record_route_params' => [
                            'article_id' => 'articleId',
                        ],
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
                            'route' => 'ec_article_edit',
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
                            'route' => 'ec_article_delete',
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

    protected function getFilters(){

        return (new FilterCollection())
        ->add(
            (new Filter('article_id', TextType::class))
                ->setAssociatedColumn('article_id')
                ->setTypeOptions([
                    'required' => false,
                    'attr' => [
                        'placeholder' => $this->trans('Search ID', [], 'Admin.Actions'),
                    ],
                ])
        )
        ->add(
            (new Filter('title', TextType::class))
                ->setAssociatedColumn('title')
                ->setTypeOptions([
                    'required' => false,
                    'attr' => [
                        'placeholder' => $this->trans('title', [], 'Admin.Actions'),
                    ],
                ])
        )
        ->add(
            (new Filter('product', TextType::class))
                ->setAssociatedColumn('product')
                ->setTypeOptions([
                    'required' => false,
                    'attr' => [
                        'placeholder' => $this->trans('produit', [], 'Admin.Actions'),
                    ],
                ])
        )
        ->add(
            (new Filter('position', TextType::class))
                ->setAssociatedColumn('position')
                ->setTypeOptions([
                    'required' => false,
                    'attr' => [
                        'placeholder' => $this->trans('position', [], 'Admin.Actions'),
                    ],
                ])
        )
        ->add(
            (new Filter('active',  YesAndNoChoiceType::class))
                ->setAssociatedColumn('active')
              
        )
        ->add(
            (new Filter('actions', SearchAndResetType::class))
                ->setAssociatedColumn('actions')
                ->setTypeOptions([
                    'reset_route' => 'admin_common_reset_search_by_filter_id',
                    'reset_route_params' => [
                        'filterId' => self::GRID_ID,
                    ],
                    'redirect_route' => 'ec_article_search',
                ])
        
        )
    ;

    }

protected function getGridActions()
{
    return ( new GridActionCollection() )
        ->add(
        (new LinkGridAction ('export'))
        ->setName($this->trans('Export',[], "Admin.action"))
        ->setIcon('cloud_download')
        ->setOptions([
            'route'=> "ec_article_export"
        ])
        )
        ->add(
        (new SimpleGridAction ('common_refreh_list'))
        ->setName($this->trans('Refresh list',[], "Admin.Ayparameters.Feature"))
        ->setIcon('refresh')
        )
        
        ->add((new SimpleGridAction ('common_show_query'))
        ->setName($this->trans('Show SQL',[], "Admin.action"))
        ->setIcon('code')
        )
        ->add((new SimpleGridAction ('common_export_sql_manager'))
        ->setName($this->trans('Export SQL',[], "Admin.action"))
        ->setIcon('storage')
        )
;
}


    protected function getBulkActions(){
        return (new BulkActionCollection() )
        ->add(
            (new SubmitBulkAction('enable selection'))
            ->setName($this->trans('Enable selection',[], "Admin.action"))
            ->setOptions([
                'submit_route' => "ec_bulk_status_enable"
            ])
        )
        ->add(
            (new SubmitBulkAction('disable selection'))
            ->setName($this->trans('Disable selection',[], "Admin.action"))
            ->setOptions([
                'submit_route' => "ec_bulk_status_disable"
            ])
        )
         ->add($this->buildBulkDeleteAction('ec_delete_bulk'));
    }
}
