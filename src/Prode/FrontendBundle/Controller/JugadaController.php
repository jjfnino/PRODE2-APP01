<?php

namespace Prode\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Prode\BackendBundle\Entity\Partidos;
use Prode\FrontendBundle\Entity\Pronostico;
use Prode\FrontendBundle\Entity\Jugada;
//use Prode\BackendBundle\Entity\Premios;
//use Prode\UsuarioBundle\Entity\Mensaje;
//use Prode\BackendBundle\Entity\Respuestas;
use Symfony\Component\HttpFoundation\Response;
//use Prode\FrontendBundle\Form\Frontend\MensajeType;
use Symfony\Component\HttpFoundation\RedirectResponse;

class JugadaController extends Controller
{
    public function indexAction()
    {
        return $this->render('FrontendBundle:Jugada:index.html.twig');
    }
    
    public function ronda1Action()
    {	
    	$peticion = $this->getRequest ();
    	
    	$contexto = $this->get('security.context');
    	if($contexto->isGranted('IS_AUTHENTICATED_FULLY')){
    		$usuario = $this->get ( 'security.context' )->getToken ()->getUser ();
    		$estado = $usuario->getEstado();
    		if($estado == '0'){
    			return new RedirectResponse ( $this->generateUrl ( 'usuario_logout' ) );
    		}}
    	
    	
    		/*$partidos = new Partidos ();*/
    		//$jugada = new Jugada ();
    		$usuario = $this->get ( 'security.context' )->getToken ()->getUser ();
    		//$triviainicial = $usuario->getTriviacomp();
    	
    		/*if($triviainicial == '0'){
    			return new RedirectResponse ( $this->generateUrl ( 'pagina_triviainicial' ) );
    		}*/
    	
    		$em = $this->getDoctrine ()->getManager ();
    		$query3 = $em->createQuery ( 'SELECT p FROM BackendBundle:Partidos p WHERE p.ronda = 1' );
    		$allpartidos = $query3->getResult ();
    	
    		$query = $em->createQuery ( 'SELECT DISTINCT p.grupo, p.ronda FROM BackendBundle:Partidos p WHERE p.ronda = 1' );
    		$grupos = $query->getResult (); // array of CmsUser ids
    		
    		$em = $this->getDoctrine ()->getManager ();
    		$query3 = $em->createQuery ( 'SELECT p FROM BackendBundle:Partidos p WHERE p.ronda = 2' );
    		$allpartidos2 = $query3->getResult ();
    		 
    		$email = $usuario->getEmail ();
    		$em = $this->getDoctrine ()->getManager ();
    		$query2 = $em->createQuery ( 'SELECT p FROM FrontendBundle:Jugada p WHERE p.email = :email' );
    		$query2->setParameter ( 'email', $email );
    		$mipronostico = $query2->getResult (); // array of CmsUser ids
    	
    		return $this->render ( 'FrontendBundle:Jugada:ronda1.html.twig', array (
    				'seccion' => 'pronostico',
    				'usuario' => $usuario,
    				'partidos' => $allpartidos,
    				'partidos2' => $allpartidos2,
    				'grupos' => $grupos,
    				'mipronostico' => $mipronostico
    		) );
    	//return $this->render('FrontendBundle:Jugada:ronda1.html.twig');
    }
    
    public function guardarAction() {
    	$peticion = $this->getRequest ();
    		
    	$usuario = $this->get ( 'security.context' )->getToken ()->getUser ();
    	$email = $usuario->getEmail ();
    
    	if (isset ( $_POST ['submit_partido'] )) {
    		$jugada = new Jugada ();
    
    		$id = $peticion->request->get ( 'id_partido' );
    		$golesa = $peticion->request->get ( 'golesa' );
    		$golesb = $peticion->request->get ( 'golesb' );
    			
    		//elimino si existe el resultado ingresado
    		$em = $this->getDoctrine ()->getManager ();
    		$consulta = $em->createQuery ( 'DELETE
											  	FROM FrontendBundle:Jugada c
											 	WHERE c.id_partido = :id AND c.email = :email' );
    		$consulta->setParameter ( 'email', $email );
    		$consulta->setParameter ( 'id', $id );
    		$consulta = $consulta->getResult ();
    			
    		// inserto el nuevo resultado
    		$jugada->setEmail ( $email );
    		$jugada->setIdPartido ( $id );
    		$jugada->setGolesa ( $golesa );
    		$jugada->setGolesb ( $golesb );
    		$jugada->setPuntos ( '0' );
    
    		$em = $this->getDoctrine ()->getManager ();
    		$em->persist ( $jugada );
    		$em->flush ();
    
    		unset ( $jugada );
    
    		return new RedirectResponse ( $this->generateUrl ( 'jugada_ronda1' ) );
    	}
    
    
    }
    
}
