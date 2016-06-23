<?php
namespace Nexteer\PoBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Nexteer\PoBundle\Entity\costcenter;

class LoadCostCenterData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $TabData = array(
            array('pays_id' => '5','costcenter' => 'INVEST','description' => 'Investment center')
        );
        foreach($TabData as $TmpItem){
            $ElementObject = new costcenter();
            $ElementObject->setPaysId($TmpItem['pays_id']);
            $ElementObject->setCostcenter($TmpItem['costcenter']);
            $ElementObject->setDescription($TmpItem['description']);
            $manager->persist($ElementObject);
        }

        $manager->flush();
    }
}