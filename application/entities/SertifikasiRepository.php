<?php

use Doctrine\ORM\EntityRepository;

class SertifikasiRepository extends EntityRepository {
    public function getData ($id) {
        $qb = $this->getEntityManager()->createQueryBuilder();
        if($id == -1){
            $qb->select('i')
                ->from('SertifikasiEntity', 'i')
                ->orderBy('i.id', 'ASC');
            $query = $qb->getQuery();
            return $query->getResult();
        }else {
            $qb->select('i')
                ->from('SertifikasiEntity', 'i')
                ->where('i.id = :id')
                ->orderBy('i.id', 'ASC')
                ->setParameter('id', $id);
            $query = $qb->getQuery();
            return $query->getSingleResult();
        }
    }
}
