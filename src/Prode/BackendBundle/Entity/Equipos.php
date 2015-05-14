<?php
// src/Prode2014/BackendBundle/Entity/Paises.php
namespace Prode\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity
 * @ORM\Table(name="Equipos")
 * */
class Equipos
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
	/**
	 * @Assert\Image(maxSize = "500k")
	 */
	protected $foto;
	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	protected $rutafoto;

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
    /**
     *
     * @param UploadedFile $foto
     */
    public function setFoto(UploadedFile $foto = null) {
    	$this->foto = $foto;
    }
    /**
     *
     * @return UploadedFile
     */
    public function getFoto() {
    	return $this->foto;
    }
    public function subirFoto() {
    	if (null === $this->foto) {
    		return;
    	}
    	$directorioDestino = __DIR__ . '/../../../../web/uploads/images';
    	$nombreArchivoFoto = uniqid ( 'equipos-' ) . '-foto1.jpg';
    	$this->foto->move( $directorioDestino, $nombreArchivoFoto );
    	$this->setRutaFoto( $nombreArchivoFoto );
    }
    /**
     * Set ruta_foto
     *
     * @param string $rutaFoto
     * @return Usuario
     */
    public function setRutaFoto($rutafoto)
    {
    	$this->rutafoto = $rutafoto;
    
    	return $this;
    }
    
    /**
     * Get ruta_foto
     *
     * @return string
     */
    public function getRutaFoto()
    {
    	return $this->rutafoto;
    }
    /**
     * Set path
     *
     * @param string $path
     * @return Path
     */
    public function setPath($path)
    {
    	$this->path = $path;
    
    	return $this;
    }
    
    /**
     * Get Path
     *
     * @return string
     */
    public function getPath()
    {
    	return $this->path;
    }
   
}
