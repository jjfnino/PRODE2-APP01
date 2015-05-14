<?php

namespace Prode\BackendBundle\Form\Backend;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UsuarioEditType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('email')

            
->add('tipo', 'choice', array(
		'choices'   => array('1' => 'Usuario', '2' => 'Administrador', '3' => 'Super Administrador'),
		'required'  => false,
))
            
            ->add('roles', 'choice', array(
    'choices'   => array('ROLE_SUPER_ADMIN' => 'Super Administrador', 'ROLE_ADMIN' => 'Administrador', 'ROLE_USUARIO' => 'Usuario'),
            		'data' => 'ROLE_SUPER_ADMIN',
            		'required'  => false,
))
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
