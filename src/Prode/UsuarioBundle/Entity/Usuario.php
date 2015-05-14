<?php
// src/Prode2014/FrontendBundle/Entity/Partidos.php
namespace Prode\UsuarioBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity
 * @ORM\Table(name="Usuario")
 * @UniqueEntity(fields="email", message="Email ya se encuentra en uso")
 * @UniqueEntity(fields="apodo", message="Apodo ya se encuentra en uso")
 * 
 */
class Usuario implements UserInterface {
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
	 * @ORM\Column(type="string", length=10, nullable=true)
	 */
	protected $dni;
	
	/**
	 * @ORM\Column(type="string", length=255)
	 * @Assert\Length(min = 6)
	 */
	protected $password;
	
	/**
	 * @ORM\Column(type="string", length=255)
	 */
	protected $empresa;
	
	/**
	 * @ORM\Column(type="integer", nullable=true)
	 */
	protected $estado;
	
	/**
	 * @ORM\Column(type="string", length=10)
	 * @Assert\Length(min = 6)
	 */
	protected $apodo;
	
	/**
	 * @ORM\Column(type="integer", nullable=true)
	 */
	protected $comision;
	
	/**
	 * @ORM\Column(type="integer", nullable=true)
	 */
	protected $sexo;
	
	/**
	 * @ORM\Column(type="date")
	 */
	protected $fecha_nacimiento;
	
	/**
	 * @Assert\Image(maxSize = "500k")
	 */
	protected $foto;
	
	/** @ORM\ManyToOne(targetEntity="Prode\BackendBundle\Entity\Paises") 
	 * */
	protected $pais;
	
	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	protected $ciudad;
	
	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	protected $area;
	
	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	protected $telefono;
	
	/**
	 * @ORM\Column(type="integer", nullable=true)
	 */
	protected $equipo;
	
	/**
	 * @ORM\Column(type="datetime")
	 */
	protected $fecha_alta;
	
	/**
	 * @ORM\Column(type="datetime")
	 */
	protected $fecha_modificacion;
	
	/**
	 * @ORM\Column(type="string", length=255)
	 */
	protected $salt;
	
	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	protected $token;
	
	/**
	 * @ORM\Column(type="integer")
	 */
	protected $deacuerdo;
	
	/**
	 * @ORM\Column(type="integer", nullable=true)
	 */
	protected $prodecomp;
	
	/**
	 * @ORM\Column(type="integer", nullable=true)
	 */
	protected $perfilpublico;
	
	/**
	 * @ORM\Column(type="integer", nullable=true)
	 */
	protected $jugadapublico;
	
	/**
	 * @ORM\Column(type="integer", nullable=true)
	 */
	protected $triviacomp;
	
	/**
	 * @ORM\Column(type="integer", nullable=true)
	 */
	protected $puntos;
	
		/**
	 * @ORM\Column(type="integer", nullable=true)
	 */
	protected $puntosventa;
	
	/**
	 * @ORM\Column(type="integer", nullable=true)
	 */
	protected $puntostrivia;
	
	/**
	 * @ORM\Column(type="integer", nullable=true)
	 */
	protected $puntospartido;
	
	/**
	 * @ORM\Column(type="integer", nullable=true)
	 */
	protected $puntoscambio;
	
	
	/**
	 * @ORM\Column(type="integer", nullable=true)
	 */
	protected $ingresos;
	
	/**
	 * @ORM\Column(type="integer", nullable=true)
	 */
	protected $puesto;
	
	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	protected $rutafoto;
	
	/**
	 * @ORM\Column(type="array")
	 */
	protected $roles;
	
	/**
	 * @ORM\Column(type="integer", nullable=true)
	 */
	protected $tipo;
	
	public function __construct() {
		$this->fecha_alta = new \DateTime ();
		$this->fecha_modificacion = new \DateTime ();
		$this->estado = '0';
		$this->puntos = '0';
		$this->prodecomp = '0';
		$this->triviacomp = '0';
		$this->comision = '';
		//$this->roles[] = 'ROLE_USUARIO';
	}
	function equals(\Symfony\Component\Security\Core\User\UserInterface $usuario) {
		return $this->getEmail () == $usuario->getEmail ();
	}
	function eraseCredentials() {
	}

	function getUserName() {
		return $this->getEmail ();
	}
	function getPassword() {
		return $this->password;
	}
	function getSalt() {
		return $this->salt;
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
	 * Set dni
	 *
	 * @param string $dni        	
	 * @return Usuario
	 */
	public function setDni($dni) {
		$this->dni = $dni;
		
		return $this;
	}
	
	/**
	 * Get dni
	 *
	 * @return string
	 */
	public function getDni() {
		return $this->dni;
	}
	
	/**
	 * Set password
	 *
	 * @param string $password        	
	 * @return Usuario
	 */
	public function setPassword($password) {
		$this->password = $password;
		
		return $this;
	}
	
	/**
	 * Set empresa
	 *
	 * @param string $empresa        	
	 * @return Usuario
	 */
	public function setEmpresa($empresa) {
		$this->empresa = $empresa;
		
		return $this;
	}
	
	/**
	 * Get empresa
	 *
	 * @return string
	 */
	public function getEmpresa() {
		return $this->empresa;
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
	 * Set apodo
	 *
	 * @param string $apodo        	
	 * @return Usuario
	 */
	public function setApodo($apodo) {
		$this->apodo = $apodo;
		
		return $this;
	}
	
	/**
	 * Get apodo
	 *
	 * @return string
	 */
	public function getApodo() {
		return $this->apodo;
	}
	
	/**
	 * Set comision
	 *
	 * @param integer $comision        	
	 * @return Usuario
	 */
	public function setComision($comision) {
		$this->comision = $comision;
		
		return $this;
	}
	
	/**
	 * Get comision
	 *
	 * @return integer
	 */
	public function getComision() {
		return $this->comision;
	}
	
	/**
	 * Set sexo
	 *
	 * @param integer $sexo        	
	 * @return Usuario
	 */
	public function setSexo($sexo) {
		$this->sexo = $sexo;
		
		return $this;
	}
	
	/**
	 * Get sexo
	 *
	 * @return integer
	 */
	public function getSexo() {
		return $this->sexo;
	}
	
	/**
	 * Set fecha_nacimiento
	 *
	 * @param \DateTime $fechaNacimiento        	
	 * @return Usuario
	 */
	public function setFechaNacimiento($fechaNacimiento) {
		$this->fecha_nacimiento = $fechaNacimiento;
		
		return $this;
	}
	
	/**
	 * Get fecha_nacimiento
	 *
	 * @return \DateTime
	 */
	public function getFechaNacimiento() {
		return $this->fecha_nacimiento;
	}
	
	/**
	 * Set pais
	 *
	 * @param string $pais        	
	 * @return Usuario
	 */
	public function setPais($pais) {
		$this->pais = $pais;
		
		return $this;
	}
	
	/**
	 * Get pais
	 *
	 * @return string
	 */
	public function getPais() {
		return $this->pais;
	}
	
	/**
	 * Set ciudad
	 *
	 * @param string $ciudad        	
	 * @return Usuario
	 */
	public function setCiudad($ciudad) {
		$this->ciudad = $ciudad;
		
		return $this;
	}
	
	/**
	 * Get ciudad
	 *
	 * @return string
	 */
	public function getCiudad() {
		return $this->ciudad;
	}
	
	/**
	 * Set area
	 *
	 * @param string $area
	 * @return area
	 */
	public function setArea($area) {
		$this->area = $area;
	
		return $this;
	}
	
	/**
	 * Get area
	 *
	 * @return string
	 */
	public function getArea() {
		return $this->area;
	}
	
	
	/**
	 * Set telefono
	 *
	 * @param string $telefono        	
	 * @return Usuario
	 */
	public function setTelefono($telefono) {
		$this->telefono = $telefono;
		
		return $this;
	}
	
	/**
	 * Get telefono
	 *
	 * @return string
	 */
	public function getTelefono() {
		return $this->telefono;
	}
	
	/**
	 * Set equipo
	 *
	 * @param integer $equipo        	
	 * @return Usuario
	 */
	public function setEquipo($equipo) {
		$this->equipo = $equipo;
		
		return $this;
	}
	
	/**
	 * Get equipo
	 *
	 * @return integer
	 */
	public function getEquipo() {
		return $this->equipo;
	}
	
	/**
	 * Set fecha_alta
	 *
	 * @param \DateTime $fechaAlta        	
	 * @return Usuario
	 */
	public function setFecha_Alta($fecha_alta) {
		$this->fecha_alta = $fecha_alta;
		
		return $this;
	}
	
	/**
	 * Get fecha_alta
	 *
	 * @return \DateTime
	 */
	public function getFecha_Alta() {
		return $this->fecha_alta;
	}
	
	/**
	 * Set fecha_modificacion
	 *
	 * @param \DateTime $fechaModificacion        	
	 * @return Usuario
	 */
	public function setFechaModificacion($fechaModificacion) {
		$this->fecha_modificacion = $fechaModificacion;
		
		return $this;
	}
	
	/**
	 * Get fecha_modificacion
	 *
	 * @return \DateTime
	 */
	public function getFechaModificacion() {
		return $this->fecha_modificacion;
	}
	
	/**
	 * Set salt
	 *
	 * @param string $salt        	
	 * @return Usuario
	 */
	public function setSalt($salt) {
		$this->salt = $salt;
		
		return $this;
	}
	
	/**
	 * Set deacuerdo
	 *
	 * @param integer $deacuerdo        	
	 * @return Usuario
	 */
	public function setDeacuerdo($deacuerdo) {
		$this->deacuerdo = $deacuerdo;
		
		return $this;
	}
	
	/**
	 * Get deacuerdo
	 *
	 * @return integer
	 */
	public function getDeacuerdo() {
		return $this->deacuerdo;
	}
	
	/**
	 * Set prodecomp
	 *
	 * @param integer $prodecomp        	
	 * @return Usuario
	 */
	public function setProdecomp($prodecomp) {
		$this->prodecomp = $prodecomp;
		
		return $this;
	}
	
	/**
	 * Get prodecomp
	 *
	 * @return integer
	 */
	public function getProdecomp() {
		return $this->prodecomp;
	}
	
	/**
	 * Set perfilpublico
	 *
	 * @param integer $perfilpublico
	 * @return Usuario
	 */
	public function setPerfilpublico($perfilpublico) {
		$this->perfilpublico = $perfilpublico;
	
		return $this;
	}
	
	/**
	 * Get perfilpublico
	 *
	 * @return integer
	 */
	public function getPerfilpublico() {
		return $this->perfilpublico;
	}
	
	/**
	 * Set jugadapublico
	 *
	 * @param integer $jugadapublico
	 * @return Usuario
	 */
	public function setJugadapublico($jugadapublico) {
		$this->jugadapublico = $jugadapublico;
	
		return $this;
	}
	
	/**
	 * Get jugadapublico
	 *
	 * @return integer
	 */
	public function getJugadapublico() {
		return $this->jugadapublico;
	}
	
	/**
	 * Set triviacomp
	 *
	 * @param integer $triviacomp
	 * @return Usuario
	 */
	public function setTriviacomp($triviacomp) {
		$this->triviacomp = $triviacomp;
	
		return $this;
	}
	
	/**
	 * Get triviacomp
	 *
	 * @return integer
	 */
	public function getTriviacomp() {
		return $this->triviacomp;
	}
	
	/**
	 * Set puntos
	 *
	 * @param integer $puntos        	
	 * @return Usuario
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
	 * Set puntoscambio
	 *Puntos para cambiar por premios
	 *
	 * @param integer $puntoscambio
	 * @return Usuario
	 */
	public function setPuntoscambio($puntoscambio) {
		$this->puntoscambio = $puntoscambio;
	
		return $this;
	}
	
	/**
	 * Get puntoscambio
	 * Puntos para cambiar por premios
	 *
	 * @return integer
	 */
	public function getPuntoscambio() {
		return $this->puntoscambio;
	}

	/**
	 * Set puntospartido
	 *
	 * @param integer $puntospartido
	 * @return Usuario
	 */
	public function setPuntospartido($puntospartido) {
		$this->puntospartido = $puntospartido;
	
		return $this;
	}
	
	/**
	 * Get puntospartido
	 *
	 * @return integer
	 */
	public function getPuntospartido() {
		return $this->puntospartido;
	}
	
	/**
	 * Set puntostrivia
	 *
	 * @param integer $puntostrivia
	 * @return Usuario
	 */
	public function setPuntostrivia($puntostrivia) {
		$this->puntostrivia = $puntostrivia;
	
		return $this;
	}
	
	/**
	 * Get puntostrivia
	 *
	 * @return integer
	 */
	public function getPuntostrivia() {
		return $this->puntostrivia;
	}
	
	/**
	 * Set puntosventa
	 *
	 * @param integer $puntosventa
	 * @return Usuario
	 */
	public function setPuntosventa($puntosventa) {
		$this->puntosventa = $puntosventa;
	
		return $this;
	}
	
	/**
	 * Get puntosventa
	 *
	 * @return integer
	 */
	public function getPuntosventa() {
		return $this->puntosventa;
	}	
	
	/**
	 * Set puesto
	 *
	 * @param integer $puesto
	 * @return puesto
	 */
	public function setPuesto($puesto) {
		$this->puesto = $puesto;
	
		return $this;
	}
	
	/**
	 * Get puesto
	 *
	 * @return integer
	 */
	public function getPuesto() {
		return $this->puesto;
	}
	
	/**
	 * Set ingresos
	 *
	 * @param integer $ingresos        	
	 * @return Usuario
	 */
	public function setIngresos($ingresos) {
		$this->ingresos = $ingresos;
		
		return $this;
	}
	
	/**
	 * Get ingresos
	 *
	 * @return integer
	 */
	public function getIngresos() {
		return $this->ingresos;
	}
	
	/**
	 * Set token
	 *
	 * @param string $token        	
	 * @return Usuario
	 */
	public function setToken($token) {
		$this->token = $token;
		
		return $this;
	}
	
	/**
	 * Get token
	 *
	 * @return string
	 */
	public function getToken() {
		return $this->token;
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
		$nombreArchivoFoto = uniqid ( 'cupon-' ) . '-foto1.jpg';
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
     * Set role
     *
     * @param array $role
     * @return Usuario
     */
    function getRoles() {
    	/*return array ('ROLE_USUARIO');*/
    	return $this->roles;
    }
    public function setRoles($roles)
    {
        $this->roles[] = $roles;

        return $this;
    }
    
    
    /**
     * Set estado
     *
     * @param integer $estado
     * @return Usuario
     */
    public function setTipo($tipo) {
    	$this->tipo = $tipo;
    
    	return $this;
    }
    
    /**
     * Get estado
     *
     * @return integer
     */
    public function getTipo() {
    	return $this->tipo;
    }


}
