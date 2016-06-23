<?php

namespace Nexteer\PoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Nexteer\PoBundle\Entity\delivery;
use Nexteer\PoBundle\Entity\elementdelivery;
use Nexteer\PoBundle\Form\deliveryType;

/**
 * delivery controller.
 *
 * @Route("/delivery")
 */
class deliveryController extends Controller
{
    /**
     * Lists all delivery entities.
     *
     * @Route("/", name="delivery")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('NexteerPoBundle:delivery')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a delivery entity.
     *
     * @Route("/{id}/show", name="delivery_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NexteerPoBundle:delivery')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find delivery entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new delivery entity.
     *
     * @Route("/new", name="delivery_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new delivery();
        
        $form   = $this->createForm(new deliveryType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new delivery entity.
     *
     * @Route("/create", name="delivery_create")
     * @Method("POST")
     * @Template("NexteerPoBundle:delivery:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $request = $this->get('request');
        $params = $request->request->get('nexteer_pobundle_deliverytype');
        $file=$request->files->get('nexteer_pobundle_deliverytype');
        $fichierupload = $file['fichierattachment'];
        //echo '<pre>';print_r($params);echo '</pre>';
        $prnumber = $params['prnumber'];
        $datelivraison = new \Datetime();
        $codeDelivery = $params['delivery'];
        unset($params['delivery']);
        unset($params['prnumber']);
        
        //-----------------------------------------------------------------------------------------
        //-----------------------------------------------------------------------------------------
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('NexteerPoBundle:paymentorder')->findBy(array('prnumber' => $prnumber, ), array('orderindex' => 'asc'));
        $entity  = new delivery();
        for($i=0; $i<count($entities); $i++) {
            $entity->getElementsDelivery()->add(new elementdelivery());
        }
        $form = $this->get('form.factory')->create(new deliveryType(),$entity);
        $form->bindRequest($request); 
        
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            // Deplacer le fichier uploadé
            $code_pays = substr($prnumber, 5, 2);
            if ($fichierupload != '') {
                $dir_uploads = $this->container->getParameter('dir_uploads');
                $fichierattachment = $_SERVER['SERVER_NAME'].$dir_uploads.$code_pays.'/'.str_replace(' ', '_',$fichierupload->getClientOriginalName());
                $fichierupload->move($_SERVER['DOCUMENT_ROOT'].$dir_uploads.$code_pays, str_replace(' ', '_', $fichierupload->getClientOriginalName()));
                $namefile = str_replace(' ', '_', $fichierupload->getClientOriginalName());
            }
            else {
                $fichierattachment ='';
                $namefile ='';
            }
            $entity  = new delivery();
            $entity->setDatelivraison($datelivraison);
            $entity->setDelivery($codeDelivery);
            $entity->setPrnumber($prnumber);
            $entity->setFichierattachment($fichierattachment);
            $entity->setNamefile($namefile);
        
            $em->persist($entity);
            $em->flush();
            // Persister les elementsDelivery...
            if ($entity->getId()!='') {
                // Enregistrer les elements ...
                foreach($params['elementsDelivery'] as $key_elem => $value_elem){                       
                    $elementdelivery = new elementdelivery();
                    $elementdelivery->setIdDelivery($entity->getId());
                    $elementdelivery->setOrderindex($value_elem['orderindex']);
                    $elementdelivery->setQuantite($value_elem['quantite']);
                    $em->persist($elementdelivery);
                }
                $em->flush();
            }
        
            return $this->redirect($this->generateUrl('paymentorder_createdelivery', array('id' => $prnumber)));
        }
        else {
            return array(
            'entity' => $entity,
            'entities' => $entities,
            'codeDelivery' => $codeDelivery,
            'form'   => $form->createView(),
        );
        }
        //-----------------------------------------------------------------------------------------
        //-----------------------------------------------------------------------------------------
        /*$em = $this->getDoctrine()->getManager();
        
        foreach($params as $key => $value) {
            $key_elem = explode("_", $key);
            if ($key_elem[0] == 'elemdelivery') {
                $elemdelivery[$key_elem[1]] = $value['quantite'];
                //Vérifier que la valeur fournie par l'utulisateur est bonne - Validation
                $tmp_po_quantite = $em->getRepository('NexteerPoBundle:paymentorder')->findById($key_elem);
                $po_quantite = $tmp_po_quantite[0]->getQuantite();
                unset($tmp_po_quantite);
            }
        }
        
        $em->persist($entity);
        $em->flush();
        if ($entity->getId()!='') {
            // Enregistrer les elements ...
            foreach($elemdelivery as $key_elem => $value_elem){
                echo 'getId:'.$entity->getId().'<br>';
                echo '$key_elem:'.$key_elem.'<br>';
                echo '$value_elem:'.$value_elem.'<br>';
                $elementdelivery = new elementdelivery();
                $elementdelivery->setIdDelivery($entity->getId());
                $elementdelivery->setOrderindex($key_elem);
                $elementdelivery->setQuantite($value_elem);
                $elementdelivery->setIdDelivery(44);
                $elementdelivery->setOrderindex(58);
                $elementdelivery->setQuantite(1);
                $em->persist($elementdelivery);
                $em->flush();
                //echo '<pre>'; print_r($key_elem .' -->'. $value_elem);echo '</pre>';exit;
            }
                
        }*/
        //echo '<pre>ID:'; print_r($entity->getId());echo '</pre>';exit; 
        //return $this->redirect($this->generateUrl('paymentorder_createdelivery', array('id' => $prnumber)));
        
        /*$entities = $em->getRepository('NexteerPoBundle:paymentorder')->findBy(array('prnumber' => $prnumber, ), array('orderindex' => 'asc'), 50, 0);
        $form = $this->get('form.factory')->create(new deliveryType($entities));
        //$form->bind($request);
        $form->bindRequest($request);  
        */
        /*if ($form->isValid()) {
            
            echo 'je suis dans valid';exit();
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('delivery_show', array('id' => $entity->getId())));
        }
        else {
            echo 'je suis dans le ELSE BIIM'; exit;
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );*/
    }

    /**
     * Displays a form to edit an existing delivery entity.
     *
     * @Route("/{id}/edit", name="delivery_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NexteerPoBundle:delivery')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find delivery entity.');
        }

        $editForm = $this->createForm(new deliveryType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing delivery entity.
     *
     * @Route("/{id}/update", name="delivery_update")
     * @Method("POST")
     * @Template("NexteerPoBundle:delivery:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NexteerPoBundle:delivery')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find delivery entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new deliveryType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('delivery_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a delivery entity.
     *
     * @Route("/{id}/delete", name="delivery_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('NexteerPoBundle:delivery')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find delivery entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('delivery'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
