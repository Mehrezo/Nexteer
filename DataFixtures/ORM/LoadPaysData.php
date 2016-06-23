<?php
namespace Nexteer\PoBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Nexteer\PoBundle\Entity\pays;

class LoadPaysData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $TabPays=array(
        array('FRANCE','FR'),
        array('TUNISIE','TN'),
        array('ITALIE','IT'),
        array('PORTUGAL','PT'),
        array('SUISSE','CH'),
        array('TURQUIE','TR'),
        array('UKRAINE','UA'),
        array('URUGUAY','UY'),
        array('HONG KONG','HK'),
        array('GRECE','GR'),
        array('EGYPTE','EG'),
        array('EL SALVADOR','SV'),
        array('EMIRATS ARABES UNIS','AE'),
        array('EQUATEUR','EC'),
        array('DANEMARK','DK'),
        array('DJIBOUTI','DJ'),
        array('DOMINICAINE-REPUBLIQUE','DO'),
        array('BELGIQUE','BE'),
        array('AUSTRALIE','AU'),
        array('PORTO RICO','PR'),
        array('PORTUGAL','PT'),
        array('QATAR','QA'),
        array('PARAGUAY','PY'),
        array('PAYS-BAS','NL')
        );
        //print_r($TabPays); exit;
        foreach($TabPays as $TmpPays){
            $ElementPays = new pays();
            $ElementPays->setLibelle($TmpPays[0]);
            $ElementPays->setCode($TmpPays[1]);
            $manager->persist($ElementPays);
        }

        $manager->flush();
    }
}