<?php

namespace Nexteer\PoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Nexteer\PoBundle\Entity\paymentorder;
use Nexteer\PoBundle\Form\paymentorderType;
use Nexteer\PoBundle\Form\deliveryType;
use Nexteer\PoBundle\Entity\delivery;
use Nexteer\PoBundle\Entity\elementdelivery;
/**
 * paymentorder controller.
 *
 * @Route("/paymentorder")
 */
class paymentorderController extends Controller
{
    /**
     * Lists all paymentorder entities.
     *
     * @Route("/", name="paymentorder")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('NexteerPoBundle:paymentorder')->findAll();

        //echo'<pre>';print_r($entities);echo'</pre>';
        
        return array(
            'entities' => $entities,
        );
    }
    
    

    /**
     * Finds and displays a paymentorder entity.
     *
     * @Route("/{id}/show", name="paymentorder_show")
     * @Template()
     */
    public function showAction($id)
    {
        echo 'je suis dans SHOW<br>';
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NexteerPoBundle:paymentorder')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find paymentorder entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new paymentorder entity.
     *
     * @Route("/new", name="paymentorder_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new paymentorder();
        $form   = $this->createForm(new paymentorderType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new paymentorder entity.
     *
     * @Route("/create", name="paymentorder_create")
     * @Method("POST")
     * @Template("NexteerPoBundle:paymentorder:new.html.twig")
     */
    public function createAction(Request $request)
    {
        echo 'totA';exit;
        $entity  = new paymentorder();
        $form = $this->createForm(new paymentorderType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('paymentorder_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing paymentorder entity.
     *
     * @Route("/{id}/edit", name="paymentorder_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NexteerPoBundle:paymentorder')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find paymentorder entity.');
        }

        $editForm = $this->createForm(new paymentorderType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing paymentorder entity.
     *
     * @Route("/{id}/update", name="paymentorder_update")
     * @Method("POST")
     * @Template("NexteerPoBundle:paymentorder:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NexteerPoBundle:paymentorder')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find paymentorder entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new paymentorderType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('paymentorder_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a paymentorder entity.
     *
     * @Route("/{id}/delete", name="paymentorder_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('NexteerPoBundle:paymentorder')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find paymentorder entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('paymentorder'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
    
    // Ajouter par M_OU le 15/11/2012
    /**
     * Lists all paymentorder entities.
     *
     * @Route("/", name="listepo")
     * @Template()
     */
    public function listepoAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('NexteerPoBundle:paymentorder')->findBy(array('orderindex' => 1), array('id' => 'asc'), 50, 0);
        $xml='<rows>';
        foreach ($entities as $key => $value) {
            $xml.='<row id="'.$value->getPrnumber().'">
                                <cell>'.$value->getSuggestedsupplier().'</cell>
                                <cell>'.$value->getPrnumber().'</cell>
                                <cell>'.$value->getApplicant().'</cell>
                                <cell>'.$value->getPays().'</cell>
                                <cell>'.$value->getSite().'</cell>
                        </row>';
        }
        $xml .='</rows>';
        header('Content-Type: text/xml');
        echo  $xml;
        exit();
    }
    
    public function createdeliveryAction(Request $request, $id)
    {
        $new_crea = $request->query->get ('new_crea');
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('NexteerPoBundle:paymentorder')->findBy(array('prnumber' => $id, ), array('orderindex' => 'asc'));
        $listeDelivery = $em->getRepository('NexteerPoBundle:delivery')->findBy(array('prnumber' => $id, ), array('delivery' => 'desc'));
        //echo '<pre>';print_r($listeDelivery);echo '</pre>';
        if (count($listeDelivery) >0 && $new_crea !=1) {
            return $this->container->get('templating')->renderResponse(
                    'NexteerPoBundle:paymentorder:delivery.html.twig', 
                    array('listeDelivery' => $listeDelivery,
                              'prnumber' => $id
                        )
            );
        }
        else {
        $lastDelivery = ((count($listeDelivery) >0)?$listeDelivery[0]: '');
        unset($listeDelivery);
        //echo '<pre>';print_r($lastDelivery);echo '</pre>';
        //echo '$codeDelivery :'. $lastDelivery->getDelivery() .'<br>';
        if ($lastDelivery !='') {
            $codeDelivery = $lastDelivery->getDelivery();
            unset($lastDelivery);
            $suffixLastDelivery = substr( $codeDelivery, 0, 7);
            $anneeLastDelivery = substr( $codeDelivery, 7, 4);
            $moisLastDelivery = substr( $codeDelivery, 11, 2);
            $numLastDelivery = substr( $codeDelivery, 13, 4);
            if (($anneeLastDelivery == date("Y")) && ($moisLastDelivery == date("m"))) {
                $new_num = ($numLastDelivery+1);
                $nb_char_new = strlen($new_num);
                $zero_manque = 4 - $nb_char_new;
                $newCodeprefix='';
                for($i=0; $i < $zero_manque; $i++)
                    $newCodeprefix .= '0';
                $newCodeprefix .=$new_num;
                $codeDelivery = $suffixLastDelivery.date("Y").date("m").$newCodeprefix;
            }
            else {
                $codeDelivery = 'DELEU'.$entities[0]->getPays()->getCode().date("Y").date("m").'0001';
            }
        }
        else {
            $codeDelivery = 'DELEU'.$entities[0]->getPays()->getCode().date("Y").date("m").'0001';
        }
        
        $entity = new delivery();
        // Initialiser les champs Quantité de chaque ligne PO... on donne la valeur Orderindex = id de la PO qui permet d'identifier le produit
        for($i=0; $i<count($entities); $i++) {
            $elem = new elementdelivery();
            $elem->setOrderindex($entities[$i]->getId());
            $entity->getElementsDelivery()->add($elem);
        }
        //echo '<pre>';print_r($entities);echo '</pre>';
        $form   = $this->createForm(new deliveryType(), $entity);
        //echo '<pre>';print_r($form);echo '</pre>';
        return $this->container->get('templating')->renderResponse(
                    'NexteerPoBundle:paymentorder:delivery.html.twig', 
                    array('entities' => $entities,
                              'codeDelivery' => $codeDelivery,
                              'form' => $form->createView()
                        )
            );
        }
    }
}