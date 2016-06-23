<?php
namespace Nexteer\PoBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Nexteer\PoBundle\Entity\site;

class LoadSiteData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $TabData = array(
            array('pays_id' => '5','libelle' => 'Paris')
        );
        foreach($TabData as $TmpItem){
            $ElementObject = new site();
            $ElementObject->setPaysId($TmpItem['pays_id']);
            $ElementObject->setLibelle($TmpItem['libelle']);

            $manager->persist($ElementObject);
        }
        $manager->flush();
    }
}