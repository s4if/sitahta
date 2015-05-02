<?php

use Doctrine\ORM\EntityRepository;

class KelasRepository extends EntityRepository {
    
    public function getData($kelas = 'X'){
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('k')
            ->from('KelasEntity', 'k')
            ->where('k.kelas = :kelas')
            ->orderBy('k.id', 'ASC')
            ->setParameter('kelas', $kelas);
        $query = $qb->getQuery();
        return $query->getResult();
    }
    
    public function getDataById($id){
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('k')
            ->from('KelasEntity', 'k')
            ->where('k.id = :id')
            ->orderBy('k.id', 'ASC')
            ->setParameter('id', $id);
        $query = $qb->getQuery();
        return $query->getResult();
    }
}
