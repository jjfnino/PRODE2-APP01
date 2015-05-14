<?php

namespace Prode\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Prode\BackendBundle\Entity\Premios;
//use Prode\BackendBundle\Entity\Banners;
//use Prode\BackendBundle\Entity\Jugadores;
//use Prode\BackendBundle\Entity\Equipos;
use Prode\BackendBundle\Form\Backend\PremiosType;
//use Prode\BackendBundle\Form\Backend\BannersType;
//use Prode\BackendBundle\Form\Backend\JugadoresType;
//use Prode\BackendBundle\Form\Backend\EquiposType;
use Symfony\Component\HttpFoundation\RedirectResponse;

class PremiosController extends Controller {

	
	
	public function portadaAction() {
		$premios = new Premios ();
		$peticion = $this->getRequest ();
		$usuario = $this->get ( 'security.context' )->getToken ()->getUser ();
		
		$em = $this->getDoctrine ()->getManager ();
		$premios = $em->getRepository ( 'BackendBundle:Premios' )->findAll ();
		
		return $this->render ( 'BackendBundle:Premios:portada.html.twig', array (
				
				'usuario' => $usuario,
				'premios' => $premios 
		) );
	}
	public function addAction() {
		$premios = new Premios ();
		$peticion = $this->getRequest ();
		$usuario = $this->get ( 'security.context' )->getToken ()->getUser ();
		$formulario = $this->createForm ( new PremiosType (), $premios );
		$formulario->handleRequest ( $peticion );
	
		if ($formulario->isValid ()) {
			$em = $this->getDoctrine ()->getManager ();
			$em->persist ( $premios );
			$premios->subirFoto ();
			$em->flush ();
			return new RedirectResponse ( $this->generateUrl ( 'premios_portada' ) );
		}
		return $this->render ( 'BackendBundle:Premios:add.html.twig', array (
				'formulario' => $formulario->createView (),
				'usuario' => $usuario,
				'premios' => $premios
		) );
	}
	
	public function delAction() {
		$peticion = $this->getRequest ();
		// echo $idpremio = $this->getRequest()->request->get('i');
		$idpremio = $this->getRequest ()->query->get ( 'i' );
		// echo $idpremio = $peticion->request->get ( 'i' );
		$usuario = $this->get ( 'security.context' )->getToken ()->getUser ();
		if ($idpremio) {
				
			$em = $this->getDoctrine ()->getManager ();
			$entity = $em->getRepository ( 'BackendBundle:Premios' )->find ( $idpremio );
			$em->remove ( $entity );
			$em->flush ();
		}
	
		return new RedirectResponse ( $this->generateUrl ( 'premios_portada' ) );
	
		$em = $this->getDoctrine ()->getManager ();
		$premios = $em->getRepository ( 'BackendBundle:Premios' )->findAll ();
	
		return $this->render ( 'BackendBundle:Premios:del.html.twig', array (
				'usuario' => $usuario,
				'premios' => $premios
		) );
	}
	public function editAction($id) {
		//echo $this->get('kernel')->getRootDir() . '/../web' . $this->getRequest()->getBasePath();
		$em = $this->getDoctrine ()->getManager ();
		$premio = $em->getRepository ( 'BackendBundle:Premios' )->find ( $id );
		if (! $premio) {
			throw $this->createNotFoundException ( 'No existe premio' );
		}
		$ban = array();
		//foreach ($banner as $ban){
		//$ruta = $banner->getRutafoto();
		//$size = getimagesize('http://localhost/Dropbox/Proyectos/Prode2014/web/uploads/images/'.$ruta);
		//echo $size[0]; //width
		//echo $size[1]; //height
		//}
		$formulario = $this->createForm ( new PremiosType (), $premio );
		$peticion = $this->getRequest ();
		$formulario->handleRequest ( $peticion );
		if ($formulario->isValid ()) {
			$em = $this->getDoctrine ()->getManager ();
			$em->persist ( $premio );
			$premio->subirFoto ();
			$em->flush ();
			return new RedirectResponse ( $this->generateUrl ( 'premios_portada' ) );
		}
		return $this->render ( 'BackendBundle:Premios:edit.html.twig', array (
				'formulario' => $formulario->createView (),
				'id' => $id
		)
		);
	}
	
	public function estadoAction() {
	
		$partidos = new Premios();
		$peticion = $this->getRequest ();
		$idpartido = $this->getRequest ()->query->get ( 'i' );
		$estado = $this->getRequest ()->query->get ( 'e' );
	
		if($estado == '0' || $estado == '1'){
	
			$em = $this->getDoctrine ()->getManager ();
			$query = $em->createQuery ( 'UPDATE BackendBundle:Premios o SET o.estado = :estado WHERE o.id = :id' );
			$query->setParameter ( 'estado', $estado );
			$query->setParameter ( 'id', $idpartido );
			$query->execute ();
	
		}
	
		return new RedirectResponse ( $this->generateUrl ( 'premios_portada' ) );
	}
}
