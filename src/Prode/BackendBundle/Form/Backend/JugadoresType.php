<?php

namespace Prode2014\BackendBundle\Form\Backend;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class JugadoresType extends AbstractType {
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder
		->add ( 'nombre' )

		->add ( 'apellido' )
		->add ( 'pais' );
		
	}
	
	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
				'data_class' => 'Prode2014\BackendBundle\Entity\Jugadores'
		));
	}
	
	public function getName() {
		return 'cupon_usuariobundle_usuariotype';
	}
}