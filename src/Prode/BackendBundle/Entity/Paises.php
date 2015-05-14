<?php
// src/Prode2014/BackendBundle/Entity/Paises.php
namespace Prode\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Paises")
 * */
class Paises
{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue
	 */
	protected $id;
	/** @ORM\Column(type="string", length=150) */
	protected $nombre;
	/** @ORM\Column(type="string", length=150, nullable=true) */
	protected $bandera;
	/** @ORM\Column(type="string", nullable=true) */
	protected $grupo;
	
	public function __toString()
	{
		return $this->getNombre();
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
     * Set nombre
     *
     * @param string $nombre
     * @return Paises
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set bandera
     *
     * @param string $bandera
     * @return Paises
     */
    public function setBandera($bandera)
    {
        $this->bandera = $bandera;

        return $this;
    }

    /**
     * Get bandera
     *
     * @return string 
     */
    public function getBandera()
    {
        return $this->bandera;
    }

    /**
     * Set grupo
     *
     * @param string $grupo
     * @return Paises
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
    
    
}
