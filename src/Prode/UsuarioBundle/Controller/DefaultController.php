<?php

namespace Prode\UsuarioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Prode\UsuarioBundle\Form\Frontend\UsuarioType;
use Prode\UsuarioBundle\Form\Frontend\EditType;
use Prode\UsuarioBundle\Form\Frontend\PasswordType;
use Prode\FrontendBundle\Form\Frontend\MensajeType;
use Prode\UsuarioBundle\Entity\Usuario;
use Prode\UsuarioBundle\Entity\Mensaje;
use Prode\BackendBundle\Entity\Ingresos;
use Symfony\Component\HttpFoundation\RedirectResponse;

class DefaultController extends Controller {
	
	public function inactivoAction($name) {
		return $this->render ( 'UsuarioBundle:Default:index.html.twig', array (
				'name' => $name,
				'seccion' => 'inactivo'
		) );
	}
	
	public function indexAction($name) {
		return $this->render ( 'UsuarioBundle:Default:index.html.twig', array (
				'name' => $name,
				'seccion' => 'usuarios' 
		) );
	}
	public function registrookAction() {
		$tipoactivacion = $this->container->getParameter ( 'prode.activacion_usuarios_automatica' );
		return $this->render ( 'UsuarioBundle:Default:registrook.html.twig', array (
				
				'seccion' => 'ok',
				'activacion' => $tipoactivacion 
		) );
	}
	public function activarAction() {
		$peticion = $this->getRequest ();
		
		$id = $peticion->query->get ( 'i' );
		$salt = $peticion->query->get ( 't' );
		
		$em = $this->getDoctrine ()->getManager ();
		$query2 = $em->createQuery ( 'SELECT p FROM UsuarioBundle:Usuario p WHERE p.id = :id AND p.salt = :salt' );
		$query2->setParameter ( 'id', $id );
		$query2->setParameter ( 'salt', $salt );
		$validar = $query2->getResult ();
		unset ( $em );
		if ($validar) {
			
			$em_usr = $this->getDoctrine ()->getManager ();
			$query2 = $em_usr->createQuery ( 'SELECT p FROM UsuarioBundle:Usuario p WHERE p.estado = 1' );
			$quests = $query2->getResult ();
			$total_usuarios = count ( $quests );
			$total_usuarios = $total_usuarios + 1;
			
			$em = $this->getDoctrine ()->getManager ();
			$query = $em->createQuery ( 'UPDATE UsuarioBundle:Usuario o SET o.estado = 1, o.puesto = :puesto WHERE o.id = :id AND o.salt = :salt' );
			$query->setParameter ( 'puesto', $total_usuarios );
			$query->setParameter ( 'id', $id );
			$query->setParameter ( 'salt', $salt );
			// this will add the LIMIT statement
			$query->setMaxResults ( 20 );
			$query->execute ();
		}
		
		return $this->render ( 'UsuarioBundle:Default:activar.html.twig' );
	}
	public function ingresosAction() {
		
		/* INICIO - Contabilizar Ingresos totales por usuario*/
		
		$usuario = $this->get ( 'security.context' )->getToken ()->getUser ();
		$id = $usuario->getId();
		$ingresos = $usuario->getIngresos();
		$ingresos = $ingresos + 1;
		
		$em = $this->getDoctrine ()->getManager ();
		$query = $em->createQuery ( 'UPDATE UsuarioBundle:Usuario o SET o.ingresos = :ingresos WHERE o.id = :id ' );
		$query->setParameter ( 'id', $id );
		$query->setParameter ( 'ingresos', $ingresos );
		$query->execute ();
		/* FIN - Contabilizar Ingresos totales por usuario*/
		
		/* INICIO - Contabilizar Ingresos totales por dia*/
		
		$em = $this->getDoctrine ()->getManager ();
		$query3 = $em->createQuery ( 'SELECT p FROM BackendBundle:Ingresos p WHERE p.fecha = CURRENT_DATE() ' );
		$ingresoshoy = $query3->getResult ();
		 
		if($ingresoshoy == null){
			$ingresos = new Ingresos ();
			$ingresos->setFecha(new \DateTime());
			$ingresos->setCantidad('1');
		
			$em = $this->getDoctrine ()->getManager ();
			$em->persist ( $ingresos );
			$em->flush ();
		
			unset ( $ingresos );
		}else{
			$hoy = date("Y-m-d");
			$cantidad = $ingresoshoy[0]->getCantidad() + '1';
			$em = $this->getDoctrine ()->getManager ();
			$query2 = $em->createQuery ( 'UPDATE BackendBundle:Ingresos o SET o.cantidad = :cant  WHERE o.fecha = :now ' );
			$query2->setParameter('now', $hoy);
			$query2->setParameter('cant', $cantidad);
			$query2->execute ();
			 
		}
		
		/* FIN - Contabilizar Ingresos totales por dia*/
		return $this->redirect ( $this->generateUrl ( 'frontend_portada' ) );
	}
	public function perfilAction() {
		$usuario = $this->get ( 'security.context' )->getToken ()->getUser ();
		$formulario = $this->createForm ( new EditType (), $usuario );
		$peticion = $this->getRequest ();
		$formulario->handleRequest ( $peticion );
		
		if ($formulario->isValid ()) {
			if (null == $usuario->getPassword ()) {
				$usuario->setPassword ( $passwordOriginal );
			} else {
				$encoder = $this->get ( 'security.encoder_factory' )->getEncoder ( $usuario );
				$passwordCodificado = $encoder->encodePassword ( $usuario->getPassword (), $usuario->getSalt () );
				$usuario->setPassword ( $passwordCodificado );
			}
			$em = $this->getDoctrine ()->getManager ();
			$em->persist ( $usuario );
			$em->flush ();
			$this->get ( 'session' )->getFlashBag ()->add ( 'info', 'Los datos de tu perfil se han actualizado correctamente' );
			return $this->redirect ( $this->generateUrl ( 'usuario_perfil' ) );
		}
		
		return $this->render ( 'UsuarioBundle:Default:perfil.html.twig', array (
				'usuario' => $usuario,
				'seccion' => 'perfil',
				'formulario' => $formulario->createView () 
		) );
	}
	/**
	 * @Route("/login_check", name="_security_check")
	 */
	public function login_checkAction() {
		// The security layer will intercept this request
	}
	
	/**
	 * @Route("/logout", name="_demo_logout")
	 */
	public function logoutAction() {
		// The security layer will intercept this request
	}
	public function loginAction() {
		$peticion = $this->getRequest ();
		$sesion = $peticion->getSession ();
		
		$error = $peticion->attributes->get ( SecurityContext::AUTHENTICATION_ERROR, $sesion->get ( SecurityContext::AUTHENTICATION_ERROR ) );
		return $this->render ( 'UsuarioBundle:Default:login.html.twig', array (
				'last_username' => $sesion->get ( SecurityContext::LAST_USERNAME ),
				'seccion' => 'login',
				'error' => $error 
		) );
	}
	public function cajaLoginAction() {
		$usuario = $this->get ( 'security.context' )->getToken ()->getUser ();
		$peticion = $this->getRequest ();
		$sesion = $peticion->getSession ();
		$puntos = '0';
		if ($this->get ( 'security.context' )->isGranted ( 'ROLE_USUARIO' )) {
			$email = $usuario->getEmail ();
			$puntos = $usuario->getPuntos ();
			if (! $puntos) {
				$puntos = 0;
			}
		}
		$error = $peticion->attributes->get ( 

		SecurityContext::AUTHENTICATION_ERROR, $sesion->get ( SecurityContext::AUTHENTICATION_ERROR ) );
		return $this->render ( 'UsuarioBundle:Default:cajaLogin.html.twig', array (
				'last_username' => $sesion->get ( SecurityContext::LAST_USERNAME ),
				'usuario' => $usuario,
				'puntos' => $puntos,
				// 'posicion' => $posicion,
				'error' => $error 
		) );
		// return $this->render('FrontendBundle:Default:login.html.twig');
	}
	public function registroAction() {
		$peticion = $this->getRequest ();
		$pais = $this->container->getParameter ( 'prode.pais' );
		$usuario = new Usuario ();
		$formulario = $this->createForm ( new UsuarioType (), $usuario );
		
		$formulario->handleRequest ( $peticion );
		if ($formulario->isValid ()) {
			$encoder = $this->get ( 'security.encoder_factory' )->getEncoder ( $usuario );
			$usuario->setSalt ( md5 ( time () ) );
			$email = $usuario->getEmail ();
			$passwordCodificado = $encoder->encodePassword ( $usuario->getPassword (), $usuario->getSalt () );
			$usuario->setPassword ( $passwordCodificado );
			$em = $this->getDoctrine ()->getManager ();
			$em->persist ( $usuario );
			$usuario->subirFoto ();
			$em->flush ();
			
			
			
			$tipoactivacion = $this->container->getParameter ( 'prode.activacion_usuarios_automatica' );
			if ($tipoactivacion) {
				$mensaje = \Swift_Message::newInstance ()->setSubject ( 'Activar usuario | Promo Mundial | Brasil 2014' )->setFrom ( 'soporte@segurviajeesmundial.com' )->setTo ( $email )->setBody ( $this->renderView ( 'UsuarioBundle:Default:mailactivacion.html.twig', array (
						'pais' => $pais,
						'usuario' => $usuario 
				) ), 'text/html' );
				$this->get ( 'mailer' )->send ( $mensaje );
			} else {
				$mensaje = \Swift_Message::newInstance ()->setSubject ( 'Registro | Promo Mundial | Brasil 2014' )->setFrom ( 'soporte@segurviajeesmundial.com' )->setTo ( $email )->setBody ( $this->renderView ( 'UsuarioBundle:Default:mailregistrook.html.twig', array (
						
						'usuario' => $usuario 
				) ), 'text/html' );
				$this->get ( 'mailer' )->send ( $mensaje );
			}
			
			return $this->redirect ( $this->generateUrl ( 'usuario_registrook' ) );
		}
		
		return $this->render ( 'UsuarioBundle:Default:registro.html.twig', array (
				'formulario' => $formulario->createView (),
				'seccion' => 'registro',
				'pais' => $pais 
		) );
	}
	public function addmensajeAction() {
		$mensaje = new Mensaje ();
		$peticion = $this->getRequest ();
		
		$usuario = $this->get ( 'security.context' )->getToken ()->getUser ();
		$formulario = $this->createForm ( new MensajeType (), $mensaje );
		$formulario->handleRequest ( $peticion );
		
		if ($formulario->isValid ()) {
			$em = $this->getDoctrine ()->getManager ();
			$em->persist ( $mensaje );
			
			$em->flush ();
			return new RedirectResponse ( $this->generateUrl ( 'pagina_ayuda' ) );
		}
		return $this->render ( 'FrontendBundle:Default:ayuda.html.twig' );
	}
	public function clavemailAction() {
		$peticion = $this->getRequest ();
		//echo $email = $peticion->query->get ( 'e' );
		$email = $peticion->request->get ( 'e' );
		/*
		 * $id = $peticion->query->get ( 'i' ); 
		 * $salt = $peticion->query->get ( 't' );
		 */
		$total_usuarios = '5';
		$mensaje = '';
		if (isset ( $_POST ['mail_submit'] )) {
			$usuario = New Usuario();
			$em = $this->getDoctrine ()->getManager ();
			$query2 = $em->createQuery ( 'SELECT p FROM UsuarioBundle:Usuario p WHERE p.email = :email AND p.estado = 1' );
			$query2->setParameter ( 'email', $email );
			/*
			 * $query2->setParameter ( 'id', $id ); $query2->setParameter ( 'salt', $salt );
			 */
			$usuario = $query2->getResult ();
			//$usuario = $query2->getResult ();

			$total_usuarios = count ( $usuario );
			$pais = $this->container->getParameter ( 'prode.pais' );
			if ($total_usuarios > '0') {
				
				$mensaje = \Swift_Message::newInstance ()->setSubject ( 'Cambio Password | Promo Mundial | Brasil 2014' )->setFrom ( 'soporte@segurviajeesmundial.com' )->setTo ( $email )->setBody ( $this->renderView ( 'UsuarioBundle:Default:mailclavenueva.html.twig', array (
						'pais' => $pais,
						'usuario' => $usuario
				) ), 'text/html' );
				$this->get ( 'mailer' )->send ( $mensaje );
				
				$mensaje = 'Le hemos enviado un Mail con indicaciones para que renueve su clave';
			} else {
				$mensaje = 'E-Mail inexistente o cuenta inactiva.';
			}
		}
		return $this->render ( 'UsuarioBundle:Default:clavemail.html.twig', array (
				'seccion' => 'pass',
				'email' => $email,
				'totalusaurios' => $total_usuarios,
				'mensaje' => $mensaje 
		) );
	}
	public function clavecambiarAction(){
		$peticion = $this->getRequest();
		
		$id = $peticion->query->get ( 'i' ); 
		$salt = $peticion->query->get ( 't' );
		if(!$id){
			$id = $_POST ['id'];
			$salt = $_POST ['salt'];
		}
		
		//if(!$id && !$salt){
		$usuario = New Usuario(); //$this->get('security.context')->getToken()->getUser();
			
			$em = $this->getDoctrine ()->getManager ();
			$query2 = $em->createQuery ( 'SELECT p FROM UsuarioBundle:Usuario p WHERE p.id = :id AND p.salt = :salt' );
			$query2->setParameter ( 'id', $id );
			$query2->setParameter ( 'salt', $salt );
			$usuario = $query2->getSingleResult ();
		//}
		
		$formulario = $this->createForm(new PasswordType(), $usuario);
		$passwordOriginal = $formulario->getData()->getPassword();
		$formulario->handleRequest($peticion);
		if ($formulario->isValid()) {
		
			if (null == $usuario->getPassword()) {
				$usuario->setPassword($passwordOriginal);
			} else {
				$encoder = $this->get('security.encoder_factory')->getEncoder($usuario);
				$passwordCodificado = $encoder->encodePassword(
						$usuario->getPassword(),
						$usuario->getSalt()
				);
				$usuario->setPassword($passwordCodificado);
			}
			$em = $this->getDoctrine()->getManager();
			$em->persist($usuario);
			$em->flush();
			$this->get('session')->getFlashBag()->add('info',
					'Clave actualizada correctamente!'
			);
			return $this->redirect($this->generateUrl('usuario_clavecambiar', array('i' => $id, 't' => $salt)));
		}else{
			
		}
		return $this->render('UsuarioBundle:Default:clavecambiar.html.twig', array(
				'seccion' => 'pass',
				'i' => $id,
				't' => $salt,
				'usuario' => $usuario,
				'formulario' => $formulario->createView()
		));
	}
	
	
}
