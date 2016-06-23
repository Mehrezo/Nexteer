<?php

namespace Nexteer\PoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Nexteer\PoBundle\Entity\elementdelivery;
use Nexteer\PoBundle\Form\elementdeliveryType;

/**
 * elementdelivery controller.
 *
 * @Route("/elementdelivery")
 */
class elementdeliveryController extends Controller
{
    /**
     * Lists all elementdelivery entities.
     *
     * @Route("/", name="elementdelivery")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('NexteerPoBundle:elementdelivery')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a elementdelivery entity.
     *
     * @Route("/{id}/show", name="elementdelivery_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NexteerPoBundle:elementdelivery')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find elementdelivery entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new elementdelivery entity.
     *
     * @Route("/new", name="elementdelivery_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new elementdelivery();
        $form   = $this->createForm(new elementdeliveryType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new elementdelivery entity.
     *
     * @Route("/create", name="elementdelivery_create")
     * @Method("POST")
     * @Template("NexteerPoBundle:elementdelivery:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new elementdelivery();
        $form = $this->createForm(new elementdeliveryType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('elementdelivery_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing elementdelivery entity.
     *
     * @Route("/{id}/edit", name="elementdelivery_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NexteerPoBundle:elementdelivery')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find elementdelivery entity.');
        }

        $editForm = $this->createForm(new elementdeliveryType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing elementdelivery entity.
     *
     * @Route("/{id}/update", name="elementdelivery_update")
     * @Method("POST")
     * @Template("NexteerPoBundle:elementdelivery:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NexteerPoBundle:elementdelivery')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find elementdelivery entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new elementdeliveryType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('elementdelivery_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a elementdelivery entity.
     *
     * @Route("/{id}/delete", name="elementdelivery_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('NexteerPoBundle:elementdelivery')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find elementdelivery entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('elementdelivery'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
