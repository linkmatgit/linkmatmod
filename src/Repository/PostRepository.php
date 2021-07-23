<?php

namespace App\Repository;

use App\Entity\Blog\Category;
use App\Entity\Blog\Post;
use App\Infrastructure\Orm\AbstractRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Post|null find($id, $lockMode = null, $lockVersion = null)
 * @method Post|null findOneBy(array $criteria, array $orderBy = null)
 * @method Post[]    findAll()
 * @method Post[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
/**
 * @extends AbstractRepository<Post>
 */
class PostRepository extends AbstractRepository
{
    CONST LIMIT = 4;
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Post::class);
    }


    public function getFourLastTopicPublic(?Category $category = null): array{
       $query = $this->createQueryBuilder('p')
            ->orderBy('p.createdAt', 'DESC')
           ->where('p.online = true AND p.createdAt < NOW()')

            ->setMaxResults(self::LIMIT);

           return $query->getQuery()->getResult();
    }
    public function queryAll(?Category $category = null): Query
    {
        $query = $this->createQueryBuilder('p')
            ->select('p')
            ->where('p.online = true AND p.createdAt < NOW()')
            ->orderBy('p.createdAt', 'DESC');

        if ($category) {
            $query = $query
                ->andWhere('p.category = :category')
                ->setParameter('category', $category);
        }

        return $query->getQuery();
    }
}
