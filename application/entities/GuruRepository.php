<?php

use Doctrine\ORM\EntityRepository;

class GuruRepository extends EntityRepository {
    
    public function getData ($nip = -1, $number = 50) {
        $qb = $this->getEntityManager()->createQueryBuilder();
        if($nip == -1){
            $qb->select('g')
                ->from('Guru', 'g')
                ->orderBy('g.nip', 'ASC');
            $query = $qb->getQuery();
            return $query->getResult();
        }else {
            $qb->select('g')
                ->from('Guru', 'g')
                ->where('g.nip = :nip')
                ->orderBy('g.nip', 'ASC')
                ->setParameter('nip', $nip);
            $query = $qb->getQuery();
            return $query->getSingleResult();
        }
    }
    
}
