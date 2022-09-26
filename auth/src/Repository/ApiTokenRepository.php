<?php

namespace App\Repository;

use App\Entity\ApiToken;
use App\Helper\Status\ApiTokenStatus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ApiToken|null find($id, $lockMode = null, $lockVersion = null)
 * @method ApiToken|null findOneBy(array $criteria, array $orderBy = null)
 * @method ApiToken[]    findAll()
 * @method ApiToken[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ApiTokenRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ApiToken::class);
    }

    public function findByIds(array $ids): array
    {
        if (empty($ids)) {
            return [];
        }
        $qb = $this->createQueryBuilder('u');
        return $qb
            ->where($qb->expr()->in('u.id', ':ids'))
            ->setParameter('ids', $ids)
            ->andWhere('u.status = :stat')
            ->setParameter('stat', ApiTokenStatus::ACTIVE)
            ->getQuery()
            ->getResult();
    }

    public function findAndSet($token, $wbId)
    {
        $this
            ->createQueryBuilder('q')
            ->update()
            ->set('q.wbData', $wbId)
            ->set('q.status', 1)
            ->where('q.token = :token')
            ->setParameter('token', $token)
            ->getQuery()
            ->execute();
        ;
    }

    public function deleteWbData($id)
    {
        $this
            ->createQueryBuilder('q')
            ->update()
            ->set('q.wbData', ':null')
            ->where('q.wbData = :id')
            ->setParameter('id', $id)
            ->setParameter('null', null)
            ->getQuery()
            ->execute();
        ;
    }
    
    public function getTokenWithUser($user, $array = false)
    {
        $qb = $this
            ->createQueryBuilder('a')
            ->andWhere("a.status = 1")
            ->andWhere('a.apiUser = :user')
            ->setParameter('user', $user)
            ->getQuery()
            ->getResult();
        return $qb? ($array?$qb:$qb[0]) :null;
    }

    public function getTokenWithWbData($token, $oneRes = true)
    {
        $qb = $this
            ->createQueryBuilder('a')
            ->where("a.wbData is not null")
            ->andWhere("a.status = 1")
            ->andWhere('a.token = :token')
            ->setParameter('token', $token)
        ;
        return $oneRes?
            $qb
		        ->setMaxResults(1)
            	->getQuery()
		        ->getOneOrNullResult():
            $qb
		        ->getQuery()
		        ->getResult();
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(ApiToken $entity, bool $flush = true): void
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
    public function remove(ApiToken $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return ApiToken[] Returns an array of ApiToken objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ApiToken
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
