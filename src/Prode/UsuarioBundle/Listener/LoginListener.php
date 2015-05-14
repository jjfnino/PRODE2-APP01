<?php
// src/Cupon/UsuarioBundle/Listener/LoginListener.php
namespace Prode\UsuarioBundle\Listener;

use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Routing\Router;
use Symfony\Component\HttpFoundation\RedirectResponse;

class LoginListener{
	private $contexto, $router, $ciudad = null;
	public function __construct(SecurityContext $context, Router $router){
		$this->router = $router;
		$this->contexto = $context;
	}
	
	public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
	{
		$token = $event->getAuthenticationToken();
		$this->ciudad = $token->getUser()->getCiudad();
	}

	public function onKernelResponse(FilterResponseEvent $event)
	{
		if (null != $this->ciudad) {
			if($this->contexto->isGranted('ROLE_SUPER_ADMIN')) {	
				$portada = $this->router->generate('backend_usuarios', array( 'ciudad' => $this->ciudad ));
			}else{
				$portada = $this->router->generate('usuario_ingresos', array( 'ciudad' => $this->ciudad ));
			}
			$event->setResponse(new RedirectResponse($portada));
			$event->stopPropagation();
		
		}
	}
}