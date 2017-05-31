<?php

namespace Custom\BukuBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Custom\BukuBundle\Entity\Buku;
use Custom\BukuBundle\Form\BukuType;

/**
 * Buku controller.
 *
 */
class BukuController extends Controller {

    /**
     * Lists all Buku entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CustomBukuBundle:Buku')->findAll();

        return $this->render('CustomBukuBundle:Buku:index.html.twig', array(
                    'entities' => $entities,
        ));
    }

    /**
     * Creates a new Buku entity.
     *
     */
    public function createAction(Request $request) {
        $entity = new Buku();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            return $this->redirect($this->generateUrl('buku_show', array('id' => $entity->getId())));
        }
        return $this->render('CustomBukuBundle:Buku:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Buku entity.
     *
     * @param Buku $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Buku $entity) {
        $form = $this->createForm(new BukuType(), $entity, array(
            'action' => $this->generateUrl('buku_create'),
            'method' => 'POST',
            'attr' => array('role' => 'form'),
        ));
        $form->add('submit', 'submit', array('label' => 'Create'));
        return $form;
    }

    /**
     * Displays a form to create a new Buku entity.
     *
     */
    public function newAction() {
        $entity = new Buku();
        $form = $this->createCreateForm($entity);
        return $this->render('CustomBukuBundle:Buku:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Buku entity.
     *
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('CustomBukuBundle:Buku')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Buku entity.');
        }
        $deleteForm = $this->createDeleteForm($id);
        return $this->render('CustomBukuBundle:Buku:show.html.twig', array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Buku entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('CustomBukuBundle:Buku')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Buku entity.');
        }
        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);
        return $this->render('CustomBukuBundle:Buku:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Buku entity.
     *
     * @param Buku $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Buku $entity) {
        $form = $this->createForm(new BukuType(), $entity, array(
            'action' => $this->generateUrl('buku_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));
        $form->add('submit', 'submit', array('label' => 'Update'));
        return $form;
    }
    /**
     * Edits an existing Buku entity.
     *
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('CustomBukuBundle:Buku')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Buku entity.');
        }
        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);
        if ($editForm->isValid()) {
            $em->flush();
            return $this->redirect($this->generateUrl('buku_edit', array('id' => $id)));
        }
        return $this->render('CustomBukuBundle:Buku:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Buku entity.
     *
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CustomBukuBundle:Buku')->find($id);
            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Buku entity.');
            }
            $em->remove($entity);
            $em->flush();
        }
        return $this->redirect($this->generateUrl('buku'));
    }
    /**
     * Creates a form to delete a Buku entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('buku_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => 'Delete',
                            'attr' => array('class' => 'btn btn-danger btn-lg')))
                        ->getForm();
    }
}
