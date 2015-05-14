<?php

namespace Prode\BackendBundle\Form\Backend;

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
            ->add ( 'password', 'repeated', array (
				'type' => 'password',
				'first_name' => 'pass',
				'second_name' => 'confirm',
				'invalid_message' => 'Las dos contraseñas deben coincidir',
				'options' => array (
						'label' => 'Contraseña' 
				) 
		) )
            ->add('empresa')
            /*->add('estado')*/
            ->add('apodo')
            /*->add('comision')*/
            ->add('sexo', 'choice', array(
    'choices'   => array('M' => 'Masculino', 'F' => 'Femenino'),
    'required'  => false,
))

->add('tipo', 'choice', array(
		'choices'   => array('1' => 'Usuario', '2' => 'Administrador', '3' => 'Super Administrador'),
		'required'  => false,
))
            ->add ( 'fecha_nacimiento', 'birthday', array('years' => range('1910', date('Y'))) )
            /*->add('pais')*/
            ->add('ciudad')
            /*->add('telefono')
            /*->add('equipo')
            ->add('fecha_alta')
            ->add('fecha_modificacion')
            ->add('salt')
            ->add('token')*/
            ->add('deacuerdo', 'checkbox', array (
				'required' => true 
		) )/*
            ->add('prodecomp')
            ->add('puntos')
            ->add('ingresos')
            ->add('rutafoto')
            /*->add ( 'foto', 'file', array (
            		'required' => false
            ) )*/
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
