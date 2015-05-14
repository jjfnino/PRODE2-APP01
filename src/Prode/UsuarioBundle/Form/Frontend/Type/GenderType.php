<?php
// src/Prode2014/UsuarioBundle/Form/Type/GenderType.php
namespace Prode\UsuarioBundle\Form\Frontend\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GenderType extends AbstractType {
	
	private $genderChoices;
	
	public function __construct(array $genderChoices)
	{
		$this->genderChoices = $genderChoices;
	}
	
	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
				'choices' => $this->genderChoices,
		));
	}
	
	
	public function getParent() {
		return 'choice';
	}
	public function getName() {
		return 'gender';
	}
}