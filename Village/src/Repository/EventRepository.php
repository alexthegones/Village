<?php

namespace App\Repository;

use App\Entity\Event;
use App\Entity\EventSearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;

/**
 * @method Event|null find($id, $lockMode = null, $lockVersion = null)
 * @method Event|null findOneBy(array $criteria, array $orderBy = null)
 * @method Event[]    findAll()
 * @method Event[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Event::class);
    }

    // /**
    //  * @return Event[] Returns an array of Event objects
    //  */

    public function findByLast(): array
    {
        return $this->createQueryBuilder('e') //SELECT avec 'e' pour alias de la table event
            ->setMaxResults(5) //limit
            ->orderBy('e.id', "ASC")
            ->getQuery()
            ->getResult();

    }

    public function findByAll(): array
    {   
        return $this->createQueryBuilder('e') //SELECT avec 'e' pour alias de la table event   
        ->orderBy('e.Date', "DESC")
        ->getQuery()
        ->getResult();

    }

    public function findSearch($search): array
    {   
            return $this->createQueryBuilder('e')
                ->andWhere('e.Nom LIKE :nom')
                ->andWhere('e.Lieu LIKE :lieu')
                ->setParameter('nom', "%{$search->getNom()}%" )
                ->setParameter('lieu', "%{$search->getLieu()}%" )
                ->orderBy('e.Date', "ASC")
                ->getQuery()
                ->getResult();

    }

   
}
