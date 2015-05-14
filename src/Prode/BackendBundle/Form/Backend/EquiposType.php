<?php

namespace Prode\BackendBundle\Form\Backend;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class EquiposType extends AbstractType {
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder
		->add ( 'nombre' )
		->add ( 'bandera')
		->add ( 'foto')
		->add ( 'grupo', 'choice', array (
				'choices' => array ( 'A' => 'A',
									 'B' => 'B',
									 'C' => 'C' ),
				'required' => false 
		) );
		//->add( 'continente' );
		
	}
	public function getName() {
		return 'cupon_usuariobundle_usuariotype';
	}
}