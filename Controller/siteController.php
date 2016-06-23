<?php

namespace Nexteer\PoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Nexteer\PoBundle\Entity\site;
use Nexteer\PoBundle\Form\siteType;

/**
 * site controller.
 *
 * @Route("/site")
 */
class siteController extends Controller
{
    /**
     * Lists all site entities.
     *
     * @Route("/", name="site")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('NexteerPoBundle:site')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a site entity.
     *
     * @Route("/{id}/show", name="site_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NexteerPoBundle:site')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find site entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new site entity.
     *
     * @Route("/new", name="site_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new site();
        $form   = $this->createForm(new siteType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new site entity.
     *
     * @Route("/create", name="site_create")
     * @Method("POST")
     * @Template("NexteerPoBundle:site:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new site();
        $form = $this->createForm(new siteType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('site_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing site entity.
     *
     * @Route("/{id}/edit", name="site_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NexteerPoBundle:site')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find site entity.');
        }

        $editForm = $this->createForm(new siteType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing site entity.
     *
     * @Route("/{id}/update", name="site_update")
     * @Method("POST")
     * @Template("NexteerPoBundle:site:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NexteerPoBundle:site')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find site entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new siteType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('site_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a site entity.
     *
     * @Route("/{id}/delete", name="site_delete")
     * @Method("POST")
     */
    public function deleteAction($id)
    {
//        $form = $this->createDeleteForm($id);
//        $form->bind($request);
//
//        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('NexteerPoBundle:site')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find site entity.');
            }

            $em->remove($entity);
            $em->flush();
//        }

        return $this->redirect($this->generateUrl('site'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
