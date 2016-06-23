<?php
namespace Nexteer\PoBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Nexteer\PoBundle\Entity\paymentorder;

class LoadPaymentorderData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $TabPaymentOrder = array(
            array('pays' => '5','site' => '4','currency' => '2','arnumber' => '1','departement' => '0','prnumber' => 'POREUFR2011120001',
                'applicant' => 'Hohmeister.Sandra','suggestedsupplier' => 'IBM France','orderindex' => '1','Item' => '1',
                'description' => 'tible for rental car dama','quantite' => '1','unitemesure' => 'EUR','unitprice' => '3157',
                'amount' => '3157','deliverydate' => '2015-07-31','glaccount' => '000002200A','detailcc' => 'FRA004',
                'total' => '3157','requestdate' => '2015-07-31','Remarque' => 'new kitchenette with electrical equipment for our office, because the old one is damaged.',
                'phonenoapp' => '+33633498671'),
            array('pays' => '5','site' => '4','currency' => '2','arnumber' => '9','departement' => '2','prnumber' => 'POREUFR2011120002','applicant' => 'Celada.Bertrand','suggestedsupplier' => 'IBM France','orderindex' => '1','Item' => '1','description' => 'tible for rental car dama1','quantite' => '1','unitemesure' => 'EUR','unitprice' => '1180.5','amount' => '1180.5','deliverydate' => '2015-07-31','glaccount' => '50003','detailcc' => 'FRA004','total' => '1180.5','requestdate' => '2015-07-31','Remarque' => 'new kitchenette with electrical equipment for our office, because the old one is damaged and doesn\'t fulfill safty standards.','phonenoapp' => '+33633498671')
        );


        //print_r($TabPaymentOrder); exit;
        foreach($TabPaymentOrder as $TmpPaymentorder){
            $ElementPaymentOrder = new paymentorder();

            $ElementPaymentOrder->setSite($TmpPaymentorder['site']);
            $ElementPaymentOrder->setCurrency($TmpPaymentorder['currency']);
            $ElementPaymentOrder->setArnumber($TmpPaymentorder['arnumber']);
            $ElementPaymentOrder->setDepartement($TmpPaymentorder['departement']);
            $ElementPaymentOrder->setPrnumber($TmpPaymentorder['prnumber']);
            $ElementPaymentOrder->setDescription($TmpPaymentorder['description']);
            $ElementPaymentOrder->setQuantite($TmpPaymentorder['quantite']);
            $ElementPaymentOrder->setUnitemesure($TmpPaymentorder['unitemesure']);
            $ElementPaymentOrder->setUnitprice($TmpPaymentorder['unitprice']);
            $ElementPaymentOrder->setAmount($TmpPaymentorder['amount']);
            $ElementPaymentOrder->setDeliverydate($TmpPaymentorder['deliverydate']);
            $ElementPaymentOrder->setGlaccount($TmpPaymentorder['glaccount']);
            $ElementPaymentOrder->setDetailcc($TmpPaymentorder['detailcc']);
            $ElementPaymentOrder->setTotal($TmpPaymentorder['total']);
            $ElementPaymentOrder->setRequestdate($TmpPaymentorder['requestdate']);
            $ElementPaymentOrder->setRemarque($TmpPaymentorder['Remarque']);
            $ElementPaymentOrder->setPhonenoapp($TmpPaymentorder['phonenoapp']);

            $manager->persist($ElementPaymentOrder);
        }

        $manager->flush();
    }
}