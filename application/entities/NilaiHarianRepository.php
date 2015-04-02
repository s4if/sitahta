<?php

use Doctrine\ORM\EntityRepository;

class NilaiHarianRepository extends EntityRepository {
    
    public function getData ($where = [], $number = 50) {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $id = (empty($where['no_uh'])||empty($where['kelas'])||empty($where['nis']))?
                $id = -1 : $where['no_uh'].$where['kelas'].$where['nis'];
        if($id == -1){
            $qb->select('n')
                ->from('NilaiHarian', 'n')
                ->orderBy('n.no_uh', 'ASC');
            $query = $qb->getQuery();
            return $query->getResult();
        }else {
            $qb->select('n')
                ->from('NilaiHarian', 'n')
                ->where('n.id = :id')
                ->orderBy('n.no_uh', 'ASC')
                ->setParameter('id', $id);
            $query = $qb->getQuery();
            return $query->getSingleResult();
        }
    }
    
    public function getDataByNo_uh($no_uh){
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('n')
            ->from('NilaiHarian', 'n')
            ->andwhere('n.no_uh = :no_uh')
            ->orderBy('n.no_uh', 'ASC')
            ->setParameter('no_uh', $no_uh);
        $query = $qb->getQuery();
        return $query->getResult();
    }
    
    public function getDataBySiswa($nis){
        $siswa = $this->getEntityManager()->getPartialReference('Siswa', $nis);
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('n')
            ->from('NilaiHarian', 'n')
            ->where('n.siswa = :siswa')
            ->orderBy('n.no_uh', 'ASC')
            ->setParameter('siswa', $siswa);
        $query = $qb->getQuery();
        return $query->getResult();
    }
    
    public function getDataByKelas($kelas){
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('n')
            ->from('NilaiHarian', 'n')
            ->where('n.kelas = :kelas')
            ->orderBy('n.no_uh', 'ASC')
            ->setParameter('kelas', $kelas);
        $query = $qb->getQuery();
        return $query->getResult();
    }
    
    public function getNilaiSaatIni(){
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('n')
            ->addSelect('s')
            ->from('NilaiHarian', 'n')
            ->innerJoin('n.siswa', 's')
            ->andWhere('n.kelas = s.kelas')
            ->orderBy('n.no_uh', 'ASC');
        $query = $qb->getQuery();
        $query->setFetchMode('NilaiHarian', 'n', Doctrine\ORM\Mapping\ClassMetadata::FETCH_EAGER);
        $query->setFetchMode('Siswa', 's', Doctrine\ORM\Mapping\ClassMetadata::FETCH_EAGER);
        return $query->getResult();
//        $dql = "SELECT n, s FROM nilaiharian n JOIN n.siswa s where n.kelas = s.kelas ORDER BY b.created DESC";
//        $query = $this->getEntityManager()->createQuery($dql);
//        return $query->getResult();
    }
}
