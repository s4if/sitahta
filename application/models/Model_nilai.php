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
 * Description of Model_nilai
 *
 * @author s4if
 */
class Model_nilai extends MY_Model {
    
    protected $nilai;

    public function __construct() {
        parent::__construct();
    }
    
    public function getData($where){
        return $this->em->getRepository('NilaiHarianEntity')->getData($where);
    }
    
    public function getDataByNo_uh($no_uh){
        return $this->em->getRepository('NilaiHarianEntity')->getDataByNo_uh($no_uh);
    }
    
    public function getDataByNis($nis){
        return $this->em->getRepository('NilaiHarianEntity')->getDataBySiswa($nis);
    }
    
    public function getNilaiSiswa(){
        $data = $this->em->getRepository('NilaiHarianEntity')->getNilaiSaatIni();
        $data_arr = array();
        foreach ($data as $row)
        {
            $data_arr[$row->getSiswa()->getNis()][$row->getNo_uh()] = $row;
        }
        return $data_arr;
    }

    public function getDataByKelas($kelas){
        return $this->em->getRepository('NilaiHarianEntity')->getDataByKelas($kelas);
    }
    
    public function insertData($data){
        $id = $data['no_uh'].$data['kelas'].$data['nis'];
        if(is_null($this->em->find("NilaiHarianEntity", $id))){
            $this->nilai = new NilaiHarianEntity();
//            try{
                $this->setData($data);
//            } catch (Exception $ex) {
//                return false;
//            }
            $this->nilai->generateId();
            $this->em->persist($this->nilai);
            $this->em->flush();
            $this->nilai = null;
            return true;
        }  else{
            return false;
        }
    }
    
    public function updateData($data){
        $id = $data['no_uh'].$data['kelas'].$data['nis'];
        if(!is_null($this->em->find("NilaiHarianEntity", $id))){
            $this->nilai = $this->em->find("NilaiHarianEntity", $id);
//            try {
                $this->setData($data);
//            } catch (Exception $ex) {
//                return false;
//            }
            $this->em->persist($this->nilai);
            $this->em->flush();
            $this->nilai = null;
            return true;
        }  else{
            return false;
        }
    }
    
    public function deleteData($data){
        $id = $data['no_uh'].$data['kelas'].$data['nis'];
        $entity = $this->em->find("NilaiHarianEntity", $id);
        if(!is_null($entity)){
             $this->em->remove($entity);
             $this->em->flush();
             $this->nilai = null;
             return true;
        }  else {
            return false;
        }
    }

    //jika ada error yang berkaitan dengan set data, lihat urutan pemberian data pada fungsi
    public function setData($data){
        if (!empty($data['no_uh'])) : $this->nilai->setNo_uh($data['no_uh']); endif;
        if (!empty($data['kelas'])) : $this->nilai->setKelas($data['kelas']); endif;
        if (!empty($data['tahun_ajaran'])) : $this->nilai->setKelas($data['tahun_ajaran']); endif;
        if (!empty($data['nis'])){ 
            $siswa = $this->em->find("SiswaEntity", $data['nis']);
            $this->nilai->setSiswa($siswa);
        }
        if (!empty($data['tanggal'])) {
            $tgl_arr = explode('-', $data['tanggal']);
            $tgl = new DateTime();
            $tgl->setDate($tgl_arr[0], $tgl_arr[1], $tgl_arr[2]);
            $this->nilai->setTanggal($tgl); 
        }
        if (!empty($data['juz'])) : $this->nilai->setJuz($data['juz']); endif;
        if (!empty($data['halaman'])) : $this->nilai->setHalaman($data['halaman']); endif;
        if (!empty($data['nilai'])) : $this->nilai->setNilai($data['nilai']); endif;
        if (!empty($data['nilai_remidi'])) : $this->nilai->setNilai($data['nilai_remidi']); endif;
        if (!empty($data['penguji'])){ 
            $penguji = $this->em->find("GuruEntity", $data['penguji']);
            $this->nilai->setPenguji($penguji);
        }
    }
    
    public function dataExist($no_uh, $nis, $kelas) {
        $id = $no_uh.$kelas.$nis;
        return !is_null($this->em->find("NilaiHarianEntity", $id));
    }
    
    public function getFilteredData($params){
        return $this->em->getRepository('NilaiHarianEntity')->getFilteredData($params);
    }
    
    public function getListKelas($kelas){
        return $this->em->getRepository('SiswaEntity')->getListKelas($kelas);
    }
}
