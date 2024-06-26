<?php

namespace App\Repository;

use App\Entity\BackSensor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BackSensor>
 *
 * @method BackSensor|null find($id, $lockMode = null, $lockVersion = null)
 * @method BackSensor|null findOneBy(array $criteria, array $orderBy = null)
 * @method BackSensor[]    findAll()
 * @method BackSensor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BackSensorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BackSensor::class);
    }

    public function save(BackSensor $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(BackSensor $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
