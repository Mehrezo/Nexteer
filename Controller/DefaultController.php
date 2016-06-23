<?php

namespace Nexteer\PoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {  
	$name = 'Mehrez OUESLATI';
        //$user = $this->getUser();
        //echo '<pre>';print_r($user); echo '</pre>';exit;
	return $this->container->get('templating')->renderResponse('NexteerPoBundle:Default:index.html.twig', array('name' => $name));
    }
}
