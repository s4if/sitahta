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

    public function getData($where) {
        return $this->em->getRepository('NilaiHarianEntity')->getData($where);
    }

    public function getDataByNo_uh($no_uh) {
        return $this->em->getRepository('NilaiHarianEntity')->getDataByNo_uh($no_uh);
    }

    public function getDataByNis($nis) {
        return $this->em->getRepository('NilaiHarianEntity')->getDataBySiswa($nis);
    }

    public function getNilaiSiswa() {
        $data = $this->em->getRepository('NilaiHarianEntity')->getNilaiSaatIni();
        $data_arr = array();
        foreach ($data as $row) {
                $data_arr[$row->getSiswa()->getNis()][$row->getNo_uh()] = $row;
        }
        return $data_arr;
    }

    public function getDataByKelas($kelas) {
        return $this->em->getRepository('NilaiHarianEntity')->getDataByKelas($kelas);
    }

    public function insertData($data) {
        $id = $data['nis'] . '-' . $data['kelas'] . '-' . $data['semester'] . '-' . $data['no_uh'];
        if (is_null($this->em->find("NilaiHarianEntity", $id))) {
            $this->nilai = new NilaiHarianEntity();
//            try{
            $this->setData($data);
            $this->nilai->generateId();
            $this->em->persist($this->nilai);
            $this->em->flush();
            $this->nilai = null;
//            } catch (Doctrine\DBAL\Exception\UniqueConstraintViolationException $ex) {
            //                return false;
            //            }
            return true;
        } else {
            return false;
        }
    }

    public function updateData($data) {
        $id = $data['nis'] . '-' . $data['kelas'] . '-' . $data['semester'] . '-' . $data['no_uh'];
        if (!is_null($this->em->find("NilaiHarianEntity", $id))) {
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
        } else {
            return false;
        }
    }

    public function deleteData($data) {
        $id = $data['nis'] . '-' . $data['kelas'] . '-' . $data['semester'] . '-' . $data['no_uh'];
        $entity = $this->em->find("NilaiHarianEntity", $id);
        if (!is_null($entity)) {
            $this->em->remove($entity);
            $this->em->flush();
            $this->nilai = null;
            return true;
        } else {
            return false;
        }
    }

    //jika ada error yang berkaitan dengan set data, lihat urutan pemberian data pada fungsi
    public function setData($data) {
        if (!empty($data['no_uh'])):$this->nilai->setNo_uh($data['no_uh']);endif;
        if (!empty($data['kelas'])):$this->nilai->setKelas($data['kelas']);endif;
        if (!empty($data['semester'])):$this->nilai->setSemester($data['semester']);endif;
        if (!empty($data['nis'])) {
            $siswa = $this->em->find("SiswaEntity", $data['nis']);
            $this->nilai->setSiswa($siswa);
        }
        if (!empty($data['tanggal'])) {
            $tgl_arr = explode('-', $data['tanggal']);
            $tgl = new DateTime();
            //sistem tanggal yang di explode : yyyy:mm:dd
            $tgl->setDate($tgl_arr[0], $tgl_arr[1], $tgl_arr[2]);
            $this->nilai->setTanggal($tgl);
        }
        if (!empty($data['juz'])):$this->nilai->setJuz($data['juz']);endif;
        if (!empty($data['halaman'])):$this->nilai->setHalaman($data['halaman']);endif;
        if (!empty($data['nilai'])):$this->nilai->setNilai($data['nilai']);endif;
        if (!empty($data['nilai_remidi'])):$this->nilai->setNilai_remidi($data['nilai_remidi']);endif;
        if (!empty($data['penguji'])) {
            $penguji = $this->em->find("GuruEntity", $data['penguji']);
            $this->nilai->setPenguji($penguji);
        }
    }

    public function dataExist($no_uh, $nis, $kelas, $semester) {
        $id = $nis . '-' . $kelas . '-' . $semester . '-' . $no_uh;
        return !is_null($this->em->find("NilaiHarianEntity", $id));
    }

    public function getFilteredData($params) {
        return $this->em->getRepository('NilaiHarianEntity')->getFilteredData($params);
    }

    public function getListKelas($kelas) {
        return $this->em->getRepository('SiswaEntity')->getListKelas($kelas);
    }
    
    // NOT YET EDITED!!!! //
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
            $lastCol = $objWorksheet->getHighestDataColumn();
            $data = $objWorksheet->rangeToArray('A1'.':'.$lastCol.$lastRow, null, TRUE);
            for($i = 0; $i <= 5; $i++){
                if(is_null($data[$i][1])){
                    $failureCount++;
                }
            }
            if($failureCount > 0){
                return $failureCount;
            }else{
                return $this->doImport($data, $lastRow);
            }
        }  catch (PHPExcel_Exception $ex) {
            return -1;
        }
    }
    
    private function doImport($data, $lastRow){
        $this->em->getConnection()->beginTransaction();
        $failureCount = 0;
        // $i dimulai dari index mulai masuk tabel nilai
        for ($i = 9; $i < $lastRow;$i++){
            $row_data = $data[$i];
            if($this->rowValidation($data, $row_data)){
                $this->transQuery($this->dataTranslator($data, $row_data));
            }  else {
                $failureCount++;
            }
        }
        if(($failureCount > 0)){
            $this->em->getConnection()->rollback();
        }else{
            $this->em->getConnection()->commit();
        }
        return $failureCount;
    }
    
    private function rowValidation($data, $row_data){
        $rowValid = true;
        if(is_null($row_data[0])){
            $rowValid = false;
        }
        $i = 2;
        while ($i < count($row_data)){
            if(is_null($row_data[$i])){
                $rowValid = false;
                break;
            }
            if(is_null($data[6][$i+1])){
                $rowValid = false;
                break;
            }
            if(is_null($data[7][$i+1])){
                $rowValid = false;
                break;
            }
            $i= $i + 2;
        }
        return $rowValid;
    }

    private function dataTranslator($data, $row_data){
        //trans_row adalah row data yang sudah diubah, sedangkan trans_data adalah kumpulan dari trans_row
        $trans_data = [];
        $i = 2;
        while ($i < count($row_data)){
            $trans_row = [];
            $trans_row ['no_uh'] = $data[6][$i+1];
            $trans_row ['kelas'] = $data[0][1];
            $trans_row ['semester'] = $data[1][1];
            $t_a = explode('/', $data[2][1]);
            $trans_row ['tahun_ajaran'] = $t_a[0];
            $trans_row ['nis'] = $row_data[0];
            $tgl_arr = explode("-", $data[4][1]);
            $tgl = $tgl_arr[2].'-'.$tgl_arr[1].'-'.$tgl_arr[0];
            $trans_row ['tanggal'] = $tgl;
            $trans_row ['juz'] = $data[3][1];
            $trans_row ['halaman'] = (is_null($data[7][$i+1]))?$data[6][$i+1]:$data[7][$i+1];
            $trans_row ['nilai'] = $row_data[$i];
            $trans_row ['nilai_remidi'] = $row_data[$i+1];
            $trans_row ['penguji'] = $data[5][1];
            $trans_data[] = $trans_row;
            $i = $i+2;
        }
        return $trans_data;
    }
    
    private function transQuery($arr_data){
        foreach ($arr_data as $data){
            $id = $data['nis'] . '-' . $data['kelas'] . '-' . $data['semester'] . '-' . $data['no_uh'];
            $entity = $this->em->find("NilaiHarianEntity", $id);
            if (is_null($entity)) {
                $this->nilai = new NilaiHarianEntity();
            } else {
                $this->nilai = $entity;
            }
            $this->setData($data);
            $this->nilai->generateId();
            $this->em->persist($this->nilai);
            $this->em->flush();
        }
    }

}
