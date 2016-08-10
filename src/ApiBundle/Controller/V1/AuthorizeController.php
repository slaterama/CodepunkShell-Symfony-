<?php

namespace ApiBundle\Controller\V1;

use FOS\RestBundle\Controller\Annotations as Route;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Routing\ClassResourceInterface;
use Symfony\Component\HttpFoundation\Request;

class AuthorizeController extends FOSRestController implements ClassResourceInterface
{
	/**
	 * @Route\Get("/authorize/get.{_format}", name="codepunk_authorize")
	 */
	public function authorizeAction(Request $request) {
		$data = array('test' => 'testValue', 'currentUser' => get_current_user());
		return $data;
	}
}