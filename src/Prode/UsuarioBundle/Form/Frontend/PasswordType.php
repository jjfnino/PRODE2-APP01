<?php
// src/Cupon/UsuarioBundle/Form/Frontend/UsuarioType.php
namespace Prode\UsuarioBundle\Form\Frontend;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class PasswordType extends AbstractType {
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder->add ( 'password', 'repeated', array (
				'type' => 'password',
				'first_name' => 'pass',
				'second_name' => 'confirm',
				'invalid_message' => 'Las dos claves deben coincidir',
				'options' => array (
						'label' => 'Contrase&ntilde;a' 
				) 
		) );
	}
	public function getName() {
		return 'cupon_usuariobundle_passwordtype';
	}
	
}