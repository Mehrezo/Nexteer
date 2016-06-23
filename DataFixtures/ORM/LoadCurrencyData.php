<?php
namespace Nexteer\PoBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Nexteer\PoBundle\Entity\currency;

class LoadCurrencyData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $TabData = array(
            array('country_name' => '5','code' => 'EUR','used' => '10')
        );
        foreach($TabData as $TmpItem){
            $ElementObject = new currency();
            $ElementObject->setPaysId($TmpItem['pays_id']);
            $ElementObject->setCountryName($TmpItem['country_name']);
            $ElementObject->setCode($TmpItem['code']);
            $ElementObject->setUsed($TmpItem['used']);
            $manager->persist($ElementObject);
        }

        $manager->flush();
    }
}