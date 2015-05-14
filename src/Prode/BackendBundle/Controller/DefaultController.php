<?php

namespace Prode\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('BackendBundle:Default:index.html.twig', array('name' => $name));
    }
    public function loginAction()
    {
    	
    	$peticion = $this->getRequest ();
    	$sesion = $peticion->getSession ();
    	
    	$error = $peticion->attributes->get ( SecurityContext::AUTHENTICATION_ERROR, $sesion->get ( SecurityContext::AUTHENTICATION_ERROR ) );
    	return $this->render ( 'BackendBundle:Default:login.html.twig', array (
    			'last_username' => $sesion->get ( SecurityContext::LAST_USERNAME ),
    			'seccion' => 'login',
    			'error' => $error
    	) );
    	
    	//return $this->render('BackendBundle:Default:login.html.twig');
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
    	return $this->render ( 'BackendBundle:Default:cajaLogin.html.twig', array (
    			'last_username' => $sesion->get ( SecurityContext::LAST_USERNAME ),
    			'usuario' => $usuario,
    			'puntos' => $puntos,
    			// 'posicion' => $posicion,
    			'error' => $error
    	) );
    	// return $this->render('FrontendBundle:Default:login.html.twig');
    }
}
