<?php

namespace Prode2014\BackendBundle\Form\Backend;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class TextosType extends AbstractType {
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder
		->add ( 'titulo' )
		->add ( 'categoria', 'choice', array (
				'choices' => array ( 'REGLAMENTO' => 'REGLAMENTO',
						'AYUDA' => 'AYUDA',
									 ),
				'required' => false 
		) )
		->add ( 'orden' )
		->add ( 'descripcion' );
		
		
		
	}
	public function getName() {
		return 'cupon_usuariobundle_usuariotype';
	}
}