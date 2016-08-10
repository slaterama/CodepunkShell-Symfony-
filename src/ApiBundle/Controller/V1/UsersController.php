<?php

namespace ApiBundle\Controller\V1;

use AppBundle\Form\UserType;
use FOS\RestBundle\Controller\Annotations as Route;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Routing\ClassResourceInterface;
use Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;

class UsersController extends FOSRestController implements ClassResourceInterface
{
    /**
     * @Route\Get("/users/get.{_format}", name="codepunk_users")
     */
    public function getUsersAction()
    {
        // security.yml is configured to allow anonymous access to controllers
        // checking for authorization in each controller allows more flexibility
        // to change this remove anonymous: true in security.yml on firewall
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('AppBundle:User')->findAll();

        return array('user' => $users);
    }

    /*
     * This method shows how to pass data to a view template (i.e. twig)
     */
    /*
    public function getAction()
    {
        // security.yml is configured to allow anonymous access to controllers
        // checking for authorization in each controller allows more flexibility
        // to change this remove anonymous: true in security.yml on firewall
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }

        $em = $this->getDoctrine()->getEntityManager();
        $repository = $em->getRepository("AppBundle:User");
        $users = $repository->findAll();

        $view = $this->view($users, 200)
            ->setTemplate("default/users.html.twig")
            ->setTemplateVar('users')
        ;

        return $this->handleView($view);
    }
    */

    /*
     * I haven't looked into this yet. Is this how you authenticate?
     */
    /*
    public function postAction(Request $request){
        $userManager = $this->get('fos_user.user_manager');

        $user = $userManager->createUser();
        $user->setEnabled(true);

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $user->setPlainPassword($user->getPassword());
            $userManager->updateUser($user);

            $view = $this->view($user, 200);
            return $this->handleView($view);
        }

        $view = $this->view($form->getErrors(), 409);
        return $this->handleView($view);
    }
    */
}