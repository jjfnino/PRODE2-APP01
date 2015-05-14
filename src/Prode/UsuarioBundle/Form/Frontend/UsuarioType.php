<?php
// src/Cupon/UsuarioBundle/Form/Frontend/UsuarioType.php
namespace Prode\UsuarioBundle\Form\Frontend;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class UsuarioType extends AbstractType {
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder->add ( 'nombre' )
		
		->add ( 'apellido' )
		->add ( 'email', 'email' )
		->add ( 'password', 'repeated', array (
				'type' => 'password',
				'first_name' => 'pass',
				'second_name' => 'confirm',
				'invalid_message' => 'Las dos contraseñas deben coincidir',
				'options' => array (
						'label' => 'Contraseña' 
				) 
		) )
		->add ( 'fecha_nacimiento', 'birthday', array('years' => range('1910', date('Y'))) )
		->add ( 'ciudad' )
		->add ( 'pais' )
		->add ( 'apodo' )
		->add ( 'area' )
		->add ( 'telefono' )
		->add ( 'dni' )
		->add ( 'sexo', 'choice', array(
    'choices'   => array('M' => 'Masculino', 'F' => 'Femenino'),
    'required'  => false,
				
))
		->add ( 'foto', 'file', array (
				'required' => false 
		) )
		->add ( 'empresa' )
		->add('roles', 'choice', array(
    'choices'   => array('ROLE_USUARIO' => 'ROLE_USUARIO'),
				'data' => 'ROLE_USUARIO',
    'required'  => false,
))
		/*->add ( 'perfilpublico', 'choice', array(
                'choices'   => array(0 => 'No', 1 => 'Si'),
                'expanded' => true,
                
            ))
		/*->add ( 'jugadapublico', 'choice', array(
                'choices'   => array(0 => 'No', 1 => 'Si'),
                'expanded' => true,
                
            ))*/
		->add ( 'deacuerdo', 'checkbox', array (
				'required' => true 
		) );
	}
	public function getName() {
		return 'cupon_usuariobundle_usuariotype';
	}
	
}