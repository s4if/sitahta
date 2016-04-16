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
        $this->load->model('model_sertifikat','sertifikat',TRUE);
        $this->load->model('model_sertifikasi','sertifikasi',TRUE);
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
        $arr_kelas = $this->siswa->getKelas($kelas, $this->session->tahun_ajaran);
        $data_kelas = [
            0 => empty($arr_kelas)? new KelasEntity(): $arr_kelas[0]
            ];
        $semester = ($in_semester == 1 || $in_semester == 2)? $in_semester : $this->session->semester;
        $list_kelas = [];
        $kelas_2 = array();
        $is_general = ($kelas == 'X' || $kelas == 'XI' || $kelas == 'XII');
        if($is_general){
            $kelas = empty($arr_kelas)? null :$data_kelas[0]->getNamaKelas();
            $kelas_2 = explode('-', $kelas);
            $list_kelas = $arr_kelas;
        }  else {
            $kelas_2 = explode('-', $kelas);
            $list_kelas = $this->siswa->getKelas($kelas_2[0], $this->session->tahun_ajaran);
        }
        if(empty($arr_kelas) || !$is_general){
            $data = [
                'title' => 'Lihat Nilai',
                'user' => ucwords($this->session->login_data->getNama()),
                'position' => $this->session->position,
                'nama' => $this->session->login_data->getNama(),
                'nav_pos' => "nilai".$kelas_2[0],
                'judul_kelas' => $kelas_2,
                'tahun_ajaran' => $this->session->tahun_ajaran,
                'edit' => $this->load->view("admin/nilai/edit", [], TRUE),
                'semester' => $semester,
                'id_kelas' => $kelas,
                'list_kelas' => $list_kelas,
                'data_kelas' => $data_kelas
            ];
            $this->loadView('admin/nilai/lihat', $data);
        }  else {
            redirect('nilai/'.$data_kelas[0]->getId().'/'.$semester);
        }
    }
    
    public function ajax_lihat($kelas = 'X', $in_semester = 9){
        $this->blockUnloggedOne();
        $arr_kelas = $this->siswa->getKelas($kelas, $this->session->tahun_ajaran);
        $obj_kelas = empty($arr_kelas)? new KelasEntity(): $arr_kelas[0];
        $semester = ($in_semester == 1 || $in_semester == 2)? $in_semester : $this->session->semester;
        $kelas_2 = explode('-', $kelas);
        $arr_siswa = empty($obj_kelas->getSiswa())?[]:$obj_kelas->getSiswa();
        $jml_uh = ($kelas_2 [0] == 'X')?20:15;
        $ajax_data = [];
        foreach ($arr_siswa as $siswa){
            $ajax_data[] = $this->ajax_data($siswa, $semester, $kelas_2, $jml_uh);
        }
        echo json_encode(['data' => $ajax_data]);
    }
    
    private function ajax_data($siswa, $semester, $kelas_2, $jml_uh){
        $row[] = $siswa->getNis();
        $row[] = $siswa->getNama();
        for($i = 1; $i<=$jml_uh+2;$i++) {
            $no_uh = NULL;
            if($i<=$jml_uh) { $no_uh = $i; }
            if($i==$jml_uh+1) { $no_uh = 'UTS'; }
            if($i==$jml_uh+2) { $no_uh = 'UAS'; }
            $row[] = $this->load->view('admin/nilai/fragment/nilai', [
                'siswa' => $siswa,
                'semester' => $semester,
                'no_uh' => $no_uh,
                'judul_kelas' => $kelas_2,
                'tahun_ajaran' => $this->session->tahun_ajaran
            ], true);
            if(is_null($siswa->getNilaiByUH($kelas_2[0], $no_uh, $semester))){
                $row[] = '--';
            } else {
                $data_nilai = $siswa->getNilaiByUH($kelas_2[0], $no_uh, $semester);
                $row[] = (is_null($data_nilai->getNilai_remidi()))?'--':$data_nilai->getNilai_remidi();
            }
        } return $row;
    }
    
    public function tambah_nilai($kelas, $nis) {
        $this->blockUnloggedOne();
        $data_insert = $this->input->post(null, FALSE);
        $data_insert['nis'] = $nis;
        $tgl_arr = explode('-', $data_insert['tgl']);
        $data_insert['tanggal'] = $tgl_arr[2].'-'.$tgl_arr[1].'-'.$tgl_arr[0];
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
        $data_insert = $this->input->post(null, false);
        $data_insert['nis'] = $nis;
        $tgl_arr = explode('-', $data_insert['tgl']);
        $data_insert['tanggal'] = $tgl_arr[2].'-'.$tgl_arr[1].'-'.$tgl_arr[0];
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
    
    public function ajax_tambah_nilai($kelas, $nis) {
        $this->blockUnloggedOne();
        $data_insert = $this->input->post(null, FALSE);
        $data_insert['nis'] = $nis;
        $tgl_arr = explode('-', $data_insert['tgl']);
        $data_insert['tanggal'] = $tgl_arr[2].'-'.$tgl_arr[1].'-'.$tgl_arr[0];
        $data_insert['penguji'] = $this->session->login_data->getNip();
        $res = $this->nilai->insertData($data_insert, TRUE);
        if($res >= 1){
            echo json_encode([
                'status' => true,
            ]);
        } else {
            echo json_encode([
                'status' => false,
            ]);
        }
    }

    public function ajax_edit_nilai($kelas, $nis) {
        $this->blockUnloggedOne();
        $data_insert = $this->input->post(null, false);
        $data_insert['nis'] = $nis;
        $tgl_arr = explode('-', $data_insert['tgl']);
        $data_insert['tanggal'] = $tgl_arr[2].'-'.$tgl_arr[1].'-'.$tgl_arr[0];
        $data_insert['penguji'] = $this->session->login_data->getNip();
        $res = $this->nilai->updateData($data_insert);
        if($res >= 1){
            echo json_encode([
                'status' => true,
            ]);
        } else {
            echo json_encode([
                'status' => false,
            ]);
        }
    }
    
    public function ajax_hapus_nilai($nis, $kelas, $semester, $no_uh, $tahun) {
        $this->blockUnloggedOne();
        if ($this->nilai->deleteData(['nis' => $nis, 'no_uh' => $no_uh, 'kelas' => $kelas, 'semester' => $semester, 'tahun_ajaran' => $tahun])) {
            echo json_encode([
                'status' => true,
            ]);
        } else {
            echo json_encode([
                'status' => false,
            ]);
        }
    }

    public function hapus_nilai($nis, $kelas, $semester, $no_uh, $tahun) {
        $this->blockUnloggedOne();
        if ($this->nilai->deleteData(['nis' => $nis, 'no_uh' => $no_uh, 'kelas' => $kelas, 'semester' => $semester, 'tahun_ajaran' => $tahun])) {
            $this->session->set_flashdata("notices", [0 => "Data telah berhasil dihapus"]);
            redirect('nilai/' . $kelas . '/' .$semester, 'refresh');
        } else {
            $this->session->set_flashdata("errors", [0 => "Maaf, data tidak berhasil dihapus"]);
            redirect('nilai/' . $kelas . '/' .$semester, 'refresh');
        }
    }
    
    public function import($kelas, $semester) {
        $this->blockUnloggedOne();
        $fileUrl = $_FILES['file']["tmp_name"];
        $res = $this->nilai->importData($fileUrl);
        if ($res == 0) {
            $this->session->set_flashdata("notices", [0 => "Import Data Berhasil!"]);
            redirect('nilai/' . $kelas . '/' .$semester, 'refresh');
        } elseif ($res > 0) {
            $this->session->set_flashdata("errors", [0 => "Import Data Gagal!,<br> Cek kembali isi dokumen yang akan diimport!"]);
            redirect('nilai');
        } else {
            $this->session->set_flashdata("errors", [0 => "Import Data Gagal!,<br> File yang dimasukkan bukan file excel!"]);
            redirect('nilai/' . $kelas . '/' .$semester, 'refresh');
        }
    }
    
    public function raport(){
        $this->blockUnloggedOne();
        $id_kelas = $this->input->post('kelas');
        $semester = $this->input->post('semester');
        $data_kelas = $this->siswa->getKelas($id_kelas, $this->session->tahun_ajaran)[0];
        $data_siswa = $this->siswa->getDataByKelas($data_kelas);
        $data = [
            'title' => 'Raport Tahta',
            'tahun_ajaran' => $this->session->tahun_ajaran,
            'semester' => $semester,
            'id_kelas' => $id_kelas,
            'kelas' => $data_kelas,
            'tanggal_print' => $this->input->post('tanggal')
        ];
        
        $pdf = new mikehaertl\wkhtmlto\Pdf();
        $pdf->setOptions($this->pdfOption());
        $data_sertifikat = $this->sertifikasi->getSertifikat($semester, $this->session->tahun_ajaran);
        foreach ($data_siswa as $siswa){
            $data['siswa'] = $siswa;
            $data['data_sertifikat'] = (array_key_exists($siswa->getNis(), $data_sertifikat))?$data_sertifikat[$siswa->getNis()]:[];
            $html = $this->load->view('admin/nilai/raport', $data, TRUE);
            $pdf->addPage($html);
        }
        
        //real output
        if (!$pdf->send('Rapor '.$id_kelas.'.pdf')) {
            echo $pdf->getError();
        }
    }
    
    public function raport_uts(){
        $this->blockUnloggedOne();
        $id_kelas = $this->input->post('kelas');
        $semester = $this->input->post('semester');
        $uh_terakhir = $this->input->post('uh_terakhir');
        $data_kelas = $this->siswa->getKelas($id_kelas, $this->session->tahun_ajaran)[0];
        $data_siswa = $this->siswa->getDataByKelas($data_kelas);
        $data = [
            'title' => 'Raport Tahta',
            'tahun_ajaran' => $this->session->tahun_ajaran,
            'semester' => $semester,
            'id_kelas' => $id_kelas,
            'kelas' => $data_kelas,
            'uh_terakhir' => $uh_terakhir,
            'tanggal_print' => $this->input->post('tanggal')
        ];
        
        $pdf = new mikehaertl\wkhtmlto\Pdf();
        $pdf->setOptions($this->pdfOption());
        $data_sertifikat = $this->sertifikasi->getSertifikat($semester, $this->session->tahun_ajaran);
        foreach ($data_siswa as $siswa){
            $data['siswa'] = $siswa;
            $data['data_sertifikat'] = (array_key_exists($siswa->getNis(), $data_sertifikat))?$data_sertifikat[$siswa->getNis()]:[];
            $html = $this->load->view('admin/nilai/raport_uts', $data, TRUE);
            $pdf->addPage($html);
        }
        
        //real output
        if (!$pdf->send('Rapor UTS '.$id_kelas.'.pdf')) {
            echo $pdf->getError();
        }
    }
    
    private  function pdfOption(){
        $options = [
            'page-size' => 'A4',
            'dpi' => 96,
            'image-quality' => 100,
            'margin-top' => '25mm',
            'margin-right' => '20mm',
            'margin-bottom' => '25mm',
            'margin-left' => '20mm',
            'header-spacing' => 15,
            'footer-spacing' => 5,
            'disable-smart-shrinking',
            'no-outline'
        ];
        return $options;
    }

    public function template($kelas, $semester){
        $data = $this->input->post(null,true);
        $data['id_kelas'] = $kelas;
        $data['pengampu'] = $this->session->login_data->getNip();
        $fileName = 'template nilai ('.$kelas.' Semester '.$semester.')';
        $this->nilai->generate($data, $fileName);
    }
    
}