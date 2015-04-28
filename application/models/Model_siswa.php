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
 * Description of Model_siswa
 *
 * @author s4if
 */
class Model_siswa extends MY_Model {
    
    protected $siswa;
    protected $kelas;
    
    public function __construct() {
        parent::__construct();
    }
    
    public function getData($nis = -1){
        return $this->em->getRepository('SiswaEntity')->getData($nis);
    }
    
    public function insertData($data){
        if(is_null($this->em->find("SiswaEntity", $data['nis']))){
            $this->siswa = new SiswaEntity();
            $this->setData($data);
            $this->em->persist($this->siswa);
            $this->em->flush();
            return true;
        }  else{
            return false;
        }
    }
    
    public function updateData($data){
        $this->siswa = $this->em->find("SiswaEntity", $data['nis']);
        if(!is_null($this->siswa)){
            $this->setData($data);
            $this->em->persist($this->siswa);
            $this->em->flush();
            return true;
        }else{
            return false;
        }
    }
    
    public function deleteData($where){
        $entity = $this->em->find("SiswaEntity", $where['nis']);
        if(!is_null($entity)){
             $this->em->remove($entity);
             $this->em->flush();
             return true;
        }  else {
            return false;
        }
    }
    
    //jika ada error yang berkaitan dengan set data, lihat urutan pemberian data pada fungsi
    public function setData($data){
        if (!empty($data['nis'])) : $this->siswa->setNis($data['nis']); endif;
        if (!empty($data['nama'])) : $this->siswa->setNama($data['nama']); endif;
        if (!empty($data['jenis_kelamin'])) : $this->siswa->setJenis_kelamin($data['jenis_kelamin']); endif;
        if (!empty($data['tempat_lahir'])) : $this->siswa->setTempat_lahir($data['tempat_lahir']); endif;
        if (!empty($data['tgl_lahir'])){
            $tgl_arr = explode('-', $data['tgl_lahir']);
            $tgl = new DateTime();
            $tgl->setDate($tgl_arr[0], $tgl_arr[1], $tgl_arr[2]);
            $this->siswa->setTgl_lahir($tgl); 
        }
        if (!(empty($data['kelas'])&&empty($data['jurusan'])&&empty($data['no_kelas'])&&empty($data['tahun_ajaran']))) :
            $str_jur = ($data['kelas'] == 'X')?'':$data['jurusan'].'-';
            $id = $data['kelas']."-".$str_jur.$data['no_kelas'].'-'.$data['tahun_ajaran'];
            $this->kelas = $this->em->find("KelasEntity", $id);
            if(!is_null($this->kelas)){
                $this->siswa->addKelas($this->kelas);
            }else{
                $this->kelas = new KelasEntity();
                $this->kelas->setKelas($data['kelas'])
                        ->setJurusan($data['jurusan'])
                        ->setNo_kelas($data['no_kelas'])
                        ->setTahun_ajaran($data['tahun_ajaran'])
                        ->generateId();
                $this->em->persist($this->kelas);
                $this->siswa->addKelas($this->kelas);
            }
        endif;
        if (!empty($data['password'])) : $this->siswa->setPassword($data['password']); endif;
        if (!empty($data['nama_ortu'])) : $this->siswa->setNama_ortu($data['nama_ortu']); endif;
    }
    
    public function getFilteredData($params, $eager = false){
        return $this->em->getRepository('SiswaEntity')->getFilteredData($params,$eager);
    }
    
    /**
     * 
     * @param type $file_url
     * @return 0 for ok, -1 for file wrong, > 0 for data wrong
     */
    public function importData($file_url){
        try {
            $objReader = new PHPExcel_Reader_Excel5();
            $objPHPExcel = $objReader->load($file_url);
            $objWorksheet = $objPHPExcel->getActiveSheet();
            $lastRow = $objWorksheet->getHighestDataRow();
            $failureCount = 0;
            $this->em->getConnection()->beginTransaction();
            $data = $objWorksheet->rangeToArray('A1'.':J'.$lastRow, null, TRUE);
            for ($i = 1; $i < $lastRow;$i++){
                $row_data = $data[$i];
                if($this->cellValidation($row_data)){
                    $this->transQuery($row_data);
                }  else {
                    $failureCount=+2;
                    //$this->em->getConnection()->rollback();
                    break;
                }
            }
            if(($failureCount > 0)){
                $this->em->getConnection()->rollback();
            }else{
                $this->em->getConnection()->commit();
            }
            return $failureCount;
        }  catch (PHPExcel_Exception $ex) {
            return -1;
        }
    }
    
    private function cellValidation($row_data){
        $cellValid = true;
        foreach ($row_data as $cell){
            if(is_null($cell)){
                $cellValid = false;
                break;
            }
        }
        return $cellValid;
    }
    
    private function dataCorrection($row_data){
        //cek tanggal
        $tgl_mentah = explode("/", $row_data[4]);
        $tgl = new DateTime();
        $tgl->setDate($tgl_mentah[2], $tgl_mentah[1], $tgl_mentah[0]);
        $row_data[4] = $tgl;
        if(!(($row_data[5] == 'X') || ($row_data[5] == 'XI') || ($row_data[5] == 'XII'))){
            $row_data[5] = 'X';
        }
        if(!(($row_data[6] == 'Reguler') || ($row_data[6] == 'Tahfidz') || ($row_data[6] == 'IPA') || ($row_data[6] == 'IPS'))){
            $row_data[6] = ($row_data[5] == 'X')?'Reguler':'IPA';
        }
        return $row_data;
    }
    
    private function transQuery($row_data){
        $data_insert = $this->dataCorrection($row_data);
        $this->siswa = (is_null($this->em->find("SiswaEntity", $data_insert[0])))?
                new SiswaEntity() : $this->em->find("SiswaEntity", $data_insert[0]);
        $this->siswa->setNis($data_insert[0]);
        $this->siswa->setNama($data_insert[1]);
        $this->siswa->setJenis_kelamin($data_insert[2]);
        $this->siswa->setTempat_lahir($data_insert[3]);
        $this->siswa->setTgl_lahir($data_insert[4]);
        $this->siswa->addKelas($this->initKelas($data_insert));
        $this->siswa->setNama_ortu($data_insert[9]);
        $this->siswa->setPassword(md5('qwerty'));
        $this->em->persist($this->siswa);
        $this->em->flush();
    }
    
    private function initKelas($data_insert){
        $str_jur = ($data_insert[5] == 'X')?'':$data_insert[6].'-';
        $id = $data_insert[5]."-".$str_jur.$data_insert[7].'-'.$data_insert[8];
        $kelas = $this->em->find("KelasEntity", $id);
        if(!is_null($kelas)){
            return $kelas;
        }else{
            $kelas = new KelasEntity();
            $kelas->setKelas($data_insert[5])
                    ->setJurusan($data_insert[6])
                    ->setNo_kelas($data_insert[7])
                    ->setTahun_ajaran($data_insert[8])
                    ->generateId();
            $this->em->persist($kelas);
            return $kelas;
        }
    }


    public function dataExist($nis){
        return !is_null($this->em->find("SiswaEntity", $nis));
    }
}
