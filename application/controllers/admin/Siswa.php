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
		$this->load->model('model_sertifikasi', 'sertifikasi', TRUE);
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
		$data_kelas = $this->siswa->getKelas($kelas);
		$kelas_2 = ($kelas == 'X' || $kelas == 'XI' || $kelas == 'XII') ? [0 => $kelas] : explode('-', $kelas);
		$list_kelas = $this->siswa->getKelas($kelas_2[0]);
		$data = [
			'title' => 'Lihat Siswa',
			'user' => ucwords($this->session->login_data->getNama()),
			'position' => $this->session->position,
			'nama' => $this->session->login_data->getNama(),
			'tahun_ajaran' => $this->session->tahun_ajaran,
			'semester' => $this->session->semester,
			'tambah' => $this->load->view("admin/siswa/tambah", [], TRUE),
			'edit' => $this->load->view("admin/siswa/edit", ['data_kelas' => $data_kelas], TRUE),
			'list_kelas' => $list_kelas,
			'data_kelas' => $data_kelas
		];
		$this->loadView('admin/siswa/lihat', $data);
	}

	public function tambah() {
		$this->blockUnloggedOne();
		$data_insert = $this->input->post(null, true);
		$data_insert['tgl_lahir'] = $data_insert['tahun'] . "-" . $data_insert['bulan'] . "-" . $data_insert['tanggal'];
		$data_insert['password'] = md5("qwerty");
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
		$data_insert['tgl_lahir'] = $data_insert['tahun'] . "-" . $data_insert['bulan'] . "-" . $data_insert['tanggal'];
		$res = $this->siswa->updateData($data_insert);
		if ($res >= 1) {
			$this->session->set_flashdata("notices", [0 => "Edit Data Berhasil!"]);
			redirect('siswa');
		} else {
			$this->session->set_flashdata("errors", [0 => "Edit Data Gagal!"]);
			redirect('siswa');
		}
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

	//belum
	public function profil($nis) {
		$this->blockUnloggedOne();
		$siswa = $this->siswa->getData($nis);
		$data_sertifikasi = $siswa->getSertifikat();
		$data = [
			'title' => 'Profil Siswa',
			'user' => ucwords($this->session->login_data->getNama()),
			'position' => $this->session->position,
			'nama' => $this->session->login_data->getNama(),
			'siswa' => $siswa,
			'data_sertifikasi' => $data_sertifikasi,
			'tambah_nilai' => $this->load->view("admin/siswa/tambah_nilai", ['kelas' => $siswa->getKelas(), 'nis' => $siswa->getNis()], TRUE),
			'edit_nilai' => $this->load->view("admin/siswa/edit_nilai_js", [], TRUE),
			'tambah_sertifikasi' => $this->load->view("admin/siswa/tambah_sertifikasi", ['kelas' => $siswa->getKelas(), 'nis' => $siswa->getNis()], TRUE),
			'edit_sertifikasi' => $this->load->view("admin/siswa/edit_sertifikasi", ['data_sertifikasi' => $data_sertifikasi], TRUE),
		];
		$this->loadView('admin/siswa/profil', $data);
	}

	public function tambah_nilai($nis) {
		$this->blockUnloggedOne();
		$data_insert = $this->input->post(null, true);
		$data_insert['nis'] = $nis;
		$data_insert['tanggal'] = $data_insert['tahun'] . "-" . $data_insert['bulan'] . "-" . $data_insert['tanggal'];
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
		$data_insert['tanggal'] = $data_insert['tahun'] . "-" . $data_insert['bulan'] . "-" . $data_insert['tanggal'];
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

	public function hapus_nilai($nis, $kelas, $no_uh) {
		$this->blockUnloggedOne();
		if ($this->nilai->deleteData(['nis' => $nis, 'no_uh' => $no_uh, 'kelas' => $kelas])) {
			$this->session->set_flashdata("notices", [0 => "Data telah berhasil dihapus"]);
			redirect('siswa/' . $nis, 'refresh');
		} else {
			$this->session->set_flashdata("errors", [0 => "Maaf, data tidak berhasil dihapus"]);
			redirect('siswa/' . $nis, 'refresh');
		}
	}

	public function tambah_sertifikasi($nis) {
		$this->blockUnloggedOne();
		$data_insert = $this->input->post(null, true);
		$data_insert['nis'] = $nis;
		$data_insert['tgl_ujian'] = $data_insert['tahun'] . "-" . $data_insert['bulan'] . "-" . $data_insert['tanggal'];
		$res = $this->sertifikasi->insertData($data_insert);
		if ($res >= 1) {
			$this->session->set_flashdata("notices", [0 => "Tambah Data Berhasil!"]);
			redirect('siswa/' . $nis);
		} else {
			$this->session->set_flashdata("errors", [0 => "Tambah Data Gagal!"]);
			redirect('siswa/' . $nis);
		}
	}

	public function edit_sertifikasi($nis, $id) {
		$this->blockUnloggedOne();
		$data_insert = $this->input->post(null, true);
		$data_insert['id'] = $id;
		$data_insert['nis'] = $nis;
		$data_insert['tgl_ujian'] = $data_insert['tahun'] . "-" . $data_insert['bulan'] . "-" . $data_insert['tanggal'];
		$res = $this->sertifikasi->updateData($data_insert);
		if ($res >= 1) {
			$this->session->set_flashdata("notices", [0 => "Edit Data Berhasil!"]);
			redirect('siswa/' . $nis);
		} else {
			$this->session->set_flashdata("errors", [0 => "Edit Data Gagal!"]);
			redirect('siswa/' . $nis);
		}
	}

	public function hapus_sertifikasi($nis, $id) {
		$this->blockUnloggedOne();
		if ($this->sertifikasi->deleteData(['nis' => $nis, 'id' => $id])) {
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
}
