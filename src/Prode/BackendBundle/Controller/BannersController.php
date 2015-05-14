<?php

namespace Prode\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Prode\BackendBundle\Entity\Banners;
use Prode\BackendBundle\Form\Backend\BannersType;
use Symfony\Component\HttpFoundation\RedirectResponse;

class BannersController extends Controller {
	public function PortadaAction() {
		$usuario = $this->get ( 'security.context' )->getToken ()->getUser ();
		$usuario->getUsername();
		if($this->get('security.context')->isGranted('ROLE_ADMIN')){
			$rol = 'ROLE_ADMIN';	
		}else{
			$rol = 'ROLE_ADMIN2';
		}
		$banners = new Banners();
		$peticion = $this->getRequest ();
		$usuario = $this->get ( 'security.context' )->getToken ()->getUser ();
		
		$em = $this->getDoctrine ()->getManager ();
		$banners = $em->getRepository ( 'BackendBundle:Banners' )->findAll ();
		
		return $this->render ( 'BackendBundle:Banners:portada.html.twig', array (
				'rol' => $rol,
				'usuario' => $usuario,
				'banners' => $banners 
		) );
	}
	public function addAction() {
		$banner = new Banners ();
		$peticion = $this->getRequest ();
		
		$usuario = $this->get ( 'security.context' )->getToken ()->getUser ();
		$formulario = $this->createForm ( new BannersType (), $banner );
		$formulario->handleRequest ( $peticion );
		
		if ($formulario->isValid ()) {
			$em = $this->getDoctrine ()->getManager ();
			$em->persist ( $banner );
			$banner->subirFoto ();
			$em->flush ();
			return new RedirectResponse ( $this->generateUrl ( 'banners_portada' ) );
		}
		return $this->render ( 'BackendBundle:Banners:add.html.twig', array (
				'formulario' => $formulario->createView (),
				'usuario' => $usuario,
				'banners' => $banner 
		) );
	}
	public function editAction($id) {
		//echo $this->get('kernel')->getRootDir() . '/../web' . $this->getRequest()->getBasePath();
		$em = $this->getDoctrine ()->getManager ();
		$banner = $em->getRepository ( 'BackendBundle:Banners' )->find ( $id );
		if (! $banner) {
			throw $this->createNotFoundException ( 'No existe banner' );
		}
		$ban = array();
		//foreach ($banner as $ban){
			//$ruta = $banner->getRutafoto();
			//$size = getimagesize('http://localhost/Dropbox/Proyectos/Prode2014/web/uploads/images/'.$ruta);
			//echo $size[0]; //width
			//echo $size[1]; //height
		//}
		$formulario = $this->createForm ( new BannersType (), $banner );
		$peticion = $this->getRequest ();
		$formulario->handleRequest ( $peticion );
		if ($formulario->isValid ()) {
			$em = $this->getDoctrine ()->getManager ();
			$em->persist ( $banner );
			$banner->subirFoto ();
			$em->flush ();
			return new RedirectResponse ( $this->generateUrl ( 'banners_portada' ) );
		}
		return $this->render ( 'BackendBundle:Banners:edit.html.twig', array (
				'formulario' => $formulario->createView (),
				'id' => $id 
		)
		 );
	}
	public function delAction($id) {
		$em = $this->getDoctrine ()->getManager ();
		$banner = $em->getRepository ( 'BackendBundle:Banners' )->find ( $id );
		if (! $banner) {
			throw $this->createNotFoundException ( 'No existe banner' );
		}
		$em->remove ( $banner );
		$em->flush ();
		return $this->redirect ( $this->generateUrl ( 'banners_portada' ) );
	}
	public function estadoAction() {
		$peticion = $this->getRequest ();
		$id = $this->getRequest ()->query->get ( 'i' );
		$estado = $this->getRequest ()->query->get ( 'e' );
		
		if ($estado == '1') {
			$estado == '0';
		} else {
			$estado == '1';
		}
		
		$usuario = $this->get ( 'security.context' )->getToken ()->getUser ();
		if ($id) {
			
			$em = $this->getDoctrine ()->getManager ();
			$query = $em->createQuery ( 'UPDATE BackendBundle:Banners o SET o.estado = :estado WHERE o.id = :id' );
			$query->setParameter ( 'estado', $estado );
			$query->setParameter ( 'id', $id );
			$query->execute ();
			
			return new RedirectResponse ( $this->generateUrl ( 'banners_portada' ) );
		}
		
		/*
		 * $em = $this->getDoctrine ()->getManager (); $premios = $em->getRepository ( 'BackendBundle:Premios' )->findAll ();
		 */
		
		return $this->render ( 'BackendBundle:Banners:Portada.html.twig' );
	}
	public function previewAction() {
		
		$usuario = $this->get ( 'security.context' )->getToken ()->getUser ();
		$peticion = $this->getRequest ();
		$id = $this->getRequest ()->query->get ( 'i' );
		$sesion = $peticion->getSession ();
		$em = $this->getDoctrine ()->getManager ();
		
		
		// Proximos partidos
		$query2 = $em->createQuery ( 'SELECT p FROM BackendBundle:Banners p WHERE p.id = :id' );
		$query2->setParameter('id', $id);
		$banner = $query2->getResult ();
		
		return $this->render ( 'BackendBundle:Banners:preview.html.twig', array (
				'seccion' => 'prev',
				'usuario' => $usuario,
				'banner' => $banner 
		) );
	}
}
