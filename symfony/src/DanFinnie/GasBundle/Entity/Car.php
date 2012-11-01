<?php

namespace DanFinnie\GasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DanFinnie\GasBundle\Entity\Car
 *
 * @ORM\Table()
 * @ORM\Entity
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
        $milesDriven = 0;
        $gallonsAdded = 0;

        for($i = 0; $i < count($this->logRecords)-1; $i++) {
            $earlyRecord = $this->logRecords[$i];
            $laterRecord = $this->logRecords[$i+1];

            $milesDriven += $laterRecord->getMileage() - $earlyRecord->getMileage();
            $gallonsAdded += $earlyRecord->getGallonsAdded();
        }

        if ($gallonsAdded == 0)
            return 0;
        else
            return $milesDriven * 1.0 / $gallonsAdded;
    }
}
