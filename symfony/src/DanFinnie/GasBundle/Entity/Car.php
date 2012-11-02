<?php

namespace DanFinnie\GasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DanFinnie\GasBundle\Entity\Car
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="DanFinnie\GasBundle\Entity\CarRepository")
 */
class Car
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
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;


    /**
     * @ORM\OneToMany(targetEntity="LogRecord", mappedBy="car")
     */
    private $logRecords;

    // Optional calculated fields.
    private $mpg;
    private $mileage;


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
     * Set id
     *
     * @param string $id
     * @return Car
     */
    public function setId($id)
    {
        $this->id = $id;
    
        return $this;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Car
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    public function __construct()
    {
        $this->logRecords = new ArrayCollection();
    }

    /**
     * Add logRecords
     *
     * @param DanFinnie\GasBundle\Entity\LogRecord $logRecords
     * @return Car
     */
    public function addLogRecord(\DanFinnie\GasBundle\Entity\LogRecord $logRecords)
    {
        $this->logRecords[] = $logRecords;
    
        return $this;
    }

    /**
     * Remove logRecords
     *
     * @param DanFinnie\GasBundle\Entity\LogRecord $logRecords
     */
    public function removeLogRecord(\DanFinnie\GasBundle\Entity\LogRecord $logRecords)
    {
        $this->logRecords->removeElement($logRecords);
    }

    /**
     * Get logRecords
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getLogRecords()
    {
        return $this->logRecords;
    }

    public function getMpg()
    {
        return $this->mpg;
    }

    public function setMpg($mpg)
    {
        $this->mpg = $mpg;
        return $this;
    }

    public function getMileage()
    {
        return $this->mileage;
    }

    public function setMileage($mileage)
    {
        $this->mileage = $mileage;
        return $this;
    }
}
