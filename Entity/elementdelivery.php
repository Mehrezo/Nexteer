<?php

namespace Nexteer\PoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Nexteer\PoBundle\Entity\elementdelivery
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class elementdelivery
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    
    /**
     * @var integer $id_delivery
     *
     * @ORM\Column(name="id_delivery", type="integer")
     */
    private $id_delivery;

    /**
     * @var integer $orderindex
     *
     * @ORM\Column(name="orderindex", type="integer")
     */
    private $orderindex;

    /**
     * @var integer $quantite
     *
     * @ORM\Column(name="quantite", type="integer")
     */
    private $quantite;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set id_delivery
     *
     * @param integer $idDelivery
     * @return elementdelivery
     */
    public function setIdDelivery($idDelivery)
    {
        $this->id_delivery = $idDelivery;
    
        return $this;
    }

    /**
     * Get id_delivery
     *
     * @return integer 
     */
    public function getIdDelivery()
    {
        return $this->id_delivery;
    }

    /**
     * Set orderindex
     *
     * @param integer $orderindex
     * @return elementdelivery
     */
    public function setOrderindex($orderindex)
    {
        $this->orderindex = $orderindex;
    
        return $this;
    }

    /**
     * Get orderindex
     *
     * @return integer 
     */
    public function getOrderindex()
    {
        return $this->orderindex;
    }

    /**
     * Set quantite
     *
     * @param integer $quantite
     * @return elementdelivery
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;
    
        return $this;
    }

    /**
     * Get quantite
     *
     * @return integer 
     */
    public function getQuantite()
    {
        return $this->quantite;
    }
}
