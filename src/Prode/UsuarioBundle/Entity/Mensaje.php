<?php
// src/Prode2014/FrontendBundle/Entity/Partidos.php
namespace Prode2014\UsuarioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity
 * @ORM\Table(name="Mensaje")
 */
class Mensaje{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue
	 */
	protected $id;
	
	/**
	 * @ORM\Column(type="string", length=150)
	 * @Assert\NotBlank()
	 */
	protected $nombre;
	
	/**
	 * @ORM\Column(type="string", length=150)
	 * @Assert\NotBlank()
	 */
	protected $apellido;
	
	/**
	 * @ORM\Column(type="string", length=255)
	 * @Assert\NotBlank()
	 */
	protected $email;
	
	/**
	 * @ORM\Column(type="integer", nullable=true)
	 */
	protected $estado;

	
	/**
	 * @ORM\Column(type="datetime")
	 */
	protected $fechaalta;
	
	/**
	 * @ORM\Column(type="string", length=255)
	 * @Assert\NotBlank()
	 */
	protected $detalle;
	
	public function __construct() {
		$this->fechaalta = new \DateTime ();
		$this->estado = '0';
	}
	
	public function __toString() {
		return $this->getNombre () . ' ' . $this->getApellido ();
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
	 * Set nombre
	 *
	 * @param string $nombre        	
	 * @return Usuario
	 */
	public function setNombre($nombre) {
		$this->nombre = $nombre;
		
		return $this;
	}
	
	/**
	 * Get nombre
	 *
	 * @return string
	 */
	public function getNombre() {
		return $this->nombre;
	}
	
	/**
	 * Set apellido
	 *
	 * @param string $apellido        	
	 * @return Usuario
	 */
	public function setApellido($apellido) {
		$this->apellido = $apellido;
		
		return $this;
	}
	
	/**
	 * Get apellido
	 *
	 * @return string
	 */
	public function getApellido() {
		return $this->apellido;
	}
	
	/**
	 * Set email
	 *
	 * @param string $email        	
	 * @return Usuario
	 */
	public function setEmail($email) {
		$this->email = $email;
		
		return $this;
	}
	
	/**
	 * Get email
	 *
	 * @return string
	 */
	public function getEmail() {
		return $this->email;
	}
	
	/**
	 * Set estado
	 *
	 * @param integer $estado        	
	 * @return Usuario
	 */
	public function setEstado($estado) {
		$this->estado = $estado;
		
		return $this;
	}
	
	/**
	 * Get estado
	 *
	 * @return integer
	 */
	public function getEstado() {
		return $this->estado;
	}
	
	
	/**
	 * Set fechaalta
	 *
	 * @param \DateTime $fechaalta        	
	 * @return Usuario
	 */
	public function setFechaalta($fechaalta) {
		$this->fechaalta = $fechaalta;
		
		return $this;
	}
	
	/**
	 * Get fechaalta
	 *
	 * @return \DateTime
	 */
	public function getFechaalta() {
		return $this->fechaalta;
	}
	
	
	/**
	 * Set detalle
	 *
	 * @param \DateTime $detalle
	 * @return detalle
	 */
	public function setDetalle($detalle) {
		$this->detalle = $detalle;
	
		return $this;
	}
	
	/**
	 * Get detalle
	 *
	 * @return \detalle
	 */
	public function getDetalle() {
		return $this->detalle;
	}
}
