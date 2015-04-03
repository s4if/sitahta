<?php

use Doctrine\ORM\EntityRepository;

class SertifikatRepository extends EntityRepository {
    
    public function getData ($id = -1, $number = 50) {
        $qb = $this->getEntityManager()->createQueryBuilder();
        if($id == -1){
            $qb->select('r')
                ->from('Sertifikat', 'r')
                ->orderBy('r.id', 'ASC');
            $query = $qb->getQuery();
            return $query->getResult();
        }else {
            $qb->select('r')
                ->from('Sertifikat', 'r')
                ->where('r.id = :id')
                ->orderBy('r.id', 'ASC')
                ->setParameter('id', $id);
            $query = $qb->getQuery();
            return $query->getSingleResult();
        }
    }
    
    public function getDataBySiswa($nis){
        $siswa = $this->getEntityManager()->getPartialReference('Siswa', $nis);
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('r')
            ->from('Sertifikat', 'r')
            ->where('r.siswa = :siswa')
            ->orderBy('r.id', 'ASC')
            ->setParameter('siswa', $siswa);
        $query = $qb->getQuery();
        return $query->getResult();
    }
}
