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
 * Description of Model_kurikulum
 *
 * @author s4if
 */
class Model_kurikulum extends MY_Model {
    protected $kurikulum;
    
    public function __construct() {
        parent::__construct();
    }
    
    public function getData($id = -1, $tahun = -1){
        return $this->em->getRepository('KurikulumEntity')->getData($id, $tahun);
    }
    
    public function getDataByKelas($kelas = 'X', $tahun = -1){
        return $this->em->getRepository('KurikulumEntity')->getDataByKelas($kelas, $tahun);
    }
    
    public function getDataByParams($kelas = 'X', $tahun = -1, $no_uh = 1, $semester = 1){
        return $this->em->getRepository('KurikulumEntity')->getDataByKelasAndUh($kelas, $tahun, $no_uh, $semester);
    }
    
    // for testing only!!!
    public function reset($tahun = 2015, $kelas_x = 20, $kelas_xi = 10, $kelas_xii = 10){
        //$this->truncate(['kurikulum'], TRUE);
        // Setting Jumlah Ulangan
        $jumlah_ulangan ['X']= $kelas_x;
        $jumlah_ulangan ['XI'] = $kelas_xi;
        $jumlah_ulangan ['XII'] = $kelas_xii;
        $arr_kelas =['X','XI','XII'];
        // Set Up Kurikulum
        foreach ($arr_kelas as $kelas){
            for($j = 1; $j <= 2 ; $j++){
                for($i = 1; $i <= $jumlah_ulangan[$kelas];$i++){
                    $id = $kelas.'-'.$j.'-'.$i.'-'.$tahun;
                    $kurikulum = $this->em->find("KurikulumEntity", $id);
                    if (is_null($kurikulum)){
                        $kurikulum = new KurikulumEntity();
                    }
                    $kurikulum->setKelas($kelas);
                    $kurikulum->setSemester($j);
                    $kurikulum->setNo_uh($i);
                    $kurikulum->setTahun($tahun);
                    $kurikulum->generateId();
                    $this->em->persist($kurikulum);
                    $this->em->flush();
                }
                $id = $kelas.'-'.$j.'-'.'UTS'.'-'.$tahun;
                $kurikulum = $this->em->find("KurikulumEntity", $id);
                if (is_null($kurikulum)){
                    $kurikulum = new KurikulumEntity();
                }
                $kurikulum->setKelas($kelas);
                $kurikulum->setSemester($j);
                $kurikulum->setNo_uh('UTS');
                $kurikulum->setTahun($tahun);
                $kurikulum->generateId();
                $this->em->persist($kurikulum);
                $this->em->flush();
                unset($kurikulum);
                $id = $kelas.'-'.$j.'-'.'UAS'.'-'.$tahun;
                $kurikulum = $this->em->find("KurikulumEntity", $id);
                if (is_null($kurikulum)){
                    $kurikulum = new KurikulumEntity();
                }
                $kurikulum->setKelas($kelas);
                $kurikulum->setSemester($j);
                $kurikulum->setNo_uh('UAS');
                $kurikulum->setTahun($tahun);
                $kurikulum->generateId();
                $this->em->persist($kurikulum);
                $this->em->flush();
            }
        }
    }
    
    public function insertData($data){
        $id = $data['kelas'].'-'.$data['semester'].'-'.$data['no_uh'].'-'.$data['tahun_ajaran'];
        if(is_null($this->em->find("KurikulumEntity", $id))){
            $this->kurikulum = new KurikulumEntity();
            $this->setData($data);
            $this->kurikulum->generateId();
            $this->em->persist($this->kurikulum);
            $this->em->flush();
            return true;
        }  else{
            return false;
        }
    }
    
    public function updateData($data){
        $id = $data['kelas'].'-'.$data['semester'].'-'.$data['no_uh'].'-'.$data['tahun_ajaran'];
        $this->kurikulum = $this->em->find("KurikulumEntity", $id);
        if(!is_null($this->kurikulum)){
            $this->setData($data);
            $this->kurikulum->generateId();
            $this->em->persist($this->kurikulum);
            $this->em->flush();
            return true;
        }else{
            return false;
        }
    }
    
    public function resetData($data){
        $id = $data['kelas'].'-'.$data['semester'].'-'.$data['no_uh'].'-'.$data['tahun_ajaran'];
        $this->kurikulum = $this->em->find("KurikulumEntity", $id);
        if(!is_null($this->kurikulum)){
            $this->kurikulum->reset();
            $this->em->persist($this->kurikulum);
            $this->em->flush();
            return true;
        }else{
            return false;
        }
    }
    
    public function deleteData($where){
        $entity = $this->em->find("KurikulumEntity", $where['id']);
        if(!is_null($entity)){
             $this->em->remove($entity);
             $this->em->flush();
             return true;
        }  else {
            return false;
        }
    }
    
    public function setData($data){
        if (!empty($data['no_uh'])) : $this->kurikulum->setNo_uh($data['no_uh']); endif;
        if (!empty($data['kelas'])) : $this->kurikulum->setKelas($data['kelas']); endif;
        if (!empty($data['semester'])) : $this->kurikulum->setSemester($data['semester']); endif;
        if (!empty($data['tahun_ajaran'])) : $this->kurikulum->setTahun($data['tahun_ajaran']); endif;
        if (!empty($data['juz'])) : $this->kurikulum->setJuz($data['juz']); endif;
        if (!empty($data['surat_awal'])) : $this->kurikulum->setSurat_awal($data['surat_awal']); endif;
        if (!empty($data['ayat_awal'])) : $this->kurikulum->setAyat_awal($data['ayat_awal']); endif;
        if (!empty($data['surat_akhir'])) : $this->kurikulum->setSurat_akhir($data['surat_akhir']); endif;
        if (!empty($data['ayat_akhir'])) : $this->kurikulum->setAyat_akhir($data['ayat_akhir']); endif;
    }
}
