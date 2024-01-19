<?php
declare(strict_types=1);

namespace Ericc70\Openarticles\Form\Type;

use Doctrine\DBAL\Types\TextType;
use PrestaShopBundle\Form\Admin\Type\FormattedTextareaType;
use PrestaShopBundle\Form\Admin\Type\SwitchType;
use PrestaShopBundle\Form\Admin\Type\TranslateType;
use PrestaShopBundle\Form\Admin\Type\TranslatorAwareType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;

class ArticleType extends TranslatorAwareType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder->add('title', TranslateType::class, [
            'type' => TextType::class,
            'required' => true,
            'labal' => $this->trans('Titre', 'Module.Openarticles.Admin')
        ]);
        
        $builder->add('product', TranslateType::class, [
            'type' => ChoiceType::class,
            'choices' => [ 
                'T-shirt'=> 1,
                'chemise'=> 2,
                'Pantallon,'=> 3,
            ],
           'choice_translation_domain' => 'Module.Openarticles.Admin',
            'required' => false,
            'labal' => $this->trans('Produit', 'Module.Openarticles.Admin')
        ]);
      
        
        $builder->add('resume', TranslateType::class, [
            'type' => TextareaType::class,
            'required' => true,
            'locales' => $this->locales,
            'hideTabs' => false,
            
            'labal' => $this->trans('Resume', 'Module.Openarticles.Admin')
        ]);

               
        $builder->add('description', TranslateType::class, [
            'type' => FormattedTextareaType::class,
            'required' => true,
            'locales' => $this->locales,
            'hideTabs' => false,
            
            'labal' => $this->trans('Description', 'Module.Openarticles.Admin')
        ]);

        $builder->add('active', TranslateType::class, [
            'type' => SwitchType::class,
   
            'labal' => $this->trans('Active', 'Module.Openarticles.Admin')
        ]);
        

    }
}