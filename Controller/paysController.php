<?php

namespace Nexteer\PoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Nexteer\PoBundle\Entity\pays;
use Nexteer\PoBundle\Form\paysType;

/**
 * pays controller.
 *
 * @Route("/pays")
 */
class paysController extends Controller
{
    /**
     * Lists all pays entities.
     *
     * @Route("/", name="pays")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('NexteerPoBundle:pays')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a pays entity.
     *
     * @Route("/{id}/show", name="pays_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NexteerPoBundle:pays')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find pays entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new pays entity.
     *
     * @Route("/new", name="pays_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new pays();
        $form   = $this->createForm(new paysType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new pays entity.
     *
     * @Route("/create", name="pays_create")
     * @Method("POST")
     * @Template("NexteerPoBundle:pays:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new pays();
        $form = $this->createForm(new paysType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('pays_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing pays entity.
     *
     * @Route("/{id}/edit", name="pays_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NexteerPoBundle:pays')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find pays entity.');
        }

        $editForm = $this->createForm(new paysType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing pays entity.
     *
     * @Route("/{id}/update", name="pays_update")
     * @Method("POST")
     * @Template("NexteerPoBundle:pays:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NexteerPoBundle:pays')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find pays entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new paysType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('pays_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a pays entity.
     *
     * @Route("/{id}/delete", name="pays_delete")
     * @Method("POST")
     */
    public function deleteAction($id)
    {
//        $form = $this->createDeleteForm($id);
//        $form->bind($request);
//
//        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('NexteerPoBundle:pays')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find pays entity.');
            }

            $em->remove($entity);
            $em->flush();
//        }

        return $this->redirect($this->generateUrl('pays'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
