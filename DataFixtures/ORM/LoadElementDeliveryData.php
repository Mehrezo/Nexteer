<?php
namespace Nexteer\PoBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Nexteer\PoBundle\Entity\elementdelivery;

class LoadElementDeliveryData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $TabElementDelivery = array(
            array('id_delivery' => '1','orderindex' => '1','quantite' => '2'),
            array('id_delivery' => '1','orderindex' => '1','quantite' => '3'),
            array('id_delivery' => '1','orderindex' => '1','quantite' => '4'),
            array('id_delivery' => '1','orderindex' => '1','quantite' => '5'),
        );
        foreach($TabElementDelivery as $TmpItem){
            $ElementDelivery = new elementdelivery();

            $ElementDelivery->setIdDelivery($TmpItem['id_delivery']);
            $ElementDelivery->setOrderindex($TmpItem['orderindex']);
            $ElementDelivery->setQuantite($TmpItem['quantite']);

            $manager->persist($ElementDelivery);
        }

        $manager->flush();
    }
}