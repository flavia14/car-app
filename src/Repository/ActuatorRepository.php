<?php

namespace App\Repository;

use App\Entity\Actuator;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Actuator>
 *
 * @method Actuator|null find($id, $lockMode = null, $lockVersion = null)
 * @method Actuator|null findOneBy(array $criteria, array $orderBy = null)
 * @method Actuator[]    findAll()
 * @method Actuator[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActuatorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Actuator::class);
    }

    public function save(Actuator $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Actuator $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
