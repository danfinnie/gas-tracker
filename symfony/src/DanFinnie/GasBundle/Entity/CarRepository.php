<?php

namespace DanFinnie\GasBundle\Entity;

use Doctrine\ORM\EntityRepository;

class CarRepository extends EntityRepository
{
   public function findOneByIdWithAnnotations($id) {
      $result = $this->getEntityManager()
          ->createQuery("SELECT c as car, max(l.mileage) as max_mileage, min(l.mileage) as min_mileage, sum(l.gallonsAdded) as sum_gallons_added
                         FROM DanFinnieGasBundle:Car c
                         JOIN c.logRecords l
                         WHERE c.id = :id")
          ->setParameter('id', intval($id))
          ->getSingleResult();
          
      $car = $result['car'];
      $lastLogRecord = $this->getIndividualLogRecord($car, $result['max_mileage']);
      
      $car->setMpg($this->calcMpg($result['min_mileage'], $result['max_mileage'], $result['sum_gallons_added'], $lastLogRecord->getGallonsAdded()));
      $car->setMileage($lastLogRecord->getMileage());

      return $car;
   }

   private function calcMpg($startMiles, $endMiles, $gallonsTotal, $gallonsLastFillUp) {
      return ($endMiles - $startMiles) / ($gallonsTotal - $gallonsLastFillUp);
   }

   private function getIndividualLogRecord(Car $car, $logRecordMileage)
   {
      return $this->getEntityManager()
          ->createQuery("SELECT l FROM DanFinnieGasBundle:LogRecord l WHERE l.car = :carId AND l.mileage = :logRecordMileage")
          ->setParameter('logRecordMileage', intval($logRecordMileage))
          ->setParameter('carId', $car->getId())
          ->getSingleResult();
   }
}
