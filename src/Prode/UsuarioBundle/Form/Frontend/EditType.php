<?php

namespace Prode\UsuarioBundle\Form\Frontend;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;


class EditType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('apellido')
            ->add('email')
            ->add('dni')
            ->add('fecha_nacimiento')
        ;
    }
    

    /**
     * @return string
     */
    public function getName()
    {
        return 'prode2014_usuariobundle_usuario';
    }
}
