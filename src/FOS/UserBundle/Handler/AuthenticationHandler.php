<?php

namespace FOS\UserBundle\Handler;

use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationFailureHandlerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class AuthenticationHandler implements AuthenticationSuccessHandlerInterface, AuthenticationFailureHandlerInterface
{

    public function __construct(Container $container)
    {
        
        $this->container = $container;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        if ($request->isXmlHttpRequest()) {

            return new JsonResponse(array('result' => false));
        }

        $request->getSession()->set(SecurityContextInterface::AUTHENTICATION_ERROR, $exception);

        $url = $request->headers->get('referer');

        return new RedirectResponse($url);
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {

        if ($request->isXmlHttpRequest()) {

            return new JsonResponse(array('result' => true));
        }

        $key = '_security.main.target_path';
        if ($this->container->get('session')->has($key)) {
            $url = $this->container->get('session')->get($key);
        } else {
            $url = $this->container->get('router')->generate('piorun_home_site_adminpage');
        }
        return new RedirectResponse($url);
    }

}
