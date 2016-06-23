<?php
namespace Nexteer\PoBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Nexteer\PoBundle\Entity\paymentterms;

class LoadPayementTermsData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $TabData = array(
            array('libelle' => 'Payment 30 days after invoice date'),
            array('libelle' => 'Payment 45 days after invoice date'),
            array('libelle' => 'Payment 60 days after invoice date')
        );
        foreach($TabData as $TmpItem){
            $ElementObject = new paymentterms();
            $ElementObject->setLibelle($TmpItem['libelle']);
            $manager->persist($ElementObject);
        }

        $manager->flush();
    }
}