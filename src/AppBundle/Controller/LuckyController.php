<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// src/AppBundle/Controller/LuckyController.php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Book;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Form\BookType;

class LuckyController extends Controller {

    /**
     * @Route("/lucky/number")
     */
    public function numberAction() {
        $number = mt_rand(0, 100);
        return new Response(
                '<html><body>Lucky number: ' . $number . '</body></html>'
        );
    }

    /**
     * @Route("/lucky/show")
     *
     */
    public function showAction() {
        $repository = $this->getDoctrine()->getRepository('AppBundle:Book');
        $entities = $repository->findAll();
        //  $entities = $repository->find(1);
        return $this->render('lucky/show.html.twig', array(
                    'entities' => $entities,
        ));
    }

    /**
     * @Route("/lucky/create")
     */
    public function createAction() {
        $Book = new Book();
        $Book->setAuthor('Keyboard');
        $Book->setName('Sule');
        $Book->setNo(2);
        $Book->setLanguage('Arab');
        $Book->setPublisher('Gramed');
        $Book->setSummary('OKe');
        $em = $this->getDoctrine()->getManager();
        // tells Doctrine you want to (eventually) save the Product (no queries yet)
        $em->persist($Book);
        // actually executes the queries (i.e. the INSERT query)
        $em->flush();
        return new Response('Saved new product with id ' . $Book->getId());
    }

    /**
     * @Route("/lucky/new")
     */
    public function newAction(Request $request) {
        // create a task and give it some dummy data for this example
        $task = new Book();
        $task->setName('Write a blog post');
        $task->setNo(99);
        $task->setBrochure('oke');
        $form = $this->createFormBuilder($task)
                ->add('no', 'text')
                ->add('name', 'text')
                ->add('author', 'text')
                ->add('language', 'text')
                ->add('publisher', 'text')
                ->add('summary', 'text')
                ->add('save', 'submit', array('label' => 'Create BOOK'))
                ->getForm();
        if (!empty($_POST)) {
            $no = $_POST['form']['no'];
            $name = $_POST['form']['name'];
            $author = $_POST['form']['author'];
            $language = $_POST['form']['language'];
            $publisher = $_POST['form']['publisher'];
            $summary = $_POST['form']['summary'];
            $Book = new Book();
            $Book->setAuthor($author);
            $Book->setName($name);
            $Book->setNo($no);
            $Book->setLanguage($language);
            $Book->setPublisher($publisher);
            $Book->setSummary($summary);
            $Book->setBrochure($summary);
            $em = $this->getDoctrine()->getManager();
            $validator = $this->get('validator');
            $errors = $validator->validate($Book);
            if (count($errors) > 0) {
                /*
                 * Uses a __toString method on the $errors variable which is a
                 * ConstraintViolationList object. This gives us a nice string
                 * for debugging.
                 */
                $errorsString = (string) $errors;
                $request->getSession()
                        ->getFlashBag()
                        ->add('error', $errorsString)
                ;
                return $this->redirectToRoute('lucky_new');
            }
            // tells Doctrine you want to (eventually) save the Product (no queries yet)
            $em->persist($Book);
            // actually executes the queries (i.e. the INSERT query)
            $em->flush();
            return $this->redirectToRoute('lucky_show');
        }
        $errors = array();
        return $this->render('lucky/new.html.twig', array(
                    'form' => $form->createView(), 'errors' => $errors,
        ));
    }

    /**
     * @Route("/lucky/edit/")
     */
    public function editAction(Request $request) {
        $id = $request->get('id');
// create a task and give it some dummy data for this example
        $repository = $this->getDoctrine()->getRepository('AppBundle:Book');
        $entities = $repository->find($id);
        $form = $this->createFormBuilder($entities)
                ->add('no', 'text')
                ->add('name', 'text')
                ->add('author', 'text')
                ->add('language', 'text')
                ->add('publisher', 'text')
                ->add('summary', 'text')
                ->add('save', 'submit', array('label' => 'Update BOOK'))
                ->getForm();
        if (!empty($_POST)) {
            $no = $_POST['form']['no'];
            $name = $_POST['form']['name'];
            $author = $_POST['form']['author'];
            $language = $_POST['form']['language'];
            $publisher = $_POST['form']['publisher'];
            $summary = $_POST['form']['summary'];
            $em = $this->getDoctrine()->getManager();
            $Book = $em->getRepository('AppBundle:Book')->find($id);
            $Book->setAuthor($author);
            $Book->setName($name);
            $Book->setNo($no);
            $Book->setLanguage($language);
            $Book->setPublisher($publisher);
            $Book->setSummary($summary);
            // tells Doctrine you want to (eventually) save the Product (no queries yet)
            $em->persist($Book);
            // actually executes the queries (i.e. the INSERT query)
            $em->flush();
            return $this->redirectToRoute('lucky_show');
        }
        return $this->render('lucky/new.html.twig', array(
                    'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/lucky/delete")
     */
    public function deleteAction(Request $request) {
        $id = $request->get('id');
        // create a task and give it some dummy data for this example
        $em = $this->getDoctrine()->getManager();
        $Book = $em->getRepository('AppBundle:Book')->find($id);
        if ($Book) {
            $em->remove($Book);
            $em->flush();
            return $this->redirectToRoute('lucky_show');
        } else {
            return new Response('Data NOt Found ');
        }
    }

    /**
     * Creates a form to create a Book entity.
     *
     * @param Buku $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Book $entity) {
        $form = $this->createForm(new BookType(), $entity, array(
            'action' => $this->generateUrl('lucky_upload'),
            'method' => 'POST',
            'attr' => array('role' => 'form'),
        ));
        $form->add('submit', 'submit', array('label' => 'Create'));
        return $form;
    }

    /**
     * @Route("/lucky/upload")
     */
    public function uploadAction(Request $request) {
        $book = new Book();
        $form = $this->createCreateForm($book);
        $form->handleRequest($request);
      if ($form->isSubmitted() && $form->isValid()) {
            $file = $book->getBrochure();
            // Generate a unique name for the file before saving it
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();
            // Move the file to the directory where brochures are stored
            $file->move(
                    $this->getParameter('brochures_directory'), $fileName
            );
            // Update the 'brochure' property to store the PDF file name
            // instead of its contents
            $book->setBrochure($fileName);
            $em = $this->getDoctrine()->getManager();
            $em->persist($book);
            // actually executes the queries (i.e. the INSERT query)
            $em->flush();
            // ... persist the $book variable or any other work
            return $this->redirectToRoute('lucky_show');
        }
        return $this->render('lucky/newu.html.twig', array(
                    'form' => $form->createView(),
                    'entity' => $book,
        ));
    }

}
