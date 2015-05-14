<?php

namespace Prode\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
//use Prode\BackendBundle\Entity\Premios;
//use Prode\BackendBundle\Entity\Banners;
//use Prode\BackendBundle\Entity\Jugadores;
use Prode\BackendBundle\Entity\Equipos;
//use Prode\BackendBundle\Form\Backend\PremiosType;
//use Prode\BackendBundle\Form\Backend\BannersType;
//use Prode\BackendBundle\Form\Backend\JugadoresType;
use Prode\BackendBundle\Form\Backend\EquiposType;
use Symfony\Component\HttpFoundation\RedirectResponse;

class EquiposController extends Controller {

	
	
	public function EquiposAction() {
		$equipos = new Equipos();
		$peticion = $this->getRequest ();
		$usuario = $this->get ( 'security.context' )->getToken ()->getUser ();
	
		$em = $this->getDoctrine ()->getManager ();
		$equipos = $em->getRepository ( 'BackendBundle:Equipos' )->findAll ();
	
		return $this->render ( 'BackendBundle:Equipos:equipos.html.twig', array (
	
				'usuario' => $usuario,
				'equipos' => $equipos
		) );
	}
	
	public function addequipoAction() {
		
		$equipo = new Equipos ();
		$peticion = $this->getRequest ();
		
		$usuario = $this->get ( 'security.context' )->getToken ()->getUser ();
		$formulario = $this->createForm ( new EquiposType (), $equipo );
		$formulario->handleRequest ( $peticion );
		
		if ($formulario->isValid ()) {
			$em = $this->getDoctrine ()->getManager ();
			$em->persist ( $equipo );
			$equipo->subirFoto ();
			$em->flush ();
			return new RedirectResponse ( $this->generateUrl ( 'equipos_equipos' ) );
		}
		return $this->render ( 'BackendBundle:Equipos:addequipo.html.twig', array (
				'formulario' => $formulario->createView (),
				'usuario' => $usuario,
				'equipos' => $equipo
		) );
		
	}
	public function editequipoAction($id) {
		$em = $this->getDoctrine ()->getManager ();
		$equipo = $em->getRepository ( 'BackendBundle:Equipos' )->find ( $id );
		if (!$equipo) {
			throw $this->createNotFoundException('No existe equipo');
		}
		$formulario = $this->createForm ( new EquiposType (), $equipo );
		$peticion = $this->getRequest();
		$formulario->handleRequest($peticion);
		if ($formulario->isValid ()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($equipo);
			$equipo->subirFoto ();
			$em->flush();
			return new RedirectResponse ( $this->generateUrl ( 'equipos_equipos' ) );
		}
		return $this->render ( 'BackendBundle:Equipos:editequipo.html.twig', array (
				'formulario' => $formulario->createView (),
				'id' => $id,
		
		) );
	}
	public function delequipoAction($id) {
		$em = $this->getDoctrine()->getManager();
		$equipo = $em->getRepository('BackendBundle:Equipos')->find($id);
		if (!$equipo) {
			throw $this->createNotFoundException('No existe Equipo');
		}
		$em->remove($equipo);
		$em->flush();
		return $this->redirect($this->generateUrl('equipo_equipo'));
	}
	
}
