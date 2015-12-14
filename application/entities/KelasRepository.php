<?php

use Doctrine\ORM\EntityRepository;

class KelasRepository extends EntityRepository {
    
    public function getData($kelas = 'X', $tahun_ajaran = '2014'){
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select(['k', 's'])
                ->from('KelasEntity', 'k')
                ->join('k.siswa', 's')
                ->where('k.kelas = :kelas')
                ->andWhere('k.tahun_ajaran = :tahun')
                ->orderBy('k.id', 'ASC')
                ->setParameter('kelas', $kelas)
                ->setParameter('tahun', $tahun_ajaran);
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
