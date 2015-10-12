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
    
    protected $sertifikasi;
    protected $peserta;
    
    public function __construct() {
        parent::__construct();
    }
    
    public function getData($id = -1){
        return $this->em->getRepository('SertifikasiEntity')->getData($id);
    }
    //belum ada
    public function insertData($data){
//        try {
            $this->sertifikasi = new SertifikasiEntity();
            $this->setData($data);
            $this->em->persist($this->sertifikasi);
            $this->em->flush();
            return true;
//        } catch (Exception $e){
//            return false;
//        }
    }
    
    public function updateData($data){
        try {
            $this->sertifikasi = $this->em->find("SertifikasiEntity", $data['id']);
            if(!is_null($this->sertifikasi)){
                $this->setData($data);
                $this->em->persist($this->sertifikasi);
                $this->em->flush();
                    return true;
            }else{
                return false;
            }
        } catch (Exception $ex) {
            $ex->getMessage();
            return false;
        }
        
    }
    
    public function deleteData($where){
        $entity = $this->em->find("SertifikasiEntity", $where['id']);
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
        if (!empty($data['id'])) : $this->sertifikasi->setId($data['id']); endif;
        if (!empty($data['nama'])) : $this->sertifikasi->setNama($data['nama']); endif;
        if (!empty($data['kota'])) : $this->sertifikasi->setKota($data['kota']); endif;
        if (!empty($data['tempat'])) : $this->sertifikasi->setTempat($data['tempat']); endif;
        if (!empty($data['tahun_ajaran'])) : $this->sertifikasi->setTahun_ajaran($data['tahun_ajaran']); endif;
        if (!empty($data['kkm'])) : $this->sertifikasi->setKkm($data['kkm']); endif;
        if (!empty($data['tanggal'])){
            $tgl_arr = explode('-', $data['tanggal']);
            $tgl = new DateTime();
            $tgl->setDate($tgl_arr[0], $tgl_arr[1], $tgl_arr[2]);
            $this->sertifikasi->setTanggal($tgl); 
        }
    }
    
    public function getPeserta($id_sertifikasi, $id = -1){
        $sertifikasi = $this->getData($id_sertifikasi);
        return $sertifikasi->getPeserta($id);
    }
    
    public function addPeserta($data){
//        try {
            $this->peserta = new PesertaEntity();
            $this->setDataPeserta($data);
            $this->em->persist($this->peserta);
            $this->em->flush();
            return true;
//        } catch (Exception $e){
//            return false;
//        }
    }
    
    public function removePeserta($where){
        $entity = $this->em->find("PesertaEntity", $where['id']);
        if(!is_null($entity)){
             $this->em->remove($entity);
             $this->em->flush();
             return true;
        }  else {
            return false;
        }
    }
    
    public function updatePeserta($data){
        $this->peserta = $this->em->find("PesertaEntity", $data['id']);
        if(!is_null($this->peserta)){
            $this->setDataPeserta($data);
            $this->em->persist($this->peserta);
            $this->em->flush();
                return true;
        }else{
            return false;
        }
    }
    
    public function setDataPeserta($data){
        if (!empty($data['id'])) : $this->peserta->setId($data['id']); endif;
        if (!empty($data['juz'])) : $this->peserta->setJuz($data['juz']); endif;
        if (!empty($data['nilai'])) : $this->peserta->setNilai($data['nilai']); endif;
        if (!empty($data['nis'])) {
            $siswa = $this->em->find("SiswaEntity", $data['nis']);
            $this->peserta->setSiswa($siswa);
        }
        if (!empty($data['sertifikasi'])) {
            $sertifikasi = $this->em->find("SertifikasiEntity", $data['sertifikasi']);
            $this->peserta->setSertifikasi($sertifikasi);
        }
    }
}
