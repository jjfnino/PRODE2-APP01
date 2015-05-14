<?php

namespace Prode2014\BackendBundle\Form\Backend;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class PreguntasCheckType extends AbstractType {
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder
		->add ( 'titulo' )
		->add ( 'opcion1' )
		->add ( 'opcion2' )
		->add ( 'opcion3' )
		->add ( 'opcion4' )
		->add ( 'respuestacheck', 'choice', array (
				'choices' => array ( '1' => 'A',
						'2' => 'B',
				'3' => 'C',
				'4' => 'D'),
				'required' => true
		) );
		
	}
	public function getName() {
		return 'cupon_usuariobundle_usuariotype';
	}
}