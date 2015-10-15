<?php

/*
 * The MIT License
 *
 * Copyright 2015 s4if.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

/**
 * Description of KurikulumRepository
 *
 * @author s4if
 */

use Doctrine\ORM\EntityRepository;

class KurikulumRepository extends EntityRepository {
    
    public function getData ($id = -1, $tahun = -1) {
        if($tahun == -1){
            $tahun = date('Y');
        }
        $qb = $this->getEntityManager()->createQueryBuilder();
        if($id == -1){
            $qb->select('k')
                ->from('KurikulumEntity', 'k')
                ->andwhere('k.tahun = :tahun')
                ->addOrderBy('k.kelas', 'ASC')
                ->addOrderBy('k.semester', 'ASC')
                ->addOrderBy('k.no_uh', 'ASC')
                ->setParameter('tahun', $tahun);
            $query = $qb->getQuery();
            return $query->getResult();
        }else {
            $qb->select('k')
                ->from('KurikulumEntity', 'k')
                ->andwhere('k.id = :id')
                ->addOrderBy('k.kelas', 'ASC')
                ->addOrderBy('k.semester', 'ASC')
                ->addOrderBy('k.no_uh', 'ASC')
                ->setParameter('id', $id);
            $query = $qb->getQuery();
            return $query->getSingleResult();
        }
    }
    
    public function getDataByKelas($kelas, $tahun = -1){
        if($tahun == -1){
            $tahun = date('Y');
        }
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('k')
                ->from('KurikulumEntity', 'k')
                ->andwhere('k.kelas = :kelas')
                ->andwhere('k.tahun = :tahun')
                ->addOrderBy('k.kelas', 'ASC')
                ->addOrderBy('k.semester', 'ASC')
                ->addOrderBy('k.no_uh', 'ASC')
                ->setParameter('kelas', $kelas)
                ->setParameter('tahun', $tahun);
        $query = $qb->getQuery();
        return $query->getResult();
    }
    
    public function getDataByKelasAndUh($kelas, $tahun = null, $no_uh = 1, $semester = 1){
        if($tahun == null){
            $tahun = date('Y');
        }
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('k')
                ->from('KurikulumEntity', 'k')
                ->andwhere('k.kelas = :kelas')
                ->andwhere('k.tahun = :tahun')
                ->andwhere('k.no_uh = :no_uh')
                ->andwhere('k.semester = :semester')
                ->addOrderBy('k.kelas', 'ASC')
                ->addOrderBy('k.semester', 'ASC')
                ->addOrderBy('k.no_uh', 'ASC')
                ->setParameter('kelas', $kelas)
                ->setParameter('tahun', $tahun)
                ->setParameter('no_uh', $no_uh)
                ->setParameter('semester', $semester);
        $query = $qb->getQuery();
        return $query->getResult();
    }
}
