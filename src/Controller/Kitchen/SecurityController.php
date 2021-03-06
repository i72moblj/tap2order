<?php
/**
 * Created by PhpStorm.
 * User: jesules
 * Date: 6/06/18
 * Time: 23:46
 */

namespace App\Controller\Kitchen;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/kitchen")
 */
class SecurityController extends Controller
{
    /**
     * @Route("/login", name="kitchen_login")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function login(Request $request) {
        //Llamamos al servicio de autenticacion
        $authenticationUtils = $this->get('security.authentication_utils');

        // conseguir el error del login si falla
        $error = $authenticationUtils->getLastAuthenticationError();

        // ultimo nombre de usuario que se ha intentado identificar
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render(
            'kitchen/security/kitchen_login.html.twig', array(
            'last_username' => $lastUsername,
            'error' => $error,
        ));
    }

    /**
     * @Route("/login_check", name="kitchen_login_check")
     */
    public function login_check() {
    }

    /**
     * @Route("/logout", name="kitchen_logout")
     */
    public function logout() {
    }
}