<?php

namespace Nexteer\PoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Nexteer\PoBundle\Entity\service;
use Nexteer\PoBundle\Form\serviceType;

/**
 * service controller.
 *
 * @Route("/service")
 */
class serviceController extends Controller
{
    /**
     * Lists all service entities.
     *
     * @Route("/", name="service")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('NexteerPoBundle:service')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a service entity.
     *
     * @Route("/{id}/show", name="service_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NexteerPoBundle:service')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find service entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new service entity.
     *
     * @Route("/new", name="service_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new service();
        $form   = $this->createForm(new serviceType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new service entity.
     *
     * @Route("/create", name="service_create")
     * @Method("POST")
     * @Template("NexteerPoBundle:service:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new service();
        $form = $this->createForm(new serviceType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('service_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing service entity.
     *
     * @Route("/{id}/edit", name="service_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NexteerPoBundle:service')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find service entity.');
        }

        $editForm = $this->createForm(new serviceType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing service entity.
     *
     * @Route("/{id}/update", name="service_update")
     * @Method("POST")
     * @Template("NexteerPoBundle:service:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NexteerPoBundle:service')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find service entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new serviceType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('service_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a service entity.
     *
     * @Route("/{id}/delete", name="service_delete")
     * @Method("POST")
     */
    public function deleteAction($id)
    {
        //print_r($request); exit();
        //$form = $this->createDeleteForm($id);
        //$form->bind($request);
        //if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('NexteerPoBundle:service')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find service entity.');
            }
            $em->remove($entity);
            $em->flush();
        return $this->redirect($this->generateUrl('service'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
