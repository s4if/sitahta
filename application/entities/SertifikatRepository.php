<?php

use Doctrine\ORM\EntityRepository;

class SertifikatRepository extends EntityRepository {
    
    public function getData ($id = -1, $number = 50) {
        $qb = $this->getEntityManager()->createQueryBuilder();
        if($id == -1){
            $qb->select('r')
                ->from('SertifikatEntity', 'r')
                ->orderBy('r.id', 'ASC');
            $query = $qb->getQuery();
            return $query->getResult();
        }else {
            $qb->select('r')
                ->from('SertifikatEntity', 'r')
                ->where('r.id = :id')
                ->orderBy('r.id', 'ASC')
                ->setParameter('id', $id);
            $query = $qb->getQuery();
            return $query->getSingleResult();
        }
    }
    
    public function getDataBySiswa($nis){
        $siswa = $this->getEntityManager()->getPartialReference('SiswaEntity', $nis);
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('r')
            ->from('SertifikatEntity', 'r')
            ->where('r.siswa = :siswa')
            ->orderBy('r.id', 'ASC')
            ->setParameter('siswa', $siswa);
        $query = $qb->getQuery();
        return $query->getResult();
    }
    
    public function getDataBySiswaSemester($nis, $date_start, $date_end){
        $siswa = $this->getEntityManager()->getPartialReference('SiswaEntity', $nis);
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('r')
                ->from('SertifikatEntity', 'r')
                ->andWhere($qb->expr()->between('r.tgl_ujian', ':tgl_awal', ':tgl_akhir'))
                ->andWhere($qb->expr()->eq('r.siswa', ':siswa'))
                ->setParameters([
                    'tgl_awal' => $date_start,
                    'tgl_akhir' => $date_end,
                    'siswa' => $siswa
                ])
                ->orderBy('r.tgl_ujian', 'ASC');
        $query = $qb->getQuery();
        return $query->getResult();
    }
}
