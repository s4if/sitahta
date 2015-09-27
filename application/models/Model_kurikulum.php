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
    
    public function getData($id = -1){
        return $this->em->getRepository('KurikulumEntity')->getData($id);
    }
    
    public function insertData($data){
        $id = $data['kelas'].'-'.$data['semester'].'-'.$data['no_uh'];
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
        $id = $data['kelas'].'-'.$data['semester'].'-'.$data['no_uh'];
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
        if (!empty($data['juz'])) : $this->kurikulum->setJuz($data['juz']); endif;
        if (!empty($data['surat_awal'])) : $this->kurikulum->setSurat_awal($data['surat_awal']); endif;
        if (!empty($data['ayat_awal'])) : $this->kurikulum->setAyat_awal($data['ayat_awal']); endif;
        if (!empty($data['surat_akhir'])) : $this->kurikulum->setSurat_akhir($data['surat_akhir']); endif;
        if (!empty($data['ayat_akhir'])) : $this->kurikulum->setAyat_akhir($data['ayat_akhir']); endif;
    }
}
