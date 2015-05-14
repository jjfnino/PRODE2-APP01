<?php

namespace Prode\BackendBundle\Form\Backend;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class BannersType extends AbstractType {
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder
		->add ( 'titulo' )
		->add ( 'seccion', 'choice', array (
				'choices' => array ( 
						'HOMEAR' => 'HOME ARRIBA',
						'HOMEAB' => 'HOME ABAJO',
						'SUPERBANNER' => 'SUPERBANNER',
						'BARRA' => 'BARRA',
						'FIXTUREP' => 'FIXTURE PUBLICIDAD',
						'FIXTURET' => 'FIXTURE TITULO',
						'RANKINGP' => 'RANKING PUBLICIDAD',
						'RANKINGT' => 'RANKING TITULO',
						'REGISTROP' => 'REGISTRO PUBLICIDAD',
						'REGISTROT' => 'REGISTRO TITULO',
						'JUGADAP' => 'MI JUGADA PUBLICIDAD',
						'JUGADAT' => 'MI JUGADA TITULO',
						'PREMIOSP' => 'PREMIOS PUBLICIDAD',
						'PREMIOST' => 'PREMIOS TITULO',
						'PREGP' => 'PREGUNTAS PUBLICIDAD',
						'PREGT' => 'PREGUNTAS TITULO',
						'LOGINP' => 'LOGIN PUBLICIDAD',
						'LOGINT' => 'LOGIN TITULO',
						'AYUDAP' => 'AYUDA PUBLICIDAD',
						'AYUDAT' => 'AYUDA TITULO',
						'TRIVIASP' => 'TRIVIA SEMANAL PUBLICIDAD',
						'TRIVIAST' => 'TRIVIA SEMANAL TITULO',
						'REGLAMENP' => 'REGLAMENTO PUBLICIDAD',
						'REGLAMENT' => 'REGLAMENTO TITULO' ),
				'required' => false 
		) )
		->add ( 'url' )
		->add ( 'foto', 'file', array (
				'required' => false
		) )
		->add ( 'width' )
		->add ( 'height' );
		
	}
	public function getName() {
		return 'cupon_usuariobundle_usuariotype';
	}
}