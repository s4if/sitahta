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
    
    public function getKelas($id_kelas){
        return $this->em->find('KelasEntity', $id_kelas);
    }

    public function insertData($data) {
        try {
            $id = $data['nis'] . '-' . $data['kelas'] . '-' . $data['semester'] . '-' . $data['no_uh'] . '-' . $data['tahun_ajaran'];
            if (is_null($this->em->find("NilaiHarianEntity", $id)) || $data['nilai'] < 100 || $data['nilai_remidi'] < 100) {
                $this->nilai = new NilaiHarianEntity();
                $data_ok = $this->setData($data);
                if($data_ok){
                    $this->nilai->generateId();
                    $this->em->persist($this->nilai);
                    $this->em->flush();
                    $this->nilai = null;
                }
                return $data_ok;
            } else {
                return false;
            }
        } catch (Doctrine\DBAL\DBALException $exc) {
            return false;
        }

        
    }

    public function updateData($data) {
        $id = $data['nis'] . '-' . $data['kelas'] . '-' . $data['semester'] . '-' . $data['no_uh'] . '-' . $data['tahun_ajaran'];
        if (!is_null($this->em->find("NilaiHarianEntity", $id))) {
            $this->nilai = $this->em->find("NilaiHarianEntity", $id);
            $data_ok = $this->setData($data);
            if($data_ok){
            $this->em->persist($this->nilai);
            $this->em->flush();
            $this->nilai = null;
            }
            return $data_ok;
        } else {
            return false;
        }
    }

    public function deleteData($data) {
        $id = $data['nis'] . '-' . $data['kelas'] . '-' . $data['semester'] . '-' . $data['no_uh'] . '-' . $data['tahun_ajaran'];
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
        if ((!empty($data['no_uh']))&&(!empty($data['kelas']))&&(!empty($data['semester']))&&(!empty($data['tahun_ajaran']))) {
            $meta_id = $data['kelas'].'-'.$data['semester'].'-'.$data['no_uh'].'-'.$data['tahun_ajaran'];
            $meta = $this->em->find("KurikulumEntity", $meta_id);
            if(is_null($meta)){
                return false;
            }
            $this->nilai->setMeta($meta);
        }
        if (!empty($data['nis'])) {
            $siswa = $this->em->find("SiswaEntity", $data['nis']);
            $this->nilai->setSiswa($siswa);
        }
        if (!empty($data['tanggal'])) {
            if(is_object($data['tanggal'])){
                $this->nilai->setTanggal($data['tanggal']);
            }else{
                $tgl_arr = explode('-', $data['tanggal']);
                $tgl = new DateTime();
                //sistem tanggal yang di explode : yyyy:mm:dd
                $tgl->setDate($tgl_arr[0], $tgl_arr[1], $tgl_arr[2]);
                $this->nilai->setTanggal($tgl);
            }
        }
        if (!empty($data['juz'])):$this->nilai->setJuz($data['juz']);endif;
        if (!empty($data['halaman'])):$this->nilai->setHalaman($data['halaman']);endif;
        if (!empty($data['nilai'])):$this->nilai->setNilai($data['nilai']);endif;
        if (!empty($data['nilai_remidi'])):$this->nilai->setNilai_remidi($data['nilai_remidi']);endif;
        if (!empty($data['penguji'])) {
            $penguji = $this->em->find("GuruEntity", $data['penguji']);
            $this->nilai->setPenguji($penguji);
        }
        return TRUE;
    }

    public function dataExist($no_uh, $nis, $kelas, $semester, $tahun_ajaran) {
        $id = $nis . '-' . $kelas . '-' . $semester . '-' . $no_uh . '-' . $tahun_ajaran;
        return !is_null($this->em->find("NilaiHarianEntity", $id));
    }

    public function getFilteredData($params) {
        return $this->em->getRepository('NilaiHarianEntity')->getFilteredData($params);
    }

    public function getListKelas($kelas) {
        return $this->em->getRepository('SiswaEntity')->getListKelas($kelas);
    }
    
    // Php Excel jadi array dan test NIS ada yang kosong tidak...
    public function importData($file_url){
        try {
            $objReader = new PHPExcel_Reader_Excel5();
            $objPHPExcel = $objReader->load($file_url);
            $objWorksheet = $objPHPExcel->getActiveSheet();
            $lastRow = $objWorksheet->getHighestDataRow();
            $lastCol = $objWorksheet->getHighestDataColumn();
            $data = $objWorksheet->rangeToArray('A1'.':'.$lastCol.$lastRow, null, TRUE);
//            var_dump($data);
//            exit();
            return $this->doImport($data, $lastRow);

        }  catch (PHPExcel_Exception $ex) {
            return -1;
        }
    }
    
    // Row Validation, & transaction
    private function doImport($data, $lastRow){
        $this->em->getConnection()->beginTransaction();
        $failureCount = 0;
        // $i dimulai dari index mulai masuk tabel nilai
        for ($i = 7; $i < $lastRow;$i++){
            $row_data = $data[$i];
            if($this->rowValidation($data, $row_data)){
                $this->transactionBuilder($data, $row_data);
            }  else {
                $failureCount++;
            }
        }
        $this->em->flush();
        if(($failureCount > 0)){
            $this->em->getConnection()->rollback();
        }else{
            $this->em->getConnection()->commit();
        }
        return $failureCount;
    }
    
    // validasi row
    private function rowValidation($data, $row_data){
//        $rowValid = true;
//        if(is_null($row_data[0])){
//            $rowValid = false;
//        }
////        $i = 2;
////        while ($i < count($row_data)){
////            if(is_null($data[4][$i+1])){
////                $rowValid = false;
////                break;
////            }
////            if(is_null($data[5][$i+1])){
////                $rowValid = false;
////                break;
////            }
////            $i= $i + 2;
////        }
//        return $rowValid;
        return true;
    }
    
    private function transactionBuilder($data, $row_data){
        $skipped_count = 0;
        $i = 2;
        while ($i < count($row_data)){
            if(is_null($row_data[$i]) || is_null($row_data[0]) || is_null($data[4][$i+1]) || is_null($data[5][$i+1]) || is_null($data[0][1]) || is_null($data[1][1])|| is_null($data[2][1])){
                $skipped_count++;
            } else {
                $trans_row = [];
                $trans_row ['no_uh'] = $data[4][$i+1];
                $trans_row ['kelas'] = $data[0][1];
                $trans_row ['semester'] = $data[1][1];
                $t_a = explode('/', $data[2][1]);
                $trans_row ['tahun_ajaran'] = $t_a[0];
                $trans_row ['nis'] = $row_data[0];
                $tgl_arr = explode("-", $data[5][$i+1]);
                $tgl = $tgl_arr[2].'-'.$tgl_arr[1].'-'.$tgl_arr[0];
                $trans_row ['tanggal'] = $tgl;
                $trans_row ['nilai'] = $row_data[$i];
                $trans_row ['nilai_remidi'] = $row_data[$i+1];
                $trans_row ['penguji'] = $data[3][1];
                $this->transQuery($trans_row);
            }
            $i = $i+2;
        }
        return $skipped_count;
    }

    private function transQuery($data){
        $id = $data['nis'] . '-' . $data['kelas'] . '-' . $data['semester'] . '-' . $data['no_uh'] . '-' .$data['tahun_ajaran'];
        $entity = $this->em->find("NilaiHarianEntity", $id);
        if (is_null($entity)) {
            $this->nilai = new NilaiHarianEntity();
        } else {
            $this->nilai = $entity;
        }
        $this->setData($data);
        $this->nilai->generateId();
        $this->em->persist($this->nilai);
        //$this->em->flush();
    }
    
    public function generate($data, $file_name){
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Kelas :');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', $data['kelas']);
        $objPHPExcel->getActiveSheet()->SetCellValue('A2', 'Semester :');
        $objPHPExcel->getActiveSheet()->SetCellValue('B2', $data['semester']);
        $objPHPExcel->getActiveSheet()->SetCellValue('A3', 'Tahun Ajaran :');
        $objPHPExcel->getActiveSheet()->SetCellValue('B3', $data['tahun_ajaran']);
        $objPHPExcel->getActiveSheet()->SetCellValue('A4', 'Pengampu :');
        $objPHPExcel->getActiveSheet()->SetCellValue('B4', $data['pengampu']);
        $objPHPExcel->getActiveSheet()->SetCellValue('A7', 'NIS');
        $objPHPExcel->getActiveSheet()->SetCellValue('B7', 'Nama');
        $sis_count = 8;
        $kelas = $this->getKelas($data['id_kelas']);
        $siswa_di_kelas = $kelas->getSiswa();
        foreach ($siswa_di_kelas as $siswa) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$sis_count, $siswa->getNis());
            $objPHPExcel->getActiveSheet()->SetCellValue('B'.$sis_count, $siswa->getNama());
            $sis_count++;
        }
        $kolom_uh = 2;
        $id_uh = 0;
        foreach ($data['uh'] as $uh){
            $objPHPExcel->getActiveSheet()->SetCellValue(PHPExcel_Cell::stringFromColumnIndex($kolom_uh).'5', 'UH :');
            $objPHPExcel->getActiveSheet()->SetCellValue(PHPExcel_Cell::stringFromColumnIndex($kolom_uh).'6', 'Tanggal :');
            $objPHPExcel->getActiveSheet()->SetCellValue(PHPExcel_Cell::stringFromColumnIndex($kolom_uh).'7', 'Nilai');
            $kolom_uh++;
            $objPHPExcel->getActiveSheet()->SetCellValue(PHPExcel_Cell::stringFromColumnIndex($kolom_uh).'5', $uh);
            $objPHPExcel->getActiveSheet()->SetCellValue(PHPExcel_Cell::stringFromColumnIndex($kolom_uh).'6', $data['tanggal'][$id_uh]);
            $objPHPExcel->getActiveSheet()->SetCellValue(PHPExcel_Cell::stringFromColumnIndex($kolom_uh).'7', 'Remidi');
            $kolom_uh++;
            $id_uh++;
        }
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$file_name.'.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
        $objWriter->save('php://output');
        exit;
    }
}
