<?php

namespace Prode2014\BackendBundle\Form\Backend;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class PreguntasType extends AbstractType {
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder
		->add ( 'titulo' )
		->add ( 'tipo', 'choice', array (
				'choices' => array ( '1' => '4 OPCIONES',
						'2' => 'Por Tabla'),
				'required' => true 
		) )
		->add ( 'seccion', 'choice', array (
				'choices' => array ( '1' => 'INICIAL',
						'2' => 'PERIODICA'),
				'required' => true
		) )
		->add ( 'puntos' )
		->add ( 'endda' )
		->add ( 'begda' );
		
	}
	public function getName() {
		return 'cupon_usuariobundle_usuariotype';
	}
}