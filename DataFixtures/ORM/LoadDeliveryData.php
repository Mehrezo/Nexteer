<?php
namespace Nexteer\PoBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Nexteer\PoBundle\Entity\delivery;

class LoadDeliveryData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $TabData = array(
            array('prnumber' => 'LOST12737520','datelivraison' => '2015-07-31','delivery' => '1','fichierattachment' => '','namefile' => '')
        );
        foreach($TabData as $TmpItem){
            $ElementObject = new delivery();
            $ElementObject->setPrnumber($TmpItem['prnumber']);
            $ElementObject->setDatelivraison($TmpItem['datelivraison']);
            $ElementObject->setDelivery($TmpItem['delivery']);
            $ElementObject->setFichierattachment($TmpItem['fichierattachment']);
            $ElementObject->setNamefile($TmpItem['namefile']);
            $manager->persist($ElementObject);
        }

        $manager->flush();
    }
}