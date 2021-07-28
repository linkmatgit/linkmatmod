<?php

namespace App\Repository;

use App\Entity\Auth\User;

use App\Entity\Revision\WipTagRevision;
use App\Entity\Work\Work;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;


/**
 * @method WipTagRevision|null find($id, $lockMode = null, $lockVersion = null)
 * @method WipTagRevision|null findOneBy(array $criteria, array $orderBy = null)
 * @method WipTagRevision[]    findAll()
 * @method WipTagRevision[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WipTagRevisionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WipTagRevision::class);
    }

    public function findLatest(): array
    {
        return $this->createQueryBuilder('r')
            ->where('r.status = :status')
            ->setMaxResults(10)
            ->setParameter('status', WipTagRevision::PENDING)
            ->getQuery()
            ->getResult();
    }

    public function findFor(User $user, Work $content): ?WipTagRevision
    {
        return $this->createQueryBuilder('r')
            ->where('r.author = :author')
            ->andWhere('r.target = :target')
            ->andWhere('r.status = :status')
            ->setParameters([
                'author' => $user,
                'target' => $content,
                'status' => WipTagRevision::PENDING,
            ])
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @return WipTagRevision[]
     */
    public function findPendingFor(User $user): array
    {
        return $this->queryAllForUser($user)
            ->andWhere('r.status = :status')
            ->setParameter('status', WipTagRevision::PENDING)
            ->getQuery()
            ->getResult();
    }

    public function queryAllForUser(User $user): QueryBuilder
    {
        return $this->createQueryBuilder('r')
            ->addSelect('w')
            ->leftJoin('r.target', 'w')
            ->where('r.author = :user')
            ->orderBy('r.createdAt', 'DESC')
            ->setMaxResults(10)
            ->setParameter('user', $user);
    }
}
