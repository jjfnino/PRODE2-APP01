<?php
// src/Prode2014/FrontendBundle/Entity/Partidos.php
namespace Prode\FrontendBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/** 
 * @ORM\Entity 
 * @ORM\Table(name="Jugada")
 * */
class Jugada
{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue
	 */
	protected $id;
	
	/**
	 * @ORM\Column(type="integer")
	 */
	protected $id_partido;
	
	/**
	 * @ORM\Column(type="string", length=255)
	 */
	protected $email;

	/**
	 * @ORM\Column(type="datetime")
	 */
	protected $fecha_alta;
	
	/** @ORM\Column(type="integer", nullable=true) */
	protected $equipoa;
	
	/** @ORM\Column(type="integer", nullable=true) */
	protected $equipob;
	
	/** @ORM\Column(type="integer") */
	protected $golesa;
	
	/** @ORM\Column(type="integer", nullable=true) */
	protected $golesb;
	
	/**
	 * @ORM\Column(type="integer", nullable=true)
	 */
	protected $puntos;
	/**
	 * @ORM\Column(type="integer", nullable=true)
	 */
	protected $procesado;

	public function __construct(){
		$this->fecha_alta = new \DateTime ();
		$this->procesado = '0';
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
     * Set id_partido
     *
     * @param integer $idPartido
     * @return Jugadas
     */
    public function setIdPartido($idPartido)
    {
        $this->id_partido = $idPartido;

        return $this;
    }

    /**
     * Get id_partido
     *
     * @return integer 
     */
    public function getIdPartido()
    {
        return $this->id_partido;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Jugadas
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set fecha_alta
     *
     * @param \DateTime $fechaAlta
     * @return Jugadas
     */
    public function setFechaAlta($fechaAlta)
    {
        $this->fecha_alta = $fechaAlta;

        return $this;
    }

    /**
     * Get fecha_alta
     *
     * @return \DateTime 
     */
    public function getFechaAlta()
    {
        return $this->fecha_alta;
    }
	
    /**
     * Set equipoa
     *
     * @param string $equipoa
     * @return Partidos
     */
    public function setEquipoa($equipoa)
    {
    	$this->equipoa = $equipoa;
    
    	return $this;
    }
    
    /**
     * Get equipoa
     *
     * @return string
     */
    public function getEquipoa()
    {
    	return $this->equipoa;
    }
    
    /**
     * Set equipob
     *
     * @param string $equipob
     * @return Partidos
     */
    public function setEquipob($equipob)
    {
    	$this->equipob = $equipob;
    
    	return $this;
    }
    
    /**
     * Get equipob
     *
     * @return string
     */
    public function getEquipob()
    {
    	return $this->equipob;
    }
    
    /**
     * Set golesa
     *
     * @param integer $golesa
     * @return Jugadas
     */
    public function setGolesa($golesa)
    {
        $this->golesa = $golesa;

        return $this;
    }

    /**
     * Get golesa
     *
     * @return integer 
     */
    public function getGolesa()
    {
        return $this->golesa;
    }

    /**
     * Set golesb
     *
     * @param integer $golesb
     * @return Jugadas
     */
    public function setGolesb($golesb)
    {
        $this->golesb = $golesb;

        return $this;
    }

    /**
     * Get golesb
     *
     * @return integer 
     */
    public function getGolesb()
    {
        return $this->golesb;
    }

    /**
     * Set puntos
     *
     * @param integer $puntos
     * @return Jugadas
     */
    public function setPuntos($puntos)
    {
        $this->puntos = $puntos;

        return $this;
    }

    /**
     * Get puntos
     *
     * @return integer 
     */
    public function getPuntos()
    {
        return $this->puntos;
    }
				 /**
     * Set puntos
     *
     * @param integer $puntos
     * @return Jugadas
     */
    public function setProcesado($procesado)
    {
    	$this->procesado = $procesado;
    
    	return $this;
    }
    
    /**
     * Get puntos
     *
     * @return integer
     */
    public function getProcesado()
    {
    	return $this->procesado;
    }
}
