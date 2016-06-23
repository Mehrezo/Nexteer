<?php
namespace Nexteer\PoBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Nexteer\PoBundle\Entity\service;

class LoadServiceData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $TabData = array(
            array('libelle' => 'Service Technique'),
            array('libelle' => 'Service Commercial'),
        );
        foreach($TabData as $TmpItem){
            $ElementObject = new service();
            $ElementObject->setLibelle($TmpItem['libelle']);

            $manager->persist($ElementObject);
        }

        $manager->flush();
    }
}