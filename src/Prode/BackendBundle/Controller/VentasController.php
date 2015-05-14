<?php

namespace Prode\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Prode\BackendBundle\Entity\Partidos;
use Prode\BackendBundle\Entity\Ventas;
use Prode\BackendBundle\Entity\Premios;
use Prode\BackendBundle\Form\Backend\PartidoType;
use Symfony\Component\HttpFoundation\RedirectResponse;

class VentasController extends Controller {
	public function cajaVentasAction() {
		$peticion = $this->getRequest ();
		$sesion = $peticion->getSession ();
		
		$error = $peticion->attributes->get ( SecurityContext::AUTHENTICATION_ERROR, $sesion->get ( SecurityContext::AUTHENTICATION_ERROR ) );
		return $this->render ( 'BackendBundle:Ventas:cajaVentas.html.twig', array (
				'last_username' => $sesion->get ( SecurityContext::LAST_USERNAME ),
				'error' => $error 
		) );
	}
	public function detalleAction($id) {
		$em = $this->getDoctrine ()->getManager ();
		$consulta = $em->createQuery ( 'SELECT c FROM UsuarioBundle:Usuario c WHERE c.id = :id' );
		$consulta->setParameter ( 'id', $id );
		$usuario = $consulta->getResult ();
		
		$consulta2 = $em->createQuery ( 'SELECT c FROM BackendBundle:Ventas c WHERE c.usuario = :id' );
		$consulta2->setParameter ( 'id', $id );
		$ventas = $consulta2->getResult ();
		
		$consulta3 = $em->createQuery ( 'SELECT c FROM BackendBundle:Premios c WHERE c.categoria = :id' );
		$consulta3->setParameter ( 'id', 'PUNTOS' );
		$premios = $consulta3->getResult ();
		
		return $this->render ( 'BackendBundle:Ventas:detalle.html.twig', array (
				
				'usuario' => $usuario, 
				'ventas' => $ventas,
				'premios' => $premios 
		) );
	}
	public function PortadaAction() {
		// $ventas = new Ventas();
		$peticion = $this->getRequest ();
		$usuario = $this->get ( 'security.context' )->getToken ()->getUser ();
		/*$em = $this->getDoctrine ()->getManager ();
		$consulta = $em->createQuery ( 'SELECT c 
											  FROM UsuarioBundle:Usuario c 
											 WHERE c.comision > 0 
											   
										  ORDER BY c.comision DESC' );
		$ventas = $consulta->getResult ();*/
		return $this->render ( 'BackendBundle:Ventas:portada.html.twig', array (
				
				'usuario' => $usuario,
				//'ventas' => $ventas 
		) );
	}
	public function ResultadosAction() {
		// $ventas = new Ventas();
		$peticion = $this->getRequest ();
		
		$apodo = $peticion->request->get ( 'apodo' );
		$nombre = $peticion->request->get ( 'nombre' );
		$apellido = $peticion->request->get ( 'apellido' );
		$dni = $peticion->request->get ( 'dni' );
		$email = $peticion->request->get ( 'email' );
		
		$usuario = $this->get ( 'security.context' )->getToken ()->getUser ();
		$em = $this->getDoctrine ()->getManager ();
		$consulta = $em->createQuery ( 'SELECT c 
										  FROM UsuarioBundle:Usuario c 
										 WHERE c.nombre like :nombre
										   AND c.apellido like :apellido
										   AND c.email like :email
										   AND c.dni like :dni
										   AND c.apodo like :apodo												 
				             			   ' );
		$consulta->setParameter ( 'apodo', '%' . $apodo . '%' );
		$consulta->setParameter ( 'nombre', '%' . $nombre . '%' );
		$consulta->setParameter ( 'apellido', '%' . $apellido . '%' );
		$consulta->setParameter ( 'dni', '%' . $dni . '%' );
		$consulta->setParameter ( 'email', '%' . $email . '%' );
		$ventas = $consulta->getResult ();
		return $this->render ( 'BackendBundle:Ventas:resultados.html.twig', array (
				
				'usuario' => $usuario,
				'ventas' => $ventas 
		) );
	}
	public function acumularAction() {
		
		/*
		 * $peticion = $this->getRequest (); echo $id = $this->getRequest ()->query->get ( 'i' ); echo $comision = $this->getRequest ()->query->get ( 'c' ); echo $op = $this->getRequest ()->query->get ( 'o' );
		 */
		$peticion = $this->getRequest ();
		// puntos a otorgar
		$puntos = $peticion->request->get ( 'puntos' );
		// semana que obtuvo los puntos
		$semana = $peticion->request->get ( 'semana' );
		// id usuario
		$id = $peticion->request->get ( 'id' );
		
		
		$ventas = new Ventas ();
			
		
		$ventas->setUsuario ( $id );
		$ventas->setPuntos ( $puntos );
		$ventas->setSemana ( $semana );
		
		$em = $this->getDoctrine ()->getManager ();
		$em->persist ( $ventas );
		$em->flush ();
		
		$em = $this->getDoctrine ()->getManager ();
		$consulta = $em->createQuery ( 'SELECT c FROM UsuarioBundle:Usuario c WHERE c.id = :id ' );
		$consulta->setParameter ( 'id', $id );
		$usuarios = $consulta->getResult ();
		foreach ($usuarios as $usuario) {
			$id = $usuario->getId();
			/*Lo que tenia de ventas */
			$puntosventa = $usuario->getPuntosventa();
			/*Lo que tenia de puntos totales*/
			$puntost = $usuario->getPuntos();
			/*Lo que tenia de puntos para cambiar por premio*/
			$puntoscambio = $usuario->getPuntoscambio();
			/*Lo que tenia mas lo que ingresa*/
			$puntosv = $puntosventa + $puntos;
			/* Siempre  se acumula los puntos para cambio */
			$puntosc = $puntos + $puntoscambio;
			/* Puntos total */
			$puntost = $puntos + $puntost;
			
			$em = $this->getDoctrine ()->getManager ();
			$query = $em->createQuery ( 'UPDATE UsuarioBundle:Usuario o SET o.puntosventa = :puntos, o.puntoscambio = :puntosc, o.puntos = :puntost WHERE o.id = :id' );
			$query->setParameter ( 'puntos', $puntosv );
			$query->setParameter ( 'puntost', $puntost );
			$query->setParameter ( 'puntosc', $puntosc );
			$query->setParameter ( 'id', $id );
			$query->execute ();
			
			
		}
		
		/*
		 * if($op == 's'){ $comision++; }else{ $comision--; }
		 */
		
		/*$usuario = $this->get ( 'security.context' )->getToken ()->getUser ();
		$em = $this->getDoctrine ()->getManager ();
		$query = $em->createQuery ( 'IN BackendBundle:Ventas o SET o.puntos = :puntos, o.semana = :semana WHERE o.id = :id' );
		$query->setParameter ( 'puntos', $puntos );
		$query->setParameter ( 'semana', $semana );
		$query->setParameter ( 'id', $id );
		$query->execute ();
		*/
		return $this->redirect($this->generateUrl('ventas_detalle', array('id'=>$id)));
		
		//return $this->render ( 'BackendBundle:Ventas:acumular.html.twig');
	}
	
	
	public function intercambiarAction() {
	

		$peticion = $this->getRequest ();
		// id_premio
		$idpremio = $peticion->request->get ( 'premio' );
		// id usuario
		$id = $peticion->request->get ( 'id' );
		
		//Busco datos premio seleccionado
		$em = $this->getDoctrine ()->getManager ();
		$premio = new Premios ();
		$consulta = $em->createQuery ( 'SELECT c
										  FROM BackendBundle:Premios c
										 WHERE c.id = :premio
										   ' );
		
		$consulta->setParameter ( 'premio', $idpremio );
		$premio = $consulta->getSingleResult ();
	
		//busco puntos
		$puntos = $premio->getPuesto();
		//puntos a intercambiar
		$puntos = $puntos * -1;
		//obtengo descripcion de premio
		$descripcion = $premio->getTitulo();
		
		$ventas = new Ventas ();
	
		$ventas->setUsuario ( $id );
		$ventas->setPuntos ( $puntos );
		$ventas->setDescripcion ( $descripcion );
	
		$em = $this->getDoctrine ()->getManager ();
		$em->persist ( $ventas );
		$em->flush ();
		
		
		$em = $this->getDoctrine ()->getManager ();
		$consulta = $em->createQuery ( 'SELECT c FROM UsuarioBundle:Usuario c WHERE c.id = :id ' );
		$consulta->setParameter ( 'id', $id );
		$usuarios = $consulta->getResult ();
		foreach ($usuarios as $usuario) {
			$id = $usuario->getId();
			$puntoscambio = $usuario->getPuntoscambio();
				
			/* Resto a puntos cambio la cantidad de puntos que equivale premio otorgado */
			$puntosc = $puntoscambio + $puntos;
				
			$em = $this->getDoctrine ()->getManager ();
			$query = $em->createQuery ( 'UPDATE UsuarioBundle:Usuario o SET o.puntoscambio = :puntosc WHERE o.id = :id' );
			$query->setParameter ( 'puntosc', $puntosc );
			$query->setParameter ( 'id', $id );
			$query->execute ();
				
				
		}
		
		/*
		 * if($op == 's'){ $comision++; }else{ $comision--; }
		*/
	
		/*$usuario = $this->get ( 'security.context' )->getToken ()->getUser ();
			$em = $this->getDoctrine ()->getManager ();
		$query = $em->createQuery ( 'IN BackendBundle:Ventas o SET o.puntos = :puntos, o.semana = :semana WHERE o.id = :id' );
		$query->setParameter ( 'puntos', $puntos );
		$query->setParameter ( 'semana', $semana );
		$query->setParameter ( 'id', $id );
		$query->execute ();
		*/
		return $this->redirect($this->generateUrl('ventas_detalle', array('id'=>$id)));
	
		//return $this->render ( 'BackendBundle:Ventas:acumular.html.twig');
	}
	
	public function jugadoresAction() {
		$tope = 30;
		$usuario = $this->get ( 'security.context' )->getToken ()->getUser ();
		$peticion = $this->getRequest ();
		$apodo = $peticion->request->get ( 'apodo' );
		$actual = $peticion->query->get ( 'p' ); // pagina actual
		
		if (! $actual || $actual == '1') {
			$anterior = - 1;
			$siguiente = '2';
			$desde = '0';
		} else {
			$anterior = $actual - 1;
			$siguiente = $actual + 1;
			$desde = $anterior * $tope;
		}
		
		$em = $this->getDoctrine ()->getManager ();
		if ($apodo) {
			$consulta = $em->createQuery ( 'SELECT c 
										  FROM UsuarioBundle:Usuario c 
										 WHERE c.prodecomp = :prodecomp 
				                           AND c.apodo like :apodo 
				             			   AND c.estado = 1 
									  ORDER BY c.puntos ASC, c.fecha_alta ASC' )->setMaxResults ( $tope )->setFirstResult ( 0 );
			$consulta->setParameter ( 'prodecomp', '1' );
			$consulta->setParameter ( 'apodo', '%' . $apodo . '%' );
			/* subTotal para paginador --> */
			$quests = $consulta->getResult ();
			$totalData = count ( $quests );
			/* subTotal para paginador <-- */
		} else {
			$consulta = $em->createQuery ( 'SELECT c 
											  FROM UsuarioBundle:Usuario c 
											 WHERE c.prodecomp = :prodecomp 
											   
										  ORDER BY c.fecha_alta ASC' )->setMaxResults ( $tope )->setFirstResult ( $desde );
			$consulta->setParameter ( 'prodecomp', '1' );
			/* subTotal para paginador --> */
			$quests = $consulta->getResult ();
			$totalData = count ( $quests );
			/* subTotal para paginador <-- */
		
		/*Total para paginador -->*/
		$consultatot = $em->createQuery ( 'SELECT c
											  FROM UsuarioBundle:Usuario c
											 WHERE c.prodecomp = :prodecomp
											  
										  ORDER BY c.fecha_alta ASC' );
			
			$consultatot->setParameter ( 'prodecomp', '1' );
			/* Total para paginador <--- */
			$quests = $consultatot->getResult ();
			$total = count ( $quests );
		}
		
		/* Paginador */
		$calc = $actual * $tope;
		if ($calc >= $total) {
			$siguiente = - 1;
		}
		$posiciones = $consulta->getResult ();
		
		return $this->render ( 'BackendBundle:Mundial:jugadores.html.twig', array (
				'jugadores' => $posiciones,
				'usuario' => $usuario,
				'sig' => $siguiente,
				'ant' => $anterior 
		) );
	}
}
