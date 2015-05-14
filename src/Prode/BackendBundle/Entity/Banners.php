<?php
// src/Prode2014/BackendBundle/Entity/Banners.php
namespace Prode\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity
 * @ORM\Table(name="Banners")
 * */
class Banners
{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue
	 */
	protected $id;
	/** @ORM\Column(type="string", length=150) */
	protected $titulo;
	/** @ORM\Column(type="string", length=10) */
	protected $seccion;
	/** @ORM\Column(type="integer", nullable=true) */
	protected $estado;	
	/** @ORM\Column(type="integer", nullable=true) */
	protected $orden;

	/** @ORM\Column(type="integer", nullable=true) */
	protected $width;
	
	/** @ORM\Column(type="integer", nullable=true) */
	protected $height;
	/**
	 * @Assert\Image(maxSize = "500k")
	 */
	protected $foto;
	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	protected $rutafoto;
	/** @ORM\Column(type="string", length=255, nullable=true) */
	protected $url;

	

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
     * Set titulo
     *
     * @param string $titulo
     * @return Banners
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get titulo
     *
     * @return string 
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set seccion
     *
     * @param string $seccion
     * @return Banners
     */
    public function setSeccion($seccion)
    {
        $this->seccion = $seccion;

        return $this;
    }

    /**
     * Get seccion
     *
     * @return string 
     */
    public function getSeccion()
    {
        return $this->seccion;
    }

    /**
     * Set imagen
     *
     * @param string $imagen
     * @return Banners
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;

        return $this;
    }

    /**
     * Get imagen
     *
     * @return string 
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return Banners
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set orden
     *
     * @param integer $orden
     * @return Banners
     */
    public function setOrden($orden)
    {
        $this->orden = $orden;

        return $this;
    }

    /**
     * Get orden
     *
     * @return integer 
     */
    public function getOrden()
    {
        return $this->orden;
    }

    /**
     * Set orden
     *
     * @param integer $estado
     * @return Banners
     */
    public function setEstado($estado)
    {
    	$this->estado = $estado;
    
    	return $this;
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
    	$nombreArchivoFoto = uniqid ( 'banners-' ) . '-foto1.jpg';
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
    
	
    /**
     * Set width
     *
     * @param integer $width
     * @return width
     */
    public function setWidth($width)
    {
    	$this->width = $width;
    
    	return $this;
    }
    
    /**
     * Get width
     *
     * @return integer
     */
    public function getWidth()
    {
    	return $this->width;
    }
    
    /**
     * Set height
     *
     * @param integer $height
     * @return height
     */
    public function setHeight($height)
    {
    	$this->height = $height;
    
    	return $this;
    }
    
    /**
     * Get height
     *
     * @return integer
     */
    public function getHeight()
    {
    	return $this->height;
    }

}
