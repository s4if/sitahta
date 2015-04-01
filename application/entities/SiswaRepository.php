<?php

use Doctrine\ORM\EntityRepository;

class SiswaRepository extends EntityRepository{
    
    public function getData ($nis = -1, $number = 50) {
        $qb = $this->getEntityManager()->createQueryBuilder();
        if($nis == -1){
            $qb->select('s')
                ->from('Siswa', 's')
                ->orderBy('s.nis', 'ASC');
            $query = $qb->getQuery();
            return $query->getResult();
        }else {
            $qb->select('s')
                ->from('Siswa', 's')
                ->where('g.nis = :nis')
                ->orderBy('g.nis', 'ASC')
                ->setParameter('nip', $nis);
            $query = $qb->getQuery();
            return $query->getSingleResult();
        }
    }
}
