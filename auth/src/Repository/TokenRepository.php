<?php

namespace App\Repository;

use App\Entity\Token;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Token|null find($id, $lockMode = null, $lockVersion = null)
 * @method Token|null findOneBy(array $criteria, array $orderBy = null)
 * @method Token[]    findAll()
 * @method Token[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TokenRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Token::class);
    }

    public function removeAll()
    {
        foreach ($this->findAll() as $item){
            $this->getEntityManager()->remove($item);
        }
        $this->getEntityManager()->flush();
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Token $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Token $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }
    
    public function findLessUsed()
    {
        $qb = $this->createQueryBuilder('t');
        $rs = $qb->andWhere($qb->expr()->lt('t.currentcount', 't.maxcount'))
                ->andWhere('t.expires > CURRENT_TIMESTAMP()')
                ->addOrderBy($qb->expr()->diff('t.maxcount', 't.currentcount'), 'DESC')->setMaxResults(1)->getQuery()->getOneOrNullResult();
        if(isset($rs))
        {
            $qbe = $this->createQueryBuilder('t');
            $qbe->update()
                    ->set('t.currentcount', 't.currentcount + 1')
                    ->where('t.id = :id')
                    ->setParameter('id', $rs->getId())
                    ->getQuery()
                    ->execute();
        }
        
        return $rs;
        
    }

    // /**
    //  * @return Token[] Returns an array of Token objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Token
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
