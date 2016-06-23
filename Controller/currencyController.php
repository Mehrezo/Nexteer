<?php

namespace Nexteer\PoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Nexteer\PoBundle\Entity\currency;
use Nexteer\PoBundle\Form\currencyType;

/**
 * currency controller.
 *
 * @Route("/currency")
 */
class currencyController extends Controller
{
    /**
     * Lists all currency entities.
     *
     * @Route("/", name="currency")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('NexteerPoBundle:currency')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a currency entity.
     *
     * @Route("/{id}/show", name="currency_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NexteerPoBundle:currency')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find currency entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new currency entity.
     *
     * @Route("/new", name="currency_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new currency();
        $form   = $this->createForm(new currencyType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new currency entity.
     *
     * @Route("/create", name="currency_create")
     * @Method("POST")
     * @Template("NexteerPoBundle:currency:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new currency();
        $form = $this->createForm(new currencyType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('currency_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing currency entity.
     *
     * @Route("/{id}/edit", name="currency_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NexteerPoBundle:currency')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find currency entity.');
        }

        $editForm = $this->createForm(new currencyType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing currency entity.
     *
     * @Route("/{id}/update", name="currency_update")
     * @Method("POST")
     * @Template("NexteerPoBundle:currency:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NexteerPoBundle:currency')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find currency entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new currencyType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('currency_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a currency entity.
     *
     * @Route("/{id}/delete", name="currency_delete")
     * @Method("POST")
     */
    public function deleteAction($id)
    {
//        $form = $this->createDeleteForm($id);
//        $form->bind($request);
//
//        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('NexteerPoBundle:currency')->find($id);
            
            if (!$entity) {
                throw $this->createNotFoundException('Unable to find currency entity.');
            }
            
            $em->remove($entity);
            $em->flush();
//        }

        return $this->redirect($this->generateUrl('currency'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
