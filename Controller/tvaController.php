<?php

namespace Nexteer\PoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Nexteer\PoBundle\Entity\tva;
use Nexteer\PoBundle\Form\tvaType;
use Nexteer\PoBundle\Entity\pays;

/**
 * tva controller.
 *
 * @Route("/tva")
 */
class tvaController extends Controller
{
    /**
     * Lists all tva entities.
     *
     * @Route("/", name="tva")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('NexteerPoBundle:tva')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a tva entity.
     *
     * @Route("/{id}/show", name="tva_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NexteerPoBundle:tva')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find tva entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new tva entity.
     *
     * @Route("/new", name="tva_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new tva();
        $form   = $this->createForm(new tvaType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new tva entity.
     *
     * @Route("/create", name="tva_create")
     * @Method("POST")
     * @Template("NexteerPoBundle:tva:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new tva();
        $form = $this->createForm(new tvaType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('tva_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing tva entity.
     *
     * @Route("/{id}/edit", name="tva_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NexteerPoBundle:tva')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find tva entity.');
        }

        $editForm = $this->createForm(new tvaType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing tva entity.
     *
     * @Route("/{id}/update", name="tva_update")
     * @Method("POST")
     * @Template("NexteerPoBundle:tva:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NexteerPoBundle:tva')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find tva entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new tvaType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('tva_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a tva entity.
     *
     * @Route("/{id}/delete", name="tva_delete")
     * @Method("POST")
     */
    public function deleteAction($id)
    {
//        $form = $this->createDeleteForm($id);
//        $form->bind($request);
//
//        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('NexteerPoBundle:tva')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find tva entity.');
            }

            $em->remove($entity);
            $em->flush();
//        }

        return $this->redirect($this->generateUrl('tva'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
