<?php

namespace DanFinnie\GasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class LogRecord
{
   /**
    * @ORM\Id
    * @ORM\Column(type="integer")
    * @ORM\GeneratedValue(strategy="AUTO")
    */
   protected $id;

   /**
    * @ORM\Column(type="integer")
    */
   protected $mileage;

   /**
    * @ORM\Column(type="integer")
    */
   protected $gallonsAdded;

   /**
    * @ORM\ManyToOne(targetEntity="Car", inversedBy="logRecords")
    * @ORM\JoinColumn(name="car_id", referencedColumnName="id")
    */
   protected $car;

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
     * Set mileage
     *
     * @param integer $mileage
     * @return LogRecord
     */
    public function setMileage($mileage)
    {
        $this->mileage = $mileage;
    
        return $this;
    }

    /**
     * Get mileage
     *
     * @return integer 
     */
    public function getMileage()
    {
        return $this->mileage;
    }

    /**
     * Set gallonsAdded
     *
     * @param integer $gallonsAdded
     * @return LogRecord
     */
    public function setGallonsAdded($gallonsAdded)
    {
        $this->gallonsAdded = $gallonsAdded;
    
        return $this;
    }

    /**
     * Get gallonsAdded
     *
     * @return integer 
     */
    public function getGallonsAdded()
    {
        return $this->gallonsAdded;
    }

    /**
     * Set car
     *
     * @param DanFinnie\GasBundle\Entity\Car $car
     * @return LogRecord
     */
    public function setCar(\DanFinnie\GasBundle\Entity\Car $car = null)
    {
        $this->car = $car;
    
        return $this;
    }

    /**
     * Get car
     *
     * @return DanFinnie\GasBundle\Entity\Car 
     */
    public function getCar()
    {
        return $this->car;
    }
}