<?php
// src/Prode2014/FrontendBundle/Entity/Partidos.php
namespace Prode\BackendBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/** 
 * @ORM\Entity 
 * @ORM\Table(name="Partidos")
 * */
class Partidos
{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue
	 */
	protected $id;
	
	/** @ORM\Column(type="string", length=3) */
	protected $ronda;
	
	/** @ORM\Column(type="string", length=3) */
	protected $grupo;
	
	/** @ORM\ManyToOne(targetEntity="Prode\BackendBundle\Entity\Equipos") 
	
	 * */
	protected $equipoa;
	/** @ORM\ManyToOne(targetEntity="Prode\BackendBundle\Entity\Equipos") 
	 * */
	protected $equipob;
	
	/** @ORM\Column(type="integer", nullable=true) */
	protected $golesa;
	
	/** @ORM\Column(type="integer", nullable=true) */
	protected $golesb;
	
	/** @ORM\Column(type="time") */
	protected $hora;
	
	/** @ORM\Column(type="date") */
	protected $fecha;
	
	/** @ORM\ManyToOne(targetEntity="Prode\BackendBundle\Entity\Sedes") 
	 * @ORM\JoinColumn(name="sede_id", referencedColumnName="id")
	 * */
	protected $sede;
	
	/** @ORM\Column(type="integer") */
	protected $estado;
	
	public function __construct() {
	
		$this->estado = '0';
	
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
     * Set ronda
     *
     * @param string $ronda
     * @return Ronda
     */
    public function setRonda($ronda)
    {
    	$this->ronda = $ronda;
    
    	return $this;
    }
    
    /**
     * Get ronda
     *
     * @return string
     */
    public function getRonda()
    {
    	return $this->ronda;
    }

    /**
     * Set grupo
     *
     * @param string $grupo
     * @return Partidos
     */
    public function setGrupo($grupo)
    {
        $this->grupo = $grupo;

        return $this;
    }

    /**
     * Get grupo
     *
     * @return string 
     */
    public function getGrupo()
    {
        return $this->grupo;
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
     * @return Partidos
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
     * @return Partidos
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
     * Set hora
     *
     * @param \DateTime $hora
     * @return Partidos
     */
    public function setHora($hora)
    {
        $this->hora = $hora;

        return $this;
    }

    /**
     * Get hora
     *
     * @return \DateTime 
     */
    public function getHora()
    {
        return $this->hora;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Partidos
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFecha()
    {
        return $this->fecha;
    }


   

    /**
     * Set sede
     *
     * @param \Prode2014\BackendBundle\Entity\Sede $sede
     * @return Partidos
     */
    public function setSede(\Prode\BackendBundle\Entity\Sedes $sede = null)
    {
        $this->sede = $sede;

        return $this;
    }

    /**
     * Get sede
     *
     * @return \Prode2014\BackendBundle\Entity\Sede 
     */
    public function getSede()
    {
        return $this->sede;
    }
    
    public function __toString()
    {
    	return $this->getId();
    }
    
    /**
     * Get estado
     *
     * @return integer
     */
    public function getEstado()
    {
    	return $this->estado;
    }
    
    /**
     * Set orden
     *
     * @param integer $orden
     * @return Premios
     */
    public function setEstado($estado)
    {
    	$this->estado = $estado;
    
    	return $this;
    }
}
