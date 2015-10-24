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
 * Description of Siswa
 *
 * @author s4if
 */
class Siswa extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('model_siswa', 'siswa', TRUE);
        $this->load->model('model_nilai', 'nilai', TRUE);
        $this->load->model('model_sertifikat', 'sertifikat', TRUE);
    }

    public function index() {
        if (is_cli()) {
            echo 'This Is For Avoiding Load Session in CLI. ';
            return;
        } else {
            $this->lihat();
        }
    }

    public function lihat($kelas = 'X') {
        $this->blockUnloggedOne();
        $data_kelas = $this->siswa->getKelas($kelas, $this->session->tahun_ajaran);
        $kelas_2 = array();
        if($kelas == 'X' || $kelas == 'XI' || $kelas == 'XII'){
            $kelas_2 = [0 => $kelas, 1 => $this->session->tahun_ajaran];
        }  else {
            $kelas_2 = explode('-', $kelas);
        }
        $list_kelas = $this->siswa->getKelas($kelas_2[0], $this->session->tahun_ajaran);
        $data = [
            'title' => 'Lihat Siswa',
            'user' => ucwords($this->session->login_data->getNama()),
            'position' => $this->session->position,
            'nama' => $this->session->login_data->getNama(),
            'nav_pos' => "siswa".$kelas_2[0],
            'judul_kelas' => $kelas_2,
            'tahun_ajaran' => $this->session->tahun_ajaran,
            'semester' => $this->session->semester,
            'tambah' => $this->load->view("admin/siswa/tambah", [], TRUE),
            'edit' => $this->load->view("admin/siswa/edit", [], TRUE),
            'list_kelas' => $list_kelas,
            'data_kelas' => $data_kelas
        ];
        $this->loadView('admin/siswa/lihat', $data);
    }

    public function tambah() {
        $this->blockUnloggedOne();
        $data_insert = $this->input->post(null, true);
        //$data_insert['tgl_lahir'] = $data_insert['tahun'] . "-" . $data_insert['bulan'] . "-" . $data_insert['tanggal'];
        $tgl_arr = explode('-', $data_insert['tgl']);
        $data_insert['tgl_lahir'] = $tgl_arr[2].'-'.$tgl_arr[1].'-'.$tgl_arr[0];
        $data_insert['password'] = password_hash($data_insert['tgl_lahir'], PASSWORD_BCRYPT);
        if ($this->siswa->dataExist($this->input->post('nis', true))) {
            $this->session->set_flashdata("errors", [0 => "Maaf, NIS yang dimasukkan sudah terpakai!"]);
            redirect('admin/siswa');
        } else {
                $res = $this->siswa->insertData($data_insert);
            if ($res >= 1) {
                $this->session->set_flashdata("notices", [0 => "Tambah Data Berhasil!"]);
                redirect('siswa');
            } else {
                $this->session->set_flashdata("errors", [0 => "Tambah Data Gagal!"]);
                redirect('siswa');
            }
        }
    }

    public function edit($nis) {
        $this->blockUnloggedOne();
        $data_insert = $this->input->post(null, true);
        $data_insert['nis'] = $nis;
        //$data_insert['tgl_lahir'] = $data_insert['tahun'] . "-" . $data_insert['bulan'] . "-" . $data_insert['tanggal'];
        $tgl_arr = explode('-', $data_insert['tgl']);
        $data_insert['tgl_lahir'] = $tgl_arr[2].'-'.$tgl_arr[1].'-'.$tgl_arr[0];
        $res = $this->siswa->updateData($data_insert);
        if ($res >= 1) {
            $this->session->set_flashdata("notices", [0 => "Edit Data Berhasil!"]);
            redirect('siswa');
        } else {
            $this->session->set_flashdata("errors", [0 => "Edit Data Gagal!"]);
            redirect('siswa');
        }
    }
    
    public function edit_kelas($nis) {
        $this->blockUnloggedOne();
        $data_insert = $this->input->post(null, true);
        $res = $this->real_edit_kelas($nis, $data_insert);
        if ($res >= 0) {
            $this->session->set_flashdata("notices", [0 => "Edit Kelas Berhasil!"]);
            redirect('siswa/'.$nis);
        } else {
            $this->session->set_flashdata("errors", [0 => "Edit Kelas Gagal!"]);
            redirect('siswa/'.$nis);
        }
    }
    
    public function hapus_kelas($nis, $kelas, $jurusan, $no_kelas, $tahun_ajaran){
        $this->blockUnloggedOne();
        $where = [
            'nis' => $nis,
            'kelas' => $kelas,
            'jurusan' => $jurusan,
            'no_kelas' => $no_kelas,
            'tahun_ajaran' => $tahun_ajaran
        ];
        $res = $this->siswa->deleteKelas($where);
        if ($res) {
            $this->session->set_flashdata("notices", [0 => "Hapus Kelas Berhasil!"]);
            redirect('siswa/'.$nis);
        } else {
            $this->session->set_flashdata("errors", [0 => "Hapus Kelas Gagal!"]);
            redirect('siswa/'.$nis);
        }
    }
    
    public function real_edit_kelas($nis, $data_insert){
        $failure_count = 0;
        $dmp = [];
        foreach ($data_insert['tahun'] as $tahun){
            $insert['nis'] = $nis;
            $insert['kelas'] = $data_insert['kelas_'.$tahun];
            $insert['jurusan'] = $data_insert['jurusan_'.$tahun];
            $insert['no_kelas'] = $data_insert['no_kelas_'.$tahun];
            $insert['tahun_ajaran'] = $tahun;
            $res = $this->siswa->updateData($insert);
            if(!$res){$failure_count++;}
        }
        return $failure_count;
    }

    public function hapus($nis) {
        $this->blockUnloggedOne();
        if ($this->siswa->deleteData(['nis' => $nis])) {
            $this->session->set_flashdata("notices", [0 => "Data telah berhasil dihapus"]);
            redirect('siswa', 'refresh');
        } else {
            $this->session->set_flashdata("errors", [0 => "Maaf, Siswa dengan nis = " . $nis . " tidak ditemukan"]);
            redirect('siswa', 'refresh');
        }
    }

    public function profil($nis) {
        $this->blockUnloggedOne();
        $siswa = $this->siswa->getData($nis);
        $data_sertifikat = $siswa->getSertifikat();
        $data = [
            'title' => 'Profil Siswa',
            'user' => ucwords($this->session->login_data->getNama()),
            'position' => $this->session->position,
            'nama' => $this->session->login_data->getNama(),
            'siswa' => $siswa,
            'data_sertifikat' => $data_sertifikat,
            'nav_pos' => "siswa".$nis,
            'foto_profil' => $this->getImgLink($nis),
            'tambah_sertifikat' => $this->load->view("admin/siswa/tambah_sertifikat", ['kelas' => $siswa->getKelas(), 'nis' => $siswa->getNis()], TRUE),
            'edit_sertifikat' => $this->load->view("admin/siswa/edit_sertifikat", ['data_sertifikat' => $data_sertifikat], TRUE),
        ];
        $this->loadView('admin/siswa/profil', $data);
    }
    
    private function getImgLink($nis){
        $this->load->helper('file');
        $img_link = base_url().'admin/siswa/getFoto/';
        $file = read_file('./data/foto/'.$nis.'.png');
        $datetime = new DateTime('now');
        if($file == false){
            $img_link = $img_link.'default/'.hash('md2', $datetime->format('Y-m-d H:i:s'));
        }  else {
            $img_link = $img_link.$nis.'/'.hash('md2', $datetime->format('Y-m-d H:i:s'));
        }
        return $img_link;
    }
    
    public function getFoto($nis, $hash){
        $this->blockUnloggedOne(true, TRUE);
        $imagine = new Imagine\Gd\Imagine();
        $image = $imagine->open('./data/foto/'.$nis.'.png');
        $image->show('png');
    }

    public function tambah_nilai($nis) {
        $this->blockUnloggedOne();
        $data_insert = $this->input->post(null, true);
        $data_insert['nis'] = $nis;
        $tgl_arr = explode('-', $data_insert['tgl']);
        $data_insert['tanggal'] = $tgl_arr[2].'-'.$tgl_arr[1].'-'.$tgl_arr[0];
        $data_insert['penguji'] = $this->session->login_data->getNip();
        $res = $this->nilai->insertData($data_insert, TRUE);
        if ($res >= 1) {
            $this->session->set_flashdata("notices", [0 => "Tambah Data Berhasil!"]);
            redirect('siswa/' . $nis);
        } else {
            $this->session->set_flashdata("errors", [0 => "Tambah Data Gagal!"]);
            redirect('siswa/' . $nis);
        }
    }

    public function edit_nilai($nis) {
        $this->blockUnloggedOne();
        $data_insert = $this->input->post(null, true);
        $data_insert['nis'] = $nis;
        $tgl_arr = explode('-', $data_insert['tgl']);
        $data_insert['tanggal'] = $tgl_arr[2].'-'.$tgl_arr[1].'-'.$tgl_arr[0];
        $data_insert['penguji'] = $this->session->login_data->getNip();
        $res = $this->nilai->updateData($data_insert);
        if ($res >= 1) {
            $this->session->set_flashdata("notices", [0 => "Edit Data Berhasil!"]);
            redirect('siswa/' . $nis);
        } else {
            $this->session->set_flashdata("errors", [0 => "Edit Data Gagal!"]);
            redirect('siswa/' . $nis);
        }
    }

    public function hapus_nilai($nis, $kelas, $semester, $no_uh) {
        $this->blockUnloggedOne();
        if ($this->nilai->deleteData(['nis' => $nis, 'no_uh' => $no_uh, 'kelas' => $kelas, 'semester' => $semester])) {
            $this->session->set_flashdata("notices", [0 => "Data telah berhasil dihapus"]);
            redirect('siswa/' . $nis, 'refresh');
        } else {
            $this->session->set_flashdata("errors", [0 => "Maaf, data tidak berhasil dihapus"]);
            redirect('siswa/' . $nis, 'refresh');
        }
    }

    public function tambah_sertifikat($nis) {
        $this->blockUnloggedOne();
        $data_insert = $this->input->post(null, true);
        $data_insert['nis'] = $nis;
        $tgl_arr = explode('-', $data_insert['tgl']);
        $data_insert['tgl_ujian'] = $tgl_arr[2].'-'.$tgl_arr[1].'-'.$tgl_arr[0];
        $res = $this->sertifikat->insertData($data_insert);
        if ($res >= 1) {
            $this->session->set_flashdata("notices", [0 => "Tambah Data Berhasil!"]);
            redirect('siswa/' . $nis);
        } else {
            $this->session->set_flashdata("errors", [0 => "Tambah Data Gagal!"]);
            redirect('siswa/' . $nis);
        }
    }

    public function edit_sertifikat($nis, $id) {
        $this->blockUnloggedOne();
        $data_insert = $this->input->post(null, true);
        $data_insert['id'] = $id;
        $data_insert['nis'] = $nis;
        $tgl_arr = explode('-', $data_insert['tgl']);
        $data_insert['tgl_ujian'] = $tgl_arr[2].'-'.$tgl_arr[1].'-'.$tgl_arr[0];
        $res = $this->sertifikat->updateData($data_insert);
        if ($res >= 1) {
            $this->session->set_flashdata("notices", [0 => "Edit Data Berhasil!"]);
            redirect('siswa/' . $nis);
        } else {
            $this->session->set_flashdata("errors", [0 => "Edit Data Gagal!"]);
            redirect('siswa/' . $nis);
        }
    }

    public function hapus_sertifikat($nis, $id) {
        $this->blockUnloggedOne();
        $juz = explode('-', $id)[1];
        if ($this->sertifikat->deleteData(['nis' => $nis, 'id' => $id, 'juz' => $juz])) {
            $this->session->set_flashdata("notices", [0 => "Data telah berhasil dihapus"]);
            redirect('siswa/' . $nis, 'refresh');
        } else {
            $this->session->set_flashdata("errors", [0 => "Maaf, data tidak berhasil dihapus"]);
            redirect('siswa/' . $nis, 'refresh');
        }
    }

    public function import() {
        $this->blockUnloggedOne();
        $fileUrl = $_FILES['file']["tmp_name"];
        $res = $this->siswa->importData($fileUrl);
        if ($res == 0) {
            $this->session->set_flashdata("notices", [0 => "Import Data Berhasil!"]);
            redirect('siswa');
        } elseif ($res > 0) {
            $this->session->set_flashdata("errors", [0 => "Import Data Gagal!,<br> Cek kembali isi dokumen yang akan diimport!"]);
            redirect('siswa');
        } else {
            $this->session->set_flashdata("errors", [0 => "Import Data Gagal!,<br> File yang dimasukkan bukan file excel!"]);
            redirect('siswa');
        }
    }
    
    public function upload_foto($nis) {
        $this->blockUnloggedOne();
        $fileUrl = $_FILES['file']["tmp_name"];
        $fileType = explode('/', $_FILES['file']['type'])[1];
//        print_r($_FILES);
        $res = $this->siswa->uploadFoto($fileUrl, $fileType, $nis);
        if ($res) {
            $this->session->set_flashdata("notices", [0 => "Upload Foto Berhasil!"]);
            redirect('siswa/'.$nis);
        } else {
            $this->session->set_flashdata("errors", [0 => "Upload Foto Gagal!"]);
            redirect('siswa/'.$nis);
        }
    }
}