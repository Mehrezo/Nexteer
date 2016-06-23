<?php

namespace Nexteer\PoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Nexteer\PoBundle\Entity\paymentterms;
use Nexteer\PoBundle\Form\paymenttermsType;

/**
 * paymentterms controller.
 *
 * @Route("/paymentterms")
 */
class paymenttermsController extends Controller
{
    /**
     * Lists all paymentterms entities.
     *
     * @Route("/", name="paymentterms")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('NexteerPoBundle:paymentterms')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a paymentterms entity.
     *
     * @Route("/{id}/show", name="paymentterms_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NexteerPoBundle:paymentterms')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find paymentterms entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new paymentterms entity.
     *
     * @Route("/new", name="paymentterms_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new paymentterms();
        $form   = $this->createForm(new paymenttermsType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new paymentterms entity.
     *
     * @Route("/create", name="paymentterms_create")
     * @Method("POST")
     * @Template("NexteerPoBundle:paymentterms:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new paymentterms();
        $form = $this->createForm(new paymenttermsType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('paymentterms_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing paymentterms entity.
     *
     * @Route("/{id}/edit", name="paymentterms_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NexteerPoBundle:paymentterms')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find paymentterms entity.');
        }

        $editForm = $this->createForm(new paymenttermsType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing paymentterms entity.
     *
     * @Route("/{id}/update", name="paymentterms_update")
     * @Method("POST")
     * @Template("NexteerPoBundle:paymentterms:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NexteerPoBundle:paymentterms')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find paymentterms entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new paymenttermsType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('paymentterms_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a paymentterms entity.
     *
     * @Route("/{id}/delete", name="paymentterms_delete")
     * @Method("POST")
     */
    //public function deleteAction(Request $request, $id)
    public function deleteAction($id)
    {
//        $form = $this->createDeleteForm($id);
//        $form->bind($request);
//
//        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('NexteerPoBundle:paymentterms')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find paymentterms entity.');
            }

            $em->remove($entity);
            $em->flush();
//        }

        return $this->redirect($this->generateUrl('paymentterms'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
