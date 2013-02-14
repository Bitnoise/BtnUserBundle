<?php

namespace Btn\UserBundle\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use FOS\UserBundle\Controller\RegistrationController as BaseController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class RegistrationController extends BaseController
{

    /**
     * @Route("/auth", name="auth")
     * @Template()
     */
    public function authAction()
    {
      //registration wrapper with login
      $form = $this->container->get('fos_user.registration.form');
      $formHandler = $this->container->get('fos_user.registration.form.handler');
      $confirmationEnabled = $this->container->getParameter('fos_user.registration.confirmation.enabled');

      $process = $formHandler->process($confirmationEnabled);
      if ($process) {
          $user = $form->getData();

          $this->container->get('fos_user.user_manager')->updateUser($user);

          $authUser = false;
          if ($confirmationEnabled) {
              $this->container->get('session')->set('fos_user_send_confirmation_email/email', $user->getEmail());
              $route = 'fos_user_registration_check_email';
          } else {
              $authUser = true;
              $route = 'fos_user_registration_confirmed';
          }

          $this->setFlash('fos_user_success', 'registration.flash.user_created');
          $url = $this->container->get('router')->generate($route);
          $response = new RedirectResponse($url);

          if ($authUser) {
              $this->authenticateUser($user, $response);
          }

          return $response;
      }

      return array(
        'form' => $form->createView()
      );
    }
}
