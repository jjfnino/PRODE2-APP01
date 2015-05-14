<?php

namespace Prode\BackendBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity
 * @ORM\Table(name="Ventas")
 */
class Ventas {
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue
	 */
	private $id;
	
	/**
	 * @ORM\Column(type="integer", length=255)
	 * @Assert\NotBlank()
	 */
	protected $usuario;
	
	/**
	 * @ORM\Column(type="integer", nullable=true)
	 */
	private $semana;
	
	/**
	 * @ORM\Column(type="integer", nullable=true)
	 */
	private $puntos;
	
	/**
	 * @ORM\Column(type="datetime")
	 */
	private $fecha;
	
	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	protected $descripcion;
	public function __construct() {
		$this->fecha = new \DateTime ();
	}
	
	/**
	 * Get id
	 *
	 * @return integer
	 */
	public function getId() {
		return $this->id;
	}
	
	/**
	 * Set usuario
	 *
	 * @param string $usuario        	
	 * @return Respuesta
	 */
	public function setUsuario($usuario) {
		$this->usuario = $usuario;
		
		return $this;
	}
	
	/**
	 * Get usuario
	 *
	 * @return string
	 */
	public function getUsuario() {
		return $this->usuario;
	}
	
	/**
	 * Set semana
	 *
	 * @param integer $semana        	
	 * @return Semana
	 */
	public function setSemana($semana) {
		$this->semana = $semana;
		
		return $this;
	}
	
	/**
	 * Get semana
	 *
	 * @return integer
	 */
	public function getSemana() {
		return $this->semana;
	}
	
	/**
	 * Set puntos
	 *
	 * @param integer $puntos        	
	 * @return Respuesta
	 */
	public function setPuntos($puntos) {
		$this->puntos = $puntos;
		
		return $this;
	}
	
	/**
	 * Get puntos
	 *
	 * @return integer
	 */
	public function getPuntos() {
		return $this->puntos;
	}
	
	/**
	 * Set fecha
	 *
	 * @param \DateTime $fecha        	
	 * @return Respuesta
	 */
	public function setFecha($fecha) {
		$this->fecha = $fecha;
		
		return $this;
	}
	
	/**
	 * Get fecha
	 *
	 * @return \DateTime
	 */
	public function getFecha() {
		return $this->fecha;
	}
	
	/**
	 * Set Descripcion
	 *
	 * @param \DateTime $descripcion        	
	 * @return Preguntas
	 */
	public function setDescripcion($descripcion) {
		$this->descripcion = $descripcion;
		
		return $this;
	}
	
	/**
	 * Get Descripcion
	 *
	 * @return \DateTime
	 */
	public function getDescripcion() {
		return $this->descripcion;
	}
}
