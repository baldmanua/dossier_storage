<?php

namespace App\Repository;

use App\Entity\Dossier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Dossier|null find($id, $lockMode = null, $lockVersion = null)
 * @method Dossier|null findOneBy(array $criteria, array $orderBy = null)
 * @method Dossier[]    findAll()
 * @method Dossier[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DossierRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Dossier::class);
    }

    /**
     * @return Dossier[]
     */
    public function findAllActive()
    {
        return $this->createQueryBuilder('d')
            ->where('d.deleted = 0')
            ->getQuery()
            ->getResult();
    }

    /**
     * @param $id
     * @return Dossier
     * @throws NonUniqueResultException
     */
    public function findOneActive($id): ?Dossier
    {
        return $this->createQueryBuilder('d')
            ->where('d.id = :id')
            ->setParameter('id', $id)
            ->andWhere('d.deleted = 0')
            ->getQuery()
            ->getOneOrNullResult();
    }
}
