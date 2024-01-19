<?php
namespace Ericc70\Openarticles\Form\Provider;

use PrestaShop\PrestaShop\Core\Form\IdentifiableObject\DataProvider\FormDataProviderInterface;

class ArticleFormDataProvider implements FormDataProviderInterface
{

    public function getData($id)
    {
        return [];
    }

    public function getDefaultData()
    {
        return [
                'active' => true
        ];
    }
}
