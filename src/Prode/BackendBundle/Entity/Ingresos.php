<?php
// src/Prode2014/BackendBundle/Entity/Banners.php
namespace Prode\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity
 * @ORM\Table(name="Ingresos")
 * */
class Ingresos
{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue
	 */
	protected $id;
	/**
	 * @ORM\Column(type="date")
	 */
	private $fecha;
	/** @ORM\Column(type="integer", nullable=true) */
	protected $cantidad;	
		

	public function __construct() {
	
		//$this->estado = '0';
		
	
	}

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
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
     * Set cantidad
     *
     * @param integer $cantidad
     * @return Cantidad
     */
    public function setCantidad($cantidad)
    {
    	$this->cantidad = $cantidad;
    
    	return $this;
    }
    
    /**
     * Get cantidad
     *
     * @return integer
     */
    public function getCantidad()
    {
    	return $this->cantidad;
    }
    

  
}
