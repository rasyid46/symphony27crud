<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request) {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
                    'base_dir' => realpath($this->container->getParameter('kernel.root_dir') . '/..') . DIRECTORY_SEPARATOR,
        ));
        //return $this->redirectToRoute('hello', array('name' => 'Fabien'));
    }

    /**
     * @Route("/hello/{name}", name="hello")
     */
    public function helloAction($name) {
        return $this->render('default/hello.html.twig', array(
                    'name' => $name
        ));
    }

}
