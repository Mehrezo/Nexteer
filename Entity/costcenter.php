<?php

namespace Nexteer\PoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Nexteer\PoBundle\Entity\costcenter
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class costcenter
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
     * @var string $costcenter
     *
     * @ORM\Column(name="costcenter", type="string", length=6)
     */
    private $costcenter;

    /**
     * @var string $description
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var integer $pays_id
     * @ORM\ManyToOne(targetEntity="Nexteer\PoBundle\Entity\pays")
     * @ORM\JoinColumn(name="pays_id", referencedColumnName="id")
     */
    private $pays_id;


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
     * Set costcenter
     *
     * @param string $costcenter
     * @return costcenter
     */
    public function setCostcenter($costcenter)
    {
        $this->costcenter = $costcenter;
    
        return $this;
    }

    /**
     * Get costcenter
     *
     * @return string 
     */
    public function getCostcenter()
    {
        return $this->costcenter;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return costcenter
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
     * Set pays_id
     *
     * @param integer $paysId
     * @return costcenter
     */
    public function setPaysId($paysId)
    {
        $this->pays_id = $paysId;
    
        return $this;
    }

    /**
     * Get pays_id
     *
     * @return integer 
     */
    public function getPaysId()
    {
        return $this->pays_id;
    }
}