<?php

namespace Prode\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Prode\BackendBundle\Entity\Ingresos;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('FrontendBundle:Default:index.html.twig');
    }
    
    public function premiosAction()
    {
    	$peticion = $this->getRequest ();
    	$categoria = $peticion->query->get ( 'c' ); // categoria
    	
    	$em = $this->getDoctrine ()->getManager ();
    	
    	if(!$categoria){
    		$categoria = '1';
    	}else{
    		$categoria = '2';
    	}
    	 
    	$activos = $em->createQuery ( 'SELECT c
										  FROM BackendBundle:Premios c
											  WHERE c.categoria = :categoria
    			 								AND c.estado = 1' );
    	$activos->setParameter ( 'categoria', $categoria);
    	 
    	/* Total para paginador <--- */
    	$premios = $activos->getResult ();
    	
    	return $this->render('FrontendBundle:Default:premios.html.twig', array (
	
				'premios' => $premios,
    			'categoria' => $categoria,
		) );
    }
    
    public function reglamentoAction()
    {
    	return $this->render('FrontendBundle:Default:reglamento.html.twig');
    }
    public function portadaAction()
    {
    	
    	
    	$usuario = $this->get ( 'security.context' )->getToken ()->getUser ();
    	$puesto = $usuario->getPuesto();
    	$puntospartido = $usuario->getPuntospartido();
    	$puntos = $usuario->getPuntos();
    	$puntosventa = $usuario->getPuntosventa();
    	
    	return $this->render('FrontendBundle:Default:portada.html.twig', array (
	
				'puesto' => $puesto,
    			'puntosventa' => $puntosventa,
    			'puntospartido' => $puntospartido,
    			'puntos' => $puntos,
		) );
    }
    public function ganadoresAction()
    {
    	return $this->render('FrontendBundle:Default:ganadores.html.twig');
    }
    public function fixtureAction()
    {
    	return $this->render('FrontendBundle:Default:fixture.html.twig');
    }
}
