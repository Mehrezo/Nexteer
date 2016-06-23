<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 6/28/15
 * Time: 3:29 PM
 */
namespace Nexteer\PoBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Nexteer\PoBundle\Form\AnnonceRechercheType;

use Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrix;
use Ivory\GoogleMap\Services\Directions\Directions;
use Widop\HttpAdapter\CurlHttpAdapter;

use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\MapTypeId;
use Ivory\GoogleMap\Controls\ControlPosition;
use Ivory\GoogleMap\Controls\PanControl;
use Ivory\GoogleMap\Overlays\Animation;
use Ivory\GoogleMap\Overlays\Marker;
use Ivory\GoogleMap\Controls\ZoomControl;
use Ivory\GoogleMap\Events\MouseEvent;
use Ivory\GoogleMap\Overlays\InfoWindow;
use Ivory\GoogleMap\Overlays\EncodedPolyline;
use Ivory\GoogleMap\Overlays\Polyline;


class statsController extends Controller
{
    public function indexAction()
    {
        /*$name = 'Mehrez OUESLATI';
        $user = $this->getUser();
        //echo '<pre>';print_r($user); echo '</pre>';
        return $this->container->get('templating')->renderResponse('NexteerPoBundle:stats:index.html.twig',
            array('name' => $name));*/

        $form = $this->createForm(new AnnonceRechercheType());

        if ($form->isValid()) {
            echo 'je suis la'; exit;
        }

        //$request = $this->getRequest();
        return $this->render('NexteerPoBundle:stats:index.html.twig',
                                array('form' => $form->createView())
                            );
    }

    /**
     * Creates a new search.
     *
     * @Route("/stats/recherche", name="exec_recherche_annonce")
     * @Method("POST")
     * @Template("NexteerPoBundle:stats:affiche.html.twig")
     */
    public function afficheAction(Request $request)
    {
        $request = $this->get('request');
        $params = $request->request->get('nexteer_pobundle_recherche_annonces');
        $distanceMatrix = new DistanceMatrix(new CurlHttpAdapter());
        $directions = new Directions(new CurlHttpAdapter());

        $responseMatrix = $distanceMatrix->process(array($params['adresse_debut']), array($params['adresse_fin']));
        $responseDirections = $directions->route($params['adresse_debut'], $params['adresse_fin']);
        $routes = $responseDirections->getRoutes();
        $origins = $responseMatrix->getOrigins();
        $destinations = $responseMatrix->getDestinations();
        $donnees_trajet = $responseMatrix->getRows();

        $adresse_depart = $origins[0];
        $adresse_arrivee = $destinations[0];

        foreach ($donnees_trajet as $row) {
            $elements = $row->getElements();
            foreach ($elements as $key => $element) {
                $distance = $element->getdistance()->getText();
                $duree = $element->getduration()->getText();
                //echo "<pre><b>Distance:</b>"; print_r($element->getdistance()->getText()); echo '</pre>';
                //echo "<pre><b>Durée:</b>"; print_r($element->getduration()->getText()); echo '</pre>';
            }
        }
        $map = new Map();
        $map->setPrefixJavascriptVariable('map_');
        $map->setHtmlContainerId('map_canvas');
        //$map->setAsync(false);
        // Disable the auto zoom flag
        $map->setAutoZoom(true);
        // Sets the center
        $map->setCenter(49.044362, 2.0076449, true);
        // Sets the zoom
        $map->setMapOption('zoom', 8);
        //Set the type
        $map->setMapOption('mapTypeId', 'roadmap');
        $map->setStylesheetOption('width', '500px');
        $map->setStylesheetOption('height', '300px');
        $map->setLanguage('fr');


        // Markers
        $marker = new Marker();
        // Configure your marker options
        $marker->setPrefixJavascriptVariable('marker_');
        $marker->setPosition(49.051131, 2.0264212, true);
        $marker->setAnimation(Animation::DROP);
        $marker->setAnimation('bounce');
        $marker->setOption('clickable', true);
        $marker->setOption('flat', true);
        /*$marker->setOptions(array(
            'clickable' => false,
            'flat'      => true,
            ));
        */

        //ajouter une fenetre d'info sur le marker
        $infoWindow = new InfoWindow();
        $infoWindow->setPrefixJavascriptVariable('info_window_');
        $infoWindow->setPosition(0, 0, true);
        $infoWindow->setPixelOffset(1.1, 2.1, 'px', 'pt');
        $infoWindow->setContent('<p>Mehrez</p>');
        $infoWindow->setOpen(false);
        //$infoWindow->setAutoOpen(true);
        $infoWindow->setOpenEvent(MouseEvent::CLICK);
        $infoWindow->setAutoClose(true);
        $infoWindow->setOption('disableAutoPan', true);
        $infoWindow->setOption('zIndex', 10);
        /*$infoWindow->setOptions(array(
            'disableAutoPan' => true,
            'zIndex'         => 10,
                ));
        */
        //$infoWindow->setOpenEvent('click');
        $infoWindow->setOpenEvent('mouseover');
        // Add your info window to the marker
        $marker->setInfoWindow($infoWindow);
        //
        // Add your marker to the map
        $map->addMarker($marker);

        //Add your pan control to the map
        $panControl = new PanControl();
        $map->setPanControl($panControl);
        $map->setPanControl(ControlPosition::TOP_LEFT);
    //
    $zoomControl = new ZoomControl();
    $zoomControl->setControlPosition('top_right');
    $map->setZoomControl($zoomControl);
    //--------------------------------------------------
    // Polyline by Mehrez le 21/08/2015
    //--------------------------------------------------
        $encodedPolyline = new EncodedPolyline();
        foreach ($routes as $route) {
            $encodedPolyline->setValue($route->getOverviewPolyline()->getValue());
            $map->addEncodedPolyline($encodedPolyline);
        }
    //--------------------------------------------------


        return $this->render('NexteerPoBundle:stats:affiche.html.twig',
            array('map' => $map,
                  'adresse_depart' => $adresse_depart,
                  'adresse_arrivee' => $adresse_arrivee,
                  'distance' => $distance,
                  'duree' => $duree
            )
        );

    }


}