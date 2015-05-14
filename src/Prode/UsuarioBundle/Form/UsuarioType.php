<?php

namespace Prode\UsuarioBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UsuarioType extends AbstractType
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
            ->add('password')
            ->add('empresa')
            ->add('estado')
            ->add('apodo')
            ->add('comision')
            ->add('sexo')
            ->add('fecha_nacimiento')
            ->add('pais')
            ->add('ciudad')
            ->add('telefono')
            ->add('equipo')
            ->add('fecha_alta')
            ->add('fecha_modificacion')
            ->add('salt')
            ->add('token')
            ->add('deacuerdo')
            ->add('prodecomp')
            ->add('puntos')
            ->add('ingresos')
            ->add('rutafoto')
            ->add('roles')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Prode\UsuarioBundle\Entity\Usuario'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'prode_usuariobundle_usuario';
    }
}
