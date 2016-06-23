<?php

namespace Nexteer\PoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Nexteer\PoBundle\Entity\costcenter;
use Nexteer\PoBundle\Form\costcenterType;

/**
 * costcenter controller.
 *
 * @Route("/costcenter")
 */
class costcenterController extends Controller
{
    /**
     * Lists all costcenter entities.
     *
     * @Route("/", name="costcenter")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('NexteerPoBundle:costcenter')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a costcenter entity.
     *
     * @Route("/{id}/show", name="costcenter_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NexteerPoBundle:costcenter')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find costcenter entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new costcenter entity.
     *
     * @Route("/new", name="costcenter_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new costcenter();
        $form   = $this->createForm(new costcenterType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new costcenter entity.
     *
     * @Route("/create", name="costcenter_create")
     * @Method("POST")
     * @Template("NexteerPoBundle:costcenter:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new costcenter();
        $form = $this->createForm(new costcenterType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('costcenter_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing costcenter entity.
     *
     * @Route("/{id}/edit", name="costcenter_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NexteerPoBundle:costcenter')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find costcenter entity.');
        }

        $editForm = $this->createForm(new costcenterType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing costcenter entity.
     *
     * @Route("/{id}/update", name="costcenter_update")
     * @Method("POST")
     * @Template("NexteerPoBundle:costcenter:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NexteerPoBundle:costcenter')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find costcenter entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new costcenterType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('costcenter_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a costcenter entity.
     *
     * @Route("/{id}/delete", name="costcenter_delete")
     * @Method("POST")
     */
    public function deleteAction($id)
    {
//        $form = $this->createDeleteForm($id);
//        $form->bind($request);
//
//        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('NexteerPoBundle:costcenter')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find costcenter entity.');
            }

            $em->remove($entity);
            $em->flush();
//        }

        return $this->redirect($this->generateUrl('costcenter'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
