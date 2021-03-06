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
 * Description of Model_sertifikat
 *
 * @author s4if
 */
class Model_sertifikat extends MY_Model {
    
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
    
    public function getDataBySemester($nis, $semester, $tahun_ajaran){
        //NOTE : It may be revised
        $bulan_awal = ($semester == 1)?'07':'01';
        $bulan_akhir = ($semester == 1)?'12':'06';
        $tahun_input = ($semester == 1)? (int)$tahun_ajaran: (int)$tahun_ajaran +1;
        $str_awal = '1-'.$bulan_awal.'-'.$tahun_input;
        $str_akhir = '31-'.$bulan_akhir.'-'.$tahun_input;
        $tgl_awal = new DateTime($str_awal);
        $tgl_akhir = new DateTime($str_akhir);
        return $this->em->getRepository('SertifikatEntity')->getDataBySiswaSemester($nis,$tgl_awal,$tgl_akhir);
    }
    
    public function insertData($data){
        $search_id = empty($data['id'])?-1:$data['id'];
        if(is_null($this->em->find("SertifikatEntity", $search_id))){
            //perhatikan disini!
            try {
                $this->sertifikat = new SertifikatEntity();
                $this->setData($data);
                $this->sertifikat->generateId();
                $this->em->persist($this->sertifikat);
                $this->em->flush();
            return true;
            } catch (Doctrine\DBAL\Exception\UniqueConstraintViolationException $exc) {
                $this->initEntityManager();
                return false;
            }
        }  else{
            return false;
        }
    }
    
    public function updateData($data){
        $this->sertifikat = $this->em->find("SertifikatEntity", $data['nis'].'-'.$data['juz']);
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
        $entity = $this->em->find("SertifikatEntity", $where['nis'].'-'.$where['juz']);
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
