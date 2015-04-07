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
 * Description of Nilai
 *
 * @author s4if
 */
class Nilai extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('model_siswa','siswa',TRUE);
        $this->load->model('model_nilai','nilai',TRUE);
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
    
    public function lihat(){
        $this->blockUnloggedOne();
//        $siswa = $this->siswa->getData(1021);
//        $nilai_coll = $siswa->getNilai();
//        $nilai = $nilai_coll->get(0);
//        var_dump($nilai);
        $data_siswa_10 = $this->siswa->getFilteredData(['kelas' => 'X'], true);
        $data_siswa_11 = $this->siswa->getFilteredData(['kelas' => 'XI'], true);
        $data_siswa_12 = $this->siswa->getFilteredData(['kelas' => 'XII'], true);
        $data_siswa_all =  new Doctrine\Common\Collections\ArrayCollection(
                array_merge($data_siswa_10, 
                        array_merge($data_siswa_11, $data_siswa_12)
                        ));
        $data = [
            'title' => 'Nilai',
            'user' => ucwords($this->session->login_data->getNama()),
            'position' => $this->session->position,
            'nama' => $this->session->login_data->getNama(),
            'data_siswa_10' => $data_siswa_10,
            'data_siswa_11' => $data_siswa_11,
            'data_siswa_12' => $data_siswa_12,
            'edit' => $this->load->view('admin/nilai/edit',['data_siswa' => $data_siswa_all], true)
        ];
        $this->loadView('admin/nilai/lihat', $data, FALSE);
    }
    
    public function tambah_nilai($nis, $no_uh, $kelas){
        $this->blockUnloggedOne();
        $data_insert = $this->input->post(null, true);
        $data_insert['nis'] = $nis;
        $data_insert['no_uh'] = $no_uh;
        $data_insert['kelas'] = $kelas;
        $data_insert['tanggal'] = $data_insert['tahun']."-".$data_insert['bulan']."-".$data_insert['tanggal'];
        $data_insert['penguji'] = $this->session->login_data->nip;
        $res = $this->nilai->insertData($data_insert, TRUE);
        if($res >= 1){
            $this->session->set_flashdata("notices",[0 => "Tambah Data Berhasil!"]);
            redirect('nilai');
        } else {
            $this->session->set_flashdata("errors",[0 => "Tambah Data Gagal!"]);
            redirect('nilai');
        }
    }
    
    public function edit_nilai($nis, $no_uh, $kelas){
        $this->blockUnloggedOne();
        $data_insert = $this->input->post(null, true);
        $data_insert['nis'] = $nis;
        $data_insert['no_uh'] = $no_uh;
        $data_insert['kelas'] = $kelas;
        $data_insert['tanggal'] = $data_insert['tahun']."-".$data_insert['bulan']."-".$data_insert['tanggal'];
        $data_insert['penguji'] = $this->session->login_data->nip;
        $res = $this->nilai->updateData($data_insert);
        if($res >= 1){
            $this->session->set_flashdata("notices",[0 => "Edit Data Berhasil!"]);
            redirect('nilai');
        } else {
            $this->session->set_flashdata("errors",[0 => "Edit Data Gagal!"]);
            redirect('nilai');
        }
    }
    
    public function hapus_nilai($nis, $kelas, $no_uh){
        $this->blockUnloggedOne();
        if($this->nilai->deleteData(['nis' => $nis, 'no_uh' => $no_uh, 'kelas' => $kelas])){
            $this->session->set_flashdata("notices",[0 => "Data telah berhasil dihapus"]);
            redirect('nilai');
        }  else {
            $this->session->set_flashdata("errors",[0 => "Maaf, data tidak berhasil dihapus"]);
            redirect('nilai');
        }
    }
    
}
