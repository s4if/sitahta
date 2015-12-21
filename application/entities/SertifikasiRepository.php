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
    
    public function getSertifikasiByDate($tgl_awal, $tgl_akhir){
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('i')
                ->from('SertifikasiEntity', 'i')
                ->andWhere($qb->expr()->between('i.tanggal', ':tgl_awal', ':tgl_akhir'))
                ->setParameters([
                    'tgl_awal' => DateTime::createFromFormat('d-m-Y', $tgl_awal),
                    'tgl_akhir' => DateTime::createFromFormat('d-m-Y', $tgl_akhir)
                ])
                ->orderBy('i.tanggal', 'ASC');
        $query = $qb->getQuery();
        return $query->getResult();
    }
}
