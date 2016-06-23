<?php

namespace Nexteer\PoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Nexteer\PoBundle\Entity\currency
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class currency
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
     * @var string $code
     *
     * @ORM\Column(name="code", type="string", length=3)
     */
    private $code;

    /**
     * @var integer $country_name
     *
     * @ORM\ManyToOne(targetEntity="Nexteer\PoBundle\Entity\pays")
     * @ORM\JoinColumn(name="country_name", referencedColumnName="id")
     */
    private $country_name;

    /**
     * @var integer $used
     *
     * @ORM\Column(name="used", type="integer")
     */
    private $used;

    /**
     * @var string $adresse
     *
     * @ORM\Column(name="adresse", type="string", length=255)
     */
    private $adresse;


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
     * Set code
     *
     * @param string $code
     * @return currency
     */
    public function setCode($code)
    {
        $this->code = $code;
    
        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set country_name
     *
     * @param string $countryName
     * @return currency
     */
    public function setCountryName($countryName)
    {
        $this->country_name = $countryName;
    
        return $this;
    }

    /**
     * Get country_name
     *
     * @return string 
     */
    public function getCountryName()
    {
        return $this->country_name;
    }

    /**
     * Set used
     *
     * @param integer $used
     * @return currency
     */
    public function setUsed($used)
    {
        $this->used = $used;
    
        return $this;
    }

    /**
     * Get used
     *
     * @return integer 
     */
    public function getUsed()
    {
        return $this->used;
    }
    
    public function __toString()
    {
        return $this->getCode();
    }

    //-------------------------------------------
    /**
     * Set adresse
     *
     * @param string $adresse
     * @return currency
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }
}