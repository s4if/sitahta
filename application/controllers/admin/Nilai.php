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
    
    public function lihat($kelas = 'X', $in_semester = 9) {
        $this->blockUnloggedOne();
        $data_kelas = $this->siswa->getKelas($kelas, $this->session->tahun_ajaran);
        $semester = ($in_semester == 1 || $in_semester == 2)? $in_semester : $this->session->semester;
        $kelas_2 = array();
        if($kelas == 'X' || $kelas == 'XI' || $kelas == 'XII'){
            $kelas_2 = [0 => $kelas, 1 => $this->session->tahun_ajaran];
        }  else {
            $kelas_2 = explode('-', $kelas);
        }
        $list_kelas = $this->siswa->getKelas($kelas_2[0], $this->session->tahun_ajaran);
        $data = [
            'title' => 'Lihat Nilai',
            'user' => ucwords($this->session->login_data->getNama()),
            'position' => $this->session->position,
            'nama' => $this->session->login_data->getNama(),
            'nav_pos' => "nilai".$kelas_2[0],
            'judul_kelas' => $kelas_2,
            'tahun_ajaran' => $this->session->tahun_ajaran,
            'edit' => $this->load->view("admin/nilai/edit_1", [], TRUE),
            'semester' => $semester,
            'list_kelas' => $list_kelas,
            'data_kelas' => $data_kelas
        ];
        $this->loadView('admin/nilai/lihat_1', $data);
    }
    
    public function tambah_nilai($kelas, $nis) {
        $this->blockUnloggedOne();
        $data_insert = $this->input->post(null, true);
        $data_insert['nis'] = $nis;
        $data_insert['tanggal'] = $data_insert['tahun'] . "-" . $data_insert['bulan'] . "-" . $data_insert['tanggal'];
        $data_insert['penguji'] = $this->session->login_data->getNip();
        $res = $this->nilai->insertData($data_insert, TRUE);
        if ($res >= 1) {
            $this->session->set_flashdata("notices", [0 => "Tambah Data Berhasil!"]);
            redirect('nilai/' . $kelas .'/'. $data_insert['semester']);
        } else {
            $this->session->set_flashdata("errors", [0 => "Tambah Data Gagal!"]);
            redirect('nilai/' . $kelas .'/'.$data_insert['semester']);
        }
    }

    public function edit_nilai($kelas, $nis) {
        $this->blockUnloggedOne();
        $data_insert = $this->input->post(null, true);
        $data_insert['nis'] = $nis;
        $data_insert['tanggal'] = $data_insert['tahun'] . "-" . $data_insert['bulan'] . "-" . $data_insert['tanggal'];
        $data_insert['penguji'] = $this->session->login_data->getNip();
        $res = $this->nilai->updateData($data_insert);
        if ($res >= 1) {
            $this->session->set_flashdata("notices", [0 => "Edit Data Berhasil!"]);
            redirect('nilai/' . $kelas);
        } else {
            $this->session->set_flashdata("errors", [0 => "Edit Data Gagal!"]);
            redirect('nilai/' . $kelas);
        }
    }

    public function hapus_nilai($nis, $kelas, $semester, $no_uh) {
        $this->blockUnloggedOne();
        if ($this->nilai->deleteData(['nis' => $nis, 'no_uh' => $no_uh, 'kelas' => $kelas, 'semester' => $semester])) {
            $this->session->set_flashdata("notices", [0 => "Data telah berhasil dihapus"]);
            redirect('nilai/' . $kelas . '/' .$semester, 'refresh');
        } else {
            $this->session->set_flashdata("errors", [0 => "Maaf, data tidak berhasil dihapus"]);
            redirect('nilai/' . $kelas . '/' .$semester, 'refresh');
        }
    }
}