<?php

namespace Prode\BackendBundle\Form\Backend;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class PremiosType extends AbstractType {
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder
		->add ( 'titulo' )
		->add ( 'categoria', 'choice', array (
				'choices' => array ( '1' => 'COPA',
									 '2' => 'INSTANTANEOS',
									 '3' => 'TRIVIA' ),
				'required' => false 
		) )
		->add ( 'detalle' )
		->add ( 'puesto' )
		->add ( 'style', 'choice', array (
				'choices' => array ( '1' => 'Simple',
						'2' => 'Doble' ),
				'required' => false
		) )
		->add ( 'foto', 'file', array (
				'required' => false
		) );
		
	}
	public function getName() {
		return 'cupon_usuariobundle_usuariotype';
	}
}