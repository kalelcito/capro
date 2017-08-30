<?php

namespace FrontendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ContactoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', TextType::class,array(
                'label' => 'Nombre',
                'required'=>true,
                'constraints' => array(
                    new NotBlank(array(
                        'message' => 'Ingresa un nombre',
                    )),
                    new Length(array('min' => 3,
                        'minMessage' => 'El nombre debe ser mayor a {{ limit }} letras',
                    )),
                ),
                'attr' => array('placeholder' => '* Nombre','autocomplete'=>'off')
            ))
            ->add('email', EmailType::class, array(
                'label' => 'Correo Electrónico',
                'required'=>true,
                'constraints' => array(
                    new Email(array(
                        'message' => 'El correo electrónico \'{{ value }}\' no es válido',
                    )),
                    new NotBlank(array(
                        'message' => 'Ingresa un correo electrónico',
                    )),
                    new Length(array('min' => 3,
                        'minMessage' => 'El correo electrónico debe ser mayor a {{ limit }} dígitos',)),
                ),
                'attr' => array('placeholder' => '* Email','autocomplete'=>'off'),
                'trim' => true
            ))
            ->add('mensaje', TextareaType::class,array(
                'label' => 'Mensaje',
                'required'=>true,
                'constraints' => array(
                    new NotBlank(array(
                        'message' => 'Ingresa un Mensaje',
                    )),
                ),
                'attr' => array('placeholder' => '* Mensaje','rows'=>'8','autocomplete'=>'off')
            ))
            ->add('enviar', SubmitType::class,  array(
                    'label' => 'ENVIAR MENSAJE')
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getName()
    {
        return 'contact';
    }
}
