<?php
namespace Nexteer\PoBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Nexteer\PoBundle\Entity\tva;

class LoadTvaData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $TabData = array(
            array('pays_id' => '5','valeur' => '20'),
            array('pays_id' => '5','valeur' => '5.5')
        );
        foreach($TabData as $TmpItem){
            $ElementObject = new tva();
            $ElementObject->setPaysId($TmpItem['pays_id']);
            $ElementObject->setValeur($TmpItem['valeur']);

            $manager->persist($ElementObject);
        }
        $manager->flush();
    }
}