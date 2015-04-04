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
 * Description of Model_sertifikasi
 *
 * @author s4if
 */
class Model_sertifikasi extends MY_Model {
    
    private $sertifikat;

    public function __construct() {
        parent::__construct();
    }
    
    public function getData($id = -1){
        return $this->em->getRepository('SertifikatEntity')->getData($id);
    }
    
    public function getDataByNis($nis){
        return $this->em->getRepository('SertifikatEntity')->getDataBySiswa($nis);
    }
    
    public function insertData($data){
        $data['id'] = empty($data['id'])?-1:$data['id'];
        if(is_null($this->em->find("SertifikatEntity", $data['id']))){
            $this->sertifikat = new SertifikatEntity();
            $this->setData($data);
            $this->em->persist($this->sertifikat);
            $this->em->flush();
            return true;
        }  else{
            return false;
        }
    }
    
    public function updateData($data){
        $this->sertifikat = $this->em->find("SertifikatEntity", $data['id']);
        if(!is_null($this->sertifikat)){
            $this->setData($data);
            $this->em->persist($this->sertifikat);
            $this->em->flush();
            return true;
        }else{
            return false;
        }
    }
    
    public function deleteData($where){
        $entity = $this->em->find("SertifikatEntity", $where['id']);
        if(!is_null($entity)){
             $this->em->remove($entity);
             $this->em->flush();
             return true;
        }  else {
            return false;
        }
    }
    
    //jika ada error yang berkaitan dengan set data, lihat urutan pemberian data pada fungsi
    private function setData($data){
        $this->sertifikat = new SertifikatEntity();
        if ((!empty($data['id']))&&($data['id']!=-1)) : $this->sertifikat->setId($data['id']); endif;
        if (!empty($data['nis'])){ 
            $siswa = $this->em->find('SiswaEntity', $data['nis']);
            $this->sertifikat->setSiswa($siswa); 
        }
        if (!empty($data['tempat_ujian'])) : $this->sertifikat->setTempat_ujian($data['tempat_ujian']); endif;
        if (!empty($data['tgl_ujian'])) {
            $tgl_arr = explode('-', $data['tgl_ujian']);
            $tgl = new DateTime();
            $tgl->setDate($tgl_arr[0], $tgl_arr[1], $tgl_arr[2]);
            $this->sertifikat->setTgl_ujian($tgl);
        }
        if (!empty($data['juz'])) : $this->sertifikat->setJuz($data['juz']); endif;
        if (!empty($data['nilai'])) : $this->sertifikat->setNilai($data['nilai']); endif;
        if (!empty($data['predikat'])) : $this->sertifikat->setPredikat($data['predikat']); endif;
        if (!empty($data['keterangan'])) : $this->sertifikat->setKeterangan($data['keterangan']); endif;
    }    
}
