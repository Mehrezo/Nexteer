<?php

namespace Nexteer\PoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Nexteer\PoBundle\Entity\paymentorder
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class paymentorder
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
     * @var integer $arnumber
     *
     * @ORM\Column(name="arnumber", type="integer")
     */
    private $arnumber;

    /**
     * @var integer $pays
     *
     * @ORM\ManyToOne(targetEntity="Nexteer\PoBundle\Entity\pays")
     * @ORM\JoinColumn(name="pays", referencedColumnName="id")
     */
    private $pays;

    /**
     * @var integer $site
     * 
     * @ORM\ManyToOne(targetEntity="Nexteer\PoBundle\Entity\site")
     * @ORM\JoinColumn(name="site", referencedColumnName="id")
     */
    private $site;

    /**
     * @var integer $departement
     *
     * @ORM\Column(name="departement", type="integer")
     */
    private $departement;

    /**
     * @var string $prnumber
     *
     * @ORM\Column(name="prnumber", type="string", length=255)
     */
    private $prnumber;

    /**
     * @var string $applicant
     *
     * @ORM\Column(name="applicant", type="string", length=255)
     */
    private $applicant;

     /**
     * @var string $suggestedsupplier
     *
     * @ORM\Column(name="suggestedsupplier", type="string", length=255)
     */
    private $suggestedsupplier;
    
    /**
     * @var integer $orderindex
     *
     * @ORM\Column(name="orderindex", type="integer")
     */
    private $orderindex;

    /**
     * @var string $Item
     *
     * @ORM\Column(name="Item", type="string", length=255)
     */
    private $Item;

    /**
     * @var string $description
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var integer $quantite
     *
     * @ORM\Column(name="quantite", type="integer")
     */
    private $quantite;

    /**
     * @var string $unitemesure
     *
     * @ORM\Column(name="unitemesure", type="string", length=100)
     */
    private $unitemesure;

    /**
     * @var float $unitprice
     *
     * @ORM\Column(name="unitprice", type="float")
     */
    private $unitprice;

    /**
     * @var float $amount
     *
     * @ORM\Column(name="amount", type="float")
     */
    private $amount;

    /**
     * @var \DateTime $deliverydate
     *
     * @ORM\Column(name="deliverydate", type="date")
     */
    private $deliverydate;

    /**
     * @var string $glaccount
     *
     * @ORM\Column(name="glaccount", type="string", length=255)
     */
    private $glaccount;

    /**
     * @var string $detailcc
     *
     * @ORM\Column(name="detailcc", type="string", length=255)
     */
    private $detailcc;

    /**
     * @var float $total
     *
     * @ORM\Column(name="total", type="float")
     */
    private $total;

    /**
     * @var integer $currency
     * 
     * @ORM\ManyToOne(targetEntity="Nexteer\PoBundle\Entity\currency")
     * @ORM\JoinColumn(name="currency", referencedColumnName="id")
     */
    private $currency;

    /**
     * @var \DateTime $requestdate
     *
     * @ORM\Column(name="requestdate", type="date")
     */
    private $requestdate;

    /**
     * @var string $Remarque
     *
     * @ORM\Column(name="Remarque", type="text")
     */
    private $Remarque;

    /**
     * @var string $phonenoapp
     *
     * @ORM\Column(name="phonenoapp", type="string", length=50)
     */
    private $phonenoapp;


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
     * Set arnumber
     *
     * @param integer $arnumber
     * @return paymentorder
     */
    public function setArnumber($arnumber)
    {
        $this->arnumber = $arnumber;
    
        return $this;
    }

    /**
     * Get arnumber
     *
     * @return integer 
     */
    public function getArnumber()
    {
        return $this->arnumber;
    }

    /**
     * Set pays
     *
     * @param integer $pays
     * @return paymentorder
     */
    public function setPays($pays)
    {
        $this->pays = $pays;
    
        return $this;
    }

    /**
     * Get pays
     *
     * @return integer 
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * Set site
     *
     * @param integer $site
     * @return paymentorder
     */
    public function setSite($site)
    {
        $this->site = $site;
    
        return $this;
    }

    /**
     * Get site
     *
     * @return integer 
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * Set departement
     *
     * @param string $departement
     * @return paymentorder
     */
    public function setDepartement($departement)
    {
        $this->departement = $departement;
    
        return $this;
    }

    /**
     * Get departement
     *
     * @return string 
     */
    public function getDepartement()
    {
        return $this->departement;
    }

    /**
     * Set prnumber
     *
     * @param string $prnumber
     * @return paymentorder
     */
    public function setPrnumber($prnumber)
    {
        $this->prnumber = $prnumber;
    
        return $this;
    }

    /**
     * Get prnumber
     *
     * @return string 
     */
    public function getPrnumber()
    {
        return $this->prnumber;
    }

    /**
     * Set applicant
     *
     * @param string $applicant
     * @return paymentorder
     */
    public function setApplicant($applicant)
    {
        $this->applicant = $applicant;
    
        return $this;
    }

    /**
     * Get applicant
     *
     * @return string 
     */
    public function getApplicant()
    {
        return $this->applicant;
    }

     /**
     * Set suggestedsupplier
     *
     * @param string $suggestedsupplier
     * @return paymentorder
     */
    public function setSuggestedsupplier($suggestedsupplier)
    {
        $this->suggestedsupplier = $suggestedsupplier;
    
        return $this;
    }

    /**
     * Get suggestedsupplier
     *
     * @return string 
     */
    public function getSuggestedsupplier()
    {
        return $this->suggestedsupplier;
    }

    /**
     * Set orderindex
     *
     * @param integer $orderindex
     * @return paymentorder
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
     * Set Item
     *
     * @param string $item
     * @return paymentorder
     */
    public function setItem($item)
    {
        $this->Item = $item;
    
        return $this;
    }

    /**
     * Get Item
     *
     * @return string 
     */
    public function getItem()
    {
        return $this->Item;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return paymentorder
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set quantite
     *
     * @param integer $quantite
     * @return paymentorder
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

    /**
     * Set unitemesure
     *
     * @param string $unitemesure
     * @return paymentorder
     */
    public function setUnitemesure($unitemesure)
    {
        $this->unitemesure = $unitemesure;
    
        return $this;
    }

    /**
     * Get unitemesure
     *
     * @return string 
     */
    public function getUnitemesure()
    {
        return $this->unitemesure;
    }

    /**
     * Set unitprice
     *
     * @param float $unitprice
     * @return paymentorder
     */
    public function setUnitprice($unitprice)
    {
        $this->unitprice = $unitprice;
    
        return $this;
    }

    /**
     * Get unitprice
     *
     * @return float 
     */
    public function getUnitprice()
    {
        return $this->unitprice;
    }

    /**
     * Set amount
     *
     * @param float $amount
     * @return paymentorder
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    
        return $this;
    }

    /**
     * Get amount
     *
     * @return float 
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set deliverydate
     *
     * @param \DateTime $deliverydate
     * @return paymentorder
     */
    public function setDeliverydate($deliverydate)
    {
        $this->deliverydate = $deliverydate;
    
        return $this;
    }

    /**
     * Get deliverydate
     *
     * @return \DateTime 
     */
    public function getDeliverydate()
    {
        return $this->deliverydate;
    }

    /**
     * Set glaccount
     *
     * @param string $glaccount
     * @return paymentorder
     */
    public function setGlaccount($glaccount)
    {
        $this->glaccount = $glaccount;
    
        return $this;
    }

    /**
     * Get glaccount
     *
     * @return string 
     */
    public function getGlaccount()
    {
        return $this->glaccount;
    }

    /**
     * Set detailcc
     *
     * @param string $detailcc
     * @return paymentorder
     */
    public function setDetailcc($detailcc)
    {
        $this->detailcc = $detailcc;
    
        return $this;
    }

    /**
     * Get detailcc
     *
     * @return string 
     */
    public function getDetailcc()
    {
        return $this->detailcc;
    }

    /**
     * Set total
     *
     * @param float $total
     * @return paymentorder
     */
    public function setTotal($total)
    {
        $this->total = $total;
    
        return $this;
    }

    /**
     * Get total
     *
     * @return float 
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set currency
     *
     * @param integer $currency
     * @return paymentorder
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    
        return $this;
    }

    /**
     * Get currency
     *
     * @return integer 
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Set requestdate
     *
     * @param \DateTime $requestdate
     * @return paymentorder
     */
    public function setRequestdate($requestdate)
    {
        $this->requestdate = $requestdate;
    
        return $this;
    }

    /**
     * Get requestdate
     *
     * @return \DateTime 
     */
    public function getRequestdate()
    {
        return $this->requestdate;
    }

    /**
     * Set Remarque
     *
     * @param string $remarque
     * @return paymentorder
     */
    public function setRemarque($remarque)
    {
        $this->Remarque = $remarque;
    
        return $this;
    }

    /**
     * Get Remarque
     *
     * @return string 
     */
    public function getRemarque()
    {
        return $this->Remarque;
    }

    /**
     * Set phonenoapp
     *
     * @param string $phonenoapp
     * @return paymentorder
     */
    public function setPhonenoapp($phonenoapp)
    {
        $this->phonenoapp = $phonenoapp;
    
        return $this;
    }

    /**
     * Get phonenoapp
     *
     * @return string 
     */
    public function getPhonenoapp()
    {
        return $this->phonenoapp;
    }
}