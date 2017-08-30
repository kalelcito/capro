<?php

namespace CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientesType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre',TextType::class,array('required'=>true))
            ->add('descripcion',TextareaType::class,array('attr'=>array('rows'=>'5')))
            ->add('imagen',FileType::class,array('label'=>'Imagen (350x250 min.)','required'=>false,'data_class'=>null,'attr'=>array('ruta'=>'images')))
            ->add('color',TextType::class,array('label'=>'Color Overlay','required'=>true,'attr'=>array('class'=>'colorpicker')))
            ->add('color_text',TextType::class,array('label'=>'Color del Texto','required'=>true,'attr'=>array('class'=>'colorpicker')))
            ->add('activo')
            //->add('created_at')
            //->add('updated_at')
        ;
}

/**
* {@inheritdoc}
*/
public function configureOptions(OptionsResolver $resolver)
{
$resolver->setDefaults(array(
'data_class' => 'CoreBundle\Entity\Clientes'
));
}

/**
* {@inheritdoc}
*/
public function getBlockPrefix()
{
return 'corebundle_clientes';
}


}
