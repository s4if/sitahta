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
 * Description of Kurikulum
 *
 * @author s4if
 */
class Kurikulum extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('model_kurikulum','kurikulum',TRUE);
    }
    
    public function index(){
        if (is_cli())
        {
            echo 'This Is For Avoiding Load Session in CLI. ';
            return;
        }  else {
            $this->lihat();
        }
    }
    
    public function lihat($kelas ='X', $semester = 1){
        $this->blockUnloggedOne();
        $tahun = $this->session->tahun_ajaran;
        $data_kurikulum = $this->dataTrans($kelas, $tahun, $semester);
        $data = [
            'title' => 'Lihat Kurikulum',
            'user' => ucwords($this->session->login_data->getNama()),
            'position' => $this->session->position,
            'nama' => $this->session->login_data->getNama(),
            'nav_pos' => 'kurikulum',
            'kelas' => $kelas,
            'semester' => $semester,
            'edit' => $this->load->view("admin/kurikulum/edit",[
                'data_kurikulum' => $data_kurikulum,
                'list_surat_awal' => $this->load->view("admin/kurikulum/surat",['pos' => 'awal'],TRUE),
                'list_surat_akhir' => $this->load->view("admin/kurikulum/surat",['pos' => 'akhir'],TRUE)
                    ],TRUE),
            'data_kurikulum' => $data_kurikulum
        ];
        $this->loadView('admin/kurikulum/lihat', $data);
    }
    
    private function dataTrans($kelas, $tahun, $semester){
        $arr_data = [];
        $count = ($kelas == 'X')? 20 : 15;
        for($i = 1; $i <= $count; $i++){
            $data = $this->kurikulum->getDataByParams($kelas, $tahun, $i, $semester);
            
            if(!isset($data[0])){
                $kur = new KurikulumEntity();
                $kur->setKelas($kelas);
                $kur->setTahun($tahun);
                $kur->setNo_uh($i);
                $kur->setSemester($semester);
                $arr_data[$i] = $kur;
            } else {
                $arr_data[$i] = $data[0];
            }
        }
        $uts = $this->kurikulum->getDataByParams($kelas, $tahun, 'UTS', $semester);
        $uas = $this->kurikulum->getDataByParams($kelas, $tahun, 'UAS', $semester);
        $arr_data['UTS'] = (isset($uts[0]))?$uts[0]:NULL;
        $arr_data['UAS'] = (isset($uas[0]))?$uas[0]:NULL;
//        foreach ($arr_data as $data){
//            if(is_null($data)){
//                $this->generateKurikulum($tahun);
//                $arr_data = $this->dataTrans($kelas, $tahun, $semester);
//                break;
//            }
//        }
        return $arr_data;
    }
    
    public function generateKurikulum($tahun = 2015, $kelas_x = 20, $kelas_xi = 10, $kelas_xii = 10){
        $this->kurikulum->reset($tahun, $kelas_x, $kelas_xi, $kelas_xii);
    }

    public function tambah(){
        $this->blockUnloggedOne();
        $data_insert = $this->input->post(null, true);
        print_r($data_insert);
        if($this->kurikulum->dataExist($this->input->post('no_uh', true))){
            $this->session->set_flashdata("errors",[0 => "Maaf, NIP yang dimasukkan sudah terpakai!"]);
            redirect('admin/kurikulum');
        }else{
            $res = $this->kurikulum->insertData($data_insert, 'kurikulum');
            if($res >= 1){
                $this->session->set_flashdata("notices",[0 => "Tambah Data Berhasil!"]);
                redirect('admin/kurikulum');
            } else {
                $this->session->set_flashdata("errors",[0 => "Tambah Data Gagal!"]);
                redirect('admin/kurikulum');
            }
        }
    }
    
    public function edit($kelas, $semester, $no_uh, $tahun){
        $this->blockUnloggedOne();
        $data_insert = $this->input->post(null, true);
        $data_insert['kelas'] = $kelas;
        $data_insert['semester'] = $semester;
        $data_insert['no_uh'] = $no_uh;
        $data_insert['tahun_ajaran'] = $tahun;
        $res = $this->kurikulum->updateData($data_insert, 'kurikulum');
        if($res >= 1){
            $this->session->set_flashdata("notices",[0 => "Edit Data Berhasil!"]);
            redirect('kurikulum/'.$kelas.'/'.$semester);
        } else {
            $this->session->set_flashdata("errors",[0 => "Edit Data Gagal!"]);
            redirect('kurikulum/'.$kelas.'/'.$semester);
        }
    }
    
    public function reset($kelas, $semester, $no_uh, $tahun){
        $this->blockUnloggedOne();
        $data_insert['kelas'] = $kelas;
        $data_insert['semester'] = $semester;
        $data_insert['no_uh'] = $no_uh;
        $data_insert['tahun_ajaran'] = $tahun;
        $res = $this->kurikulum->resetData($data_insert, 'kurikulum');
        if($res >= 1){
            $this->session->set_flashdata("notices",[0 => "Edit Data Berhasil!"]);
            redirect('kurikulum/'.$kelas.'/'.$semester);
        } else {
            $this->session->set_flashdata("errors",[0 => "Edit Data Gagal!"]);
            redirect('kurikulum/'.$kelas.'/'.$semester);
        }
    }
    
    public function hapus($id){
        $this->blockUnloggedOne();
        if($this->kurikulum->deleteData(['id' => $id])){
            $this->session->set_flashdata("notices",[0 => "Data telah berhasil dihapus"]);
            redirect('kurikulum/lihat', 'refresh');
        }  else {
            $this->session->set_flashdata("errors",[0 => "Maaf, Kurikulum dengan id = ".$id." tidak ditemukan"]);
            redirect('kurikulum/lihat', 'refresh');
        }
    }
    
    public function import(){
        $this->blockUnloggedOne();
        $fileUrl = $_FILES['file']["tmp_name"];
        $res = $this->kurikulum->importData($fileUrl);
        if($res == 0){
            $this->session->set_flashdata("notices",[0 => "Import Data Berhasil!"]);
            redirect('kurikulum');
        } elseif($res > 0) {
            $this->session->set_flashdata("errors",[0 => "Import Data Gagal!,<br> cek kembali isi dokumen yang akan diimport!"]);
            redirect('kurikulum');
        }  else {
            $this->session->set_flashdata("errors",[0 => "Import Data Gagal!,<br> File yang dimasukkan bukan file excel!"]);
            redirect('kurikulum');
        }
    }

}
