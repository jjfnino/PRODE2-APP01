<?php
// src/Prode2014/BackendBundle/Entity/Premios.php
namespace Prode\BackendBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity
 * @ORM\Table(name="Premios")
 * */
class Premios
{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue
	 */
	protected $id;
	/** @ORM\Column(type="string", length=150) */
	protected $titulo;
	/** @ORM\Column(type="integer", nullable=true) */
	protected $categoria;
	/** @ORM\Column(type="integer") */
	protected $puesto;
	/** @ORM\Column(type="integer", nullable=true) */
	protected $orden;
	/**
	 * @Assert\Image(maxSize = "500k")
	 */
	protected $foto;
	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	protected $rutafoto;
	
	/** @ORM\Column(type="integer") */
	protected $estado;
	/** @ORM\Column(type="integer", nullable=true) */
	protected $style;
	/** @ORM\Column(type="string", length=150) */
	protected $detalle;
	
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
     * @return Premios
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
     * Set puesto
     *
     * @param integer $puesto
     * @return Premios
     */
    public function setPuesto($puesto)
    {
        $this->puesto = $puesto;

        return $this;
    }

    /**
     * Get puesto
     *
     * @return integer 
     */
    public function getPuesto()
    {
        return $this->puesto;
    }

    /**
     * Set orden
     *
     * @param integer $orden
     * @return Premios
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
    	$nombreArchivoFoto = uniqid ( 'premios-' ) . '-foto1.jpg';
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
     * Set categoria
     *
     * @param string $categoria
     * @return Premios
     */
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get categoria
     *
     * @return string 
     */
    public function getCategoria()
    {
        return $this->categoria;
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
    
    /**
     * Get style
     *
     * @return integer
     */
    public function getStyle()
    {
    	return $this->style;
    }
    
    /**
     * Set style
     *
     * @param integer $style
     * @return Style
     */
    public function setStyle($style)
    {
    	$this->style = $style;
    
    	return $this;
    }

   
    /**
     * Get detalle
     *
     * @return integer
     */
    public function getDetalle()
    {
    	return $this->detalle;
    }
    
    /**
     * Set detalle
     *
     * @param integer $detalle
     * @return Detalle
     */
    public function setDetalle($detalle)
    {
    	$this->detalle = $detalle;
    
    	return $this;
    }
    
   

}
