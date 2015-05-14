<?php
namespace Prode\BackendBundle\Form\Backend;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class PartidoType extends AbstractType {
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder->add ( 'grupo', 'choice', array(
    'choices'   => array(
    					 'A' => 'A', 
    					 'B' => 'B',
    					 'C' => 'C',
			    		'D' => 'D',
			    		'E' => 'E',
			    		'F' => 'F',
			    		'G' => 'G',
			    		'H' => 'H',
			    		'OCTAVOS' => 'OCTAVOS',
			    		'CUARTOS' => 'CUARTOS',
			    		'SEMIFINAL' => 'SEMIFINAL',
			    		'TERCERO' => 'TERCERO',
			    		'FINAL' => 'FINAL',
    						
    					),
    'required'  => false,
))
->add ( 'ronda', 'choice', array(
		'choices'   => array(
				'1' => '1era Ronda',
				'2' => '2da Ronda',
				

		),
		'required'  => true,
		))
		->add ( 'equipoa' )
		->add ( 'equipob' )
		->add ( 'fecha', 'date', array(
				'format' => 'dd-MM-yyyy',
				'model_timezone' => 'America/Argentina/Buenos_Aires'
		))
		->add ( 'sede' )
		->add ( 'hora' )
		;
	}
	public function getName() {
		return 'cupon_usuariobundle_usuariotype';
	}
	
}