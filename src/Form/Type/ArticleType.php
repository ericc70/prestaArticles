<?php
declare(strict_types=1);

namespace Ericc70\Openarticles\Form\Type;


use PrestaShopBundle\Form\Admin\Type\SwitchType;
use Symfony\Component\Form\FormBuilderInterface;
use PrestaShopBundle\Form\Admin\Type\TranslateType;
use PrestaShopBundle\Form\Admin\Type\TranslatableType;
use PrestaShopBundle\Form\Admin\Type\TranslatorAwareType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use PrestaShopBundle\Form\Admin\Type\FormattedTextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ArticleType extends TranslatorAwareType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder->add('title', TranslatableType::class, [
            'type' => TextType::class,
            'required' => true,
            'label' => $this->trans('Titre', 'Module.Openarticles.Admin')
        ]);
        
        $builder->add('product_id', ChoiceType::class, [
            
            'choices' => [ 
                'T-shirt'=> 1,
                'chemise'=> 2,
                'Pantallon,'=> 3,
            ],
           'choice_translation_domain' => 'Module.Openarticles.Admin',
            'required' => false,
            'label' => $this->trans('Produit', 'Module.Openarticles.Admin')
        ]);
      
        
        $builder->add('resume', TranslateType::class, [
            'type' => TextareaType::class,
            'required' => true,
            'locales' => $this->locales,
            'hideTabs' => false,
            
            'label' => $this->trans('Resume', 'Module.Openarticles.Admin')
        ]);

               
        $builder->add('description', TranslateType::class, [
            'type' => FormattedTextareaType::class,
            'required' => true,
            'locales' => $this->locales,
            'hideTabs' => false,
            
            'label' => $this->trans('Description', 'Module.Openarticles.Admin')
        ]);

        $builder->add('active', SwitchType::class, [
           
            'label' => $this->trans('Active', 'Module.Openarticles.Admin')
        ]);
        

    }
}

