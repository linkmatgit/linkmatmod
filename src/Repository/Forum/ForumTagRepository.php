<?php

namespace App\Repository\Forum;


use App\Entity\Forum\Entity\ForumTag;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ForumTag|null find($id, $lockMode = null, $lockVersion = null)
 * @method ForumTag|null findOneBy(array $criteria, array $orderBy = null)
 * @method ForumTag[]    findAll()
 * @method ForumTag[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ForumTagRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ForumTag::class);
    }

    public function findTree(): array
    {
        $query = $this->createQueryBuilder('t')
            ->andWhere('t.online = true')
            ->orderBy('t.position', 'ASC');

        return array_values(array_filter(
            $query->getQuery()->getResult(),
            fn (ForumTag $tag) => null === $tag->getParent()
        ));
    }

    /**
     * @return ForumTag[]
     */
    public function findAllOrdered(): array
    {
        $parents = $this->findTree();
        $tags = [];
        foreach ($parents as $parent) {
            $tags[] = $parent;
            foreach ($parent->getChildren() as $child) {
                $tags[] = $child;
            }
        }

        return $tags;
    }

}
