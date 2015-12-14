<?php

use Doctrine\ORM\EntityRepository;

class SiswaRepository extends EntityRepository{
    
    public function getData ($nis = -1, $number = 50) {
        $qb = $this->getEntityManager()->createQueryBuilder();
        if($nis == -1){
            $qb->select('s')
                ->from('SiswaEntity', 's')
                ->orderBy('s.nama', 'ASC');
            $query = $qb->getQuery();
            return $query->getResult();
        }else {
            $qb->select('s')
                ->from('SiswaEntity', 's')
                ->where('s.nis = :nis')
                ->orderBy('s.nama', 'ASC')
                ->setParameter('nis', $nis);
            $query = $qb->getQuery();
            return $query->getSingleResult();
        }
    }
    
    
    //ged filtered data sebaiknya dihapus, diganti dengan get kelas
    public function getFilteredData($params, $eager = false){
        $kelas = (empty($params['kelas']))?'empty':$params['kelas'];
        $jurusan = (empty($params['jurusan']))?'empty':$params['jurusan'];
        $no_kelas = (empty($params['no_kelas']))?'0':$params['no_kelas'];
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('s')
                ->from('SiswaEntity', 's');
        if($no_kelas === '0' && $jurusan === 'empty' &&  !($kelas === 'empty') ){
            $qb->andWhere("s.kelas = :kelas")
                ->setParameter('kelas', $kelas)
                ->orderBy("s.nis", "ASC");
        }elseif ($no_kelas === '0' && $kelas === 'empty' &&  !($jurusan === 'empty')) {
            $qb->andWhere("s.jurusan = :jurusan")
                ->setParameter('jurusan', $jurusan)
                ->orderBy("s.nis", "ASC");
        }elseif ($no_kelas === '0' && !($jurusan === 'empty') && !($kelas === 'empty')) {
            $qb->andWhere("s.kelas = :kelas")
                ->andWhere("s.jurusan = :jurusan")
                ->setParameter('jurusan', $jurusan)
                ->setParameter('kelas', $kelas)
                ->orderBy("s.nis", "ASC");
        }elseif ($kelas === 'empty' && !($jurusan === 'empty') && !($no_kelas === '0')) {
            $qb->andWhere("s.jurusan = :jurusan")
                ->andWhere("s.no_kelas = :no_kelas")
                ->setParameter('jurusan', $jurusan)
                ->setParameter('no_kelas', $no_kelas)
                ->orderBy("s.nis", "ASC");
        }elseif (!($kelas === 'empty') && $jurusan === 'empty' && !($no_kelas === '0')) {
            $qb->andWhere("s.kelas = :kelas")
                ->andWhere("s.no_kelas = :no_kelas")
                ->setParameter('kelas', $kelas)
                ->setParameter('no_kelas', $no_kelas)
                ->orderBy("s.nis", "ASC");
        }elseif(!($no_kelas === '0') && !($jurusan === 'empty') && !($kelas === 'empty')){
            $qb->andWhere("s.jurusan = :jurusan")
                ->andWhere("s.no_kelas = :no_kelas")
                ->andWhere('s.kelas = :kelas')
                ->setParameter('jurusan', $jurusan)
                ->setParameter('no_kelas', $no_kelas)
                ->setParameter('kelas', $kelas)
                ->orderBy("s.nis", "ASC");
        }else{
            
        }
        $query = $qb->getQuery();
        if($eager){
            $query->setFetchMode("Siswa", "nilai", Doctrine\ORM\Mapping\ClassMetadata::FETCH_EAGER);
        }
        return $query->getResult();
    }
    
    //ini juga diganti dengan get kelas
    public function getListKelas($kelas){
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('s')
            ->from('SiswaEntity', 's')
            ->groupBy('s.kelas')
            ->addGroupBy('s.jurusan')
            ->addGroupBy('s.no_kelas')
            ->having('s.kelas = :kelas')
            ->addOrderBy('s.no_kelas', 'ASC')
            ->setParameter('kelas', $kelas);
        $query = $qb->getQuery();
        return $query->getResult();
    }
    
    public function getDataByKelas ($kelas) {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select(['s', 'n', 'k'])
            ->from('SiswaEntity', 's')
            ->innerJoin('s.kelas', 'k', Doctrine\ORM\Query\Expr\Join::WITH, 'k.id = :kelas')
            ->join('s.nilai', 'n')
            ->orderBy('s.nis', 'ASC')
            ->setParameter('kelas', $kelas);
        $query = $qb->getQuery();
        return $query->getResult();
    }
}
