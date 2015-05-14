<?php

namespace Prode2014\BackendBundle\Form\Backend;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class PreguntasSelectType extends AbstractType {
	protected $filtro;
	protected $tabla;

	
	public function __construct($filtro, $tabla) {
		$this->filtro = $filtro;
		$this->tabla = $tabla;
	
	}
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$this->filtro;
		$builder->add ( 'titulo' )->add ( 'tabla', 'choice', array (
				'choices' => array (
						'1' => 'Paises',
						'2' => 'Continentes',
						'3' => 'Jugadores' 
				),
				'required' => true 
		) )->add ( 'filtro', 'choice', array (
				'choices' => array (
						'1' => 'Pais',
						'2' => 'Continente',
						'3' => 'Grupo' 
				),
				'required' => false 
		) );
		switch ($this->tabla) {
			case '1':
			$builder->add ( 'respuestaselect', 'entity', array(
			'empty_value' => '....',
			'required' => false,

						    'class' => 'BackendBundle:Paises',
						    'query_builder' => function(EntityRepository $er) {
						        return $er->createQueryBuilder('u')
        			/*->where('u.grupo = :grupo')
        			->setParameter('grupo', $this->filtro)*/
            		->orderBy('u.nombre', 'ASC');
    																		   },
							) );
			break;
			case '2':
				$builder->add ( 'respuestaselect', 'entity', array(
						'empty_value' => '....',
						'required' => false,
	
						'class' => 'BackendBundle:Continentes',
						'query_builder' => function(EntityRepository $er) {
							return $er->createQueryBuilder('u')
							/*->where('u.grupo = :grupo')
							 ->setParameter('grupo', $this->filtro)*/
							->orderBy('u.nombre', 'ASC');
						},
				) );
				break;
				case '3':
					$builder->add ( 'respuestaselect', 'entity', array(
					'class' => 'BackendBundle:Jugadores',
					'empty_value' => '....',
					'property' => 'apellido',
					'multiple' => false,
					'required' => false,
					) );
				break;
			
			default:
				
		$builder->add ( 'respuestaselect', 'entity', array(
		'empty_value' => '....',
		'required' => false,
						    'class' => 'BackendBundle:Paises',
						    'query_builder' => function(EntityRepository $er) {
						        return $er->createQueryBuilder('u')
        			/*->where('u.grupo = :grupo')
        			->setParameter('grupo', $this->filtro)*/
            		->orderBy('u.nombre', 'ASC');
    																		   },
							) );
		break;
	}
}
	public function getName() {
		return 'prode2014_usuariobundle_preguntastype';
	}
}