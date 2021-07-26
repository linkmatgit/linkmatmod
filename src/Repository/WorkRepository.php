<?php

namespace App\Repository;

use App\Entity\Auth\User;
use App\Entity\Blog\Post;
use App\Entity\Work\Work;
use App\Infrastructure\Orm\AbstractRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Work|null find($id, $lockMode = null, $lockVersion = null)
 * @method Work|null findOneBy(array $criteria, array $orderBy = null)
 * @method Work[]    findAll()
 * @method Work[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
/**
 * @extends AbstractRepository<Post>
 */
class WorkRepository extends AbstractRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Work::class);
    }

    public function queryWorkByUserNotApprouve(User $user): Query {

        return $this->createQueryBuilder('w')
            ->where('w.author = :user')
            ->orderBy('w.id', 'DESC')
            ->andWhere('w.approved = false')
            ->setMaxResults(4)
            ->setParameter('user', $user)
            ->getQuery();
    }
    public function queryWorkByUserApprouve(User $user): Query {

        return $this->createQueryBuilder('w')
            ->where('w.author = :user')
            ->orderBy('w.id', 'DESC')
            ->andWhere('w.approved = true')
            ->setMaxResults(4)
            ->setParameter('user', $user)
            ->getQuery();

    }
    public function queryAllPublic():Query {
        return $this->createQueryBuilder('w')
            ->orderBy('w.', 'DESC')
            ->andWhere('w.approved = true')
            ->getQuery();

    }
    public function queryCheckIsNotEmpty(User $user):Query {
        return $this->createQueryBuilder('w')
            ->where('w.author = :user')
            ->setParameter('user', $user)
            ->getQuery();
    }

    public function queryWorkByUserNeedToBeApprouve(User $user): Query {

        return $this->createQueryBuilder('w')
            ->orderBy('w.id', 'DESC')
            ->andWhere('w.approved = false')
            ->getQuery();
    }
    public function getManagerNeedToApprouve(): Query {
        return $this->createQueryBuilder("w")
            ->andWhere("w.approved = false")
            ->getQuery();
    }
}
