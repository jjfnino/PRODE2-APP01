<?php

namespace Prode\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Prode\UsuarioBundle\Entity\Usuario;
use Prode\BackendBundle\Form\Backend\UsuarioType;
use Prode\BackendBundle\Form\Backend\UsuarioEditType;
use Prode\UsuarioBundle\Form\Frontend\EditType;
use Prode\UsuarioBundle\Form\Frontend\PasswordType;
use Symfony\Component\HttpFoundation\RedirectResponse;

class UsuariosController extends Controller
{
    public function indexAction()
    {
    	$usuario = $this->get ( 'security.context' )->getToken ()->getUser ();
    	$peticion = $this->getRequest ();
    	$estado = $peticion->query->get ( 's' ); // status
    	
    	$btn = '1';
    	
    	if($estado != '0' && $estado != '1'){
    		$estado = '1';
    	}
    	
    	if($estado == '0'){
    		$btn = '0';
    	}else{
    		$btn = '1';
    	}
    	$em = $this->getDoctrine ()->getManager ();
    	
    	$activos = $em->createQuery ( 'SELECT c
											  FROM UsuarioBundle:Usuario c
											  WHERE c.estado = :estado
										  ORDER BY c.fecha_alta ASC' );
    	$activos->setParameter ( 'estado', $estado);
    	
    	/* Total para paginador <--- */
    	$usuarios = $activos->getResult ();
    	
    	
        return $this->render('BackendBundle:Usuarios:index.html.twig', array (
				'usuarios' => $usuarios,
        		'boton' => $btn,
		) );
    }
    
    public function addAction() {
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
    			
    			
    			
    		/*$tipoactivacion = $this->container->getParameter ( 'prode.activacion_usuarios_automatica' );
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
    		}*/
    			
    		return $this->redirect ( $this->generateUrl ( 'backend_usuarios' ) );
    	}
    
    	return $this->render ( 'BackendBundle:Usuarios:add.html.twig', array (
    			'formulario' => $formulario->createView (),
    			'seccion' => 'registro',
    			'pais' => $pais
    	) );
    }
    
    public function estadoAction() {
    
    	$partidos = new Usuario();
    	$peticion = $this->getRequest ();
    	$idusuario = $this->getRequest ()->query->get ( 'i' );
    	$estado = $this->getRequest ()->query->get ( 'e' );
    
    	if($estado == '0' || $estado == '1'){
    
    		$em = $this->getDoctrine ()->getManager ();
    		$query = $em->createQuery ( 'UPDATE UsuarioBundle:Usuario o SET o.estado = :estado WHERE o.id = :id' );
    		$query->setParameter ( 'estado', $estado );
    		$query->setParameter ( 'id', $idusuario );
    		$query->execute ();
    
    	}
    
    	return new RedirectResponse ( $this->generateUrl ( 'backend_usuarios' ) );
    }
    
    public function editAction($id) {
    	$em = $this->getDoctrine ()->getManager ();
    	$usuario = $em->getRepository ( 'UsuarioBundle:Usuario' )->find ( $id );
    	if (!$usuario) {
    		throw $this->createNotFoundException('No existe usuario');
    	}
    	
    	$formulario = $this->createForm ( new UsuarioEditType (), $usuario );
    	$peticion = $this->getRequest();
    	$formulario->handleRequest($peticion);
    	if ($formulario->isValid ()) {
    		$em = $this->getDoctrine()->getManager();
    		$em->persist($usuario);
    		
    		$em->flush();
    		return new RedirectResponse ( $this->generateUrl ( 'backend_usuarios' ) );
    	}
    	
    	$em = $this->getDoctrine ()->getManager ();
    	 
    	$consulta = $em->createQuery ( 'SELECT c
											  FROM UsuarioBundle:Usuario c
											  WHERE c.id = :id' );
    	$consulta->setParameter ( 'id', $id);
    	 
    	/* Total para paginador <--- */
    	$usuario_edit = $consulta->getResult ();
    	
    	return $this->render ( 'BackendBundle:Usuarios:edit.html.twig', array (
    			'formulario' => $formulario->createView (),
    			'id' => $id,
    			'usuario' => $usuario_edit,
    
    	) );
    }
}
