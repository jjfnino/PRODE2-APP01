<?php

namespace Prode\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Prode\BackendBundle\Entity\Partidos;
use Prode\BackendBundle\Form\Backend\PartidoType;
use Symfony\Component\HttpFoundation\RedirectResponse;

class PartidosController extends Controller {
	
	
	public function PortadaAction() {
		$partidos = new Partidos();
		$peticion = $this->getRequest ();
		$usuario = $this->get ( 'security.context' )->getToken ()->getUser ();
	
		$em = $this->getDoctrine ()->getManager ();
		$partidos = $em->getRepository ( 'BackendBundle:Partidos' )->findAll ();
	
		return $this->render ( 'BackendBundle:Partidos:portada.html.twig', array (
	
				'usuario' => $usuario,
				'partidos' => $partidos
		) );
	}
	
	public function addpartidoAction() {
		
		$partido = new Partidos();
		$peticion = $this->getRequest ();
		
		$usuario = $this->get ( 'security.context' )->getToken ()->getUser ();
		$formulario = $this->createForm ( new PartidoType (), $partido );
		$formulario->handleRequest ( $peticion );
		
		if ($formulario->isValid ()) {
			$em = $this->getDoctrine ()->getManager ();
			$em->persist ( $partido );
				
			$em->flush ();
			return new RedirectResponse ( $this->generateUrl ( 'partidos_portada' ) );
		}
		return $this->render ( 'BackendBundle:Partidos:addpartido.html.twig', array (
				'formulario' => $formulario->createView (),
				'usuario' => $usuario,
				'partidos' => $partido
		) );
		
	}
	public function editpartidoAction($id) {
		$em = $this->getDoctrine ()->getManager ();
		$partido = $em->getRepository ( 'BackendBundle:Partidos' )->find ( $id );
		if (!$partido) {
			throw $this->createNotFoundException('No existe partido');
		}
		$formulario = $this->createForm ( new PartidoType (), $partido );
		$peticion = $this->getRequest();
		$formulario->handleRequest($peticion);
		if ($formulario->isValid ()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($partido);
			$em->flush();
			return new RedirectResponse ( $this->generateUrl ( 'partidos_portada' ) );
		}
		return $this->render ( 'BackendBundle:Partidos:editpartido.html.twig', array (
				'formulario' => $formulario->createView (),
				'id' => $id,
		
		) );
	}
	public function delpartidoAction($id) {
		$em = $this->getDoctrine()->getManager();
		$texto = $em->getRepository('BackendBundle:Partidos')->find($id);
		if (!$texto) {
			throw $this->createNotFoundException('No existe partido');
		}
		$em->remove($texto);
		$em->flush();
		return $this->redirect($this->generateUrl('partidos_portada'));
	}
	
	public function estadoAction() {
		
		$partidos = new Partidos();
		$peticion = $this->getRequest ();
		$idpartido = $this->getRequest ()->query->get ( 'i' );
		$estado = $this->getRequest ()->query->get ( 'e' );
		
		if($estado == '0' || $estado == '1'){
		
			$em = $this->getDoctrine ()->getManager ();
			$query = $em->createQuery ( 'UPDATE BackendBundle:Partidos o SET o.estado = :estado WHERE o.id = :id' );
			$query->setParameter ( 'estado', $estado );
			$query->setParameter ( 'id', $idpartido );
			$query->execute ();
		
		}
		
		return new RedirectResponse ( $this->generateUrl ( 'partidos_portada' ) );
	}
	
}
