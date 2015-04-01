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
 * Description of Model_guru
 *
 * @author s4if
 */
class Model_guru extends MY_Model{
    
    protected $guru;
    
    public function __construct() {
        parent::__construct();
    }
    
    public function getData($nip = -1){
        return $this->em->getRepository('Guru')->getData($nip);
    }
    
    public function insertData($data){
        if(is_null($this->em->find("Guru", $data['nip']))){
            $this->guru = new Guru();
            $this->setData($data);
            $this->em->persist($this->guru);
            $this->em->flush();
            return true;
        }  else{
            return false;
        }
    }
    
    public function updateData($data){
        $this->guru = $this->em->find("Guru", $data['nip']);
        if(!is_null($this->guru)){
            $this->setData($data);
            $this->em->persist($this->guru);
            $this->em->flush();
            return true;
        }else{
            return false;
        }
    }
    
    public function deleteData($where){
        $entity = $this->em->find("Guru", $where['nip']);
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
        if (!empty($data['nip'])) : $this->guru->setNip($data['nip']); endif;
        if (!empty($data['nama'])) : $this->guru->setNama($data['nama']); endif;
        if (!empty($data['jenis_kelamin'])) : $this->guru->setJenis_kelamin($data['jenis_kelamin']); endif;
        if (!empty($data['alamat'])) : $this->guru->setAlamat($data['alamat']); endif;
        if (!empty($data['email'])) : $this->guru->setEmail($data['email']); endif;
        if (!empty($data['no_telp'])) : $this->guru->setNo_telp($data['no_telp']); endif;
        if (!empty($data['password'])) : $this->guru->setPassword($data['password']); endif;
        if (!empty($data['kewenangan'])) : $this->guru->setKewenangan($data['kewenangan']); endif;
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
//            $this->db->trans_begin();
            $this->em->getConnection()->beginTransaction();
            $data = $objWorksheet->rangeToArray('A1'.':F'.$lastRow, null, TRUE);
            for ($i = 1; $i < $lastRow;$i++){
                $row_data = $data[$i];
                if($this->cellValidation($row_data)){
                    $this->transQuery($row_data);
                }  else {
                    $failureCount++;
                }
            }
            if(($failureCount > 0)){
//                $this->db->trans_rollback();
                $this->em->getConnection()->rollback();
            }else{
//                $this->db->trans_commit();
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
    
    private function transQuery($row_data){
        $this->guru = (is_null($this->em->find("Guru", $row_data[0])))? new Guru(): $this->em->find("Guru", $row_data[0]); 
        $this->guru->setNip($row_data[0]); 
        $this->guru->setNama($row_data[1]);
        $this->guru->setJenis_kelamin($row_data[2]); 
        $this->guru->setAlamat($row_data[3]); 
        $this->guru->setEmail($row_data[4]); 
        $this->guru->setNo_telp($row_data[5]); 
        $this->guru->setPassword(md5("qwerty")); 
        $this->guru->setKewenangan("guru");
        $this->em->persist($this->guru);
        $this->em->flush();
    }
}
