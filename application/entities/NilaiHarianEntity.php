<?php

/**
 * @Entity(repositoryClass="NilaiHarianRepository")
 * @Table(name="nilai_harian")
 */
class NilaiHarianEntity {

	/**
	 * @Id @Column(type="string")
	 * @GeneratedValue(strategy="NONE")
	 */
	private $id;

	/**
	 * @Column(type="integer", nullable=false)
	 */
	private $no_uh;

	/**
	 * @Column(type="string", nullable=false, length=4)
	 */
	private $kelas;

	/**
	 * @Column(type="integer", nullable=false)
	 */
	private $semester;

	/**
	 * @ManyToOne(targetEntity="SiswaEntity", inversedBy="nilai")
	 * @JoinColumn(name="siswa", onDelete="CASCADE", referencedColumnName="nis", nullable=false)
	 **/
	private $siswa;

	/**
	 * @Column(type="date", nullable=false)
	 */
	private $tanggal;

	/**
	 * @Column(type="integer", nullable=true)
	 */
	private $juz;

	/**
	 * @Column(type="string", nullable=true, length=4)
	 */
	private $halaman;

	/**
	 * @Column(type="integer", nullable=true)
	 */
	private $nilai;

	/**
	 * @Column(type="integer", nullable=true)
	 */
	private $nilai_remidi;

	/**
	 * @ManyToOne(targetEntity="GuruEntity")
	 * @JoinColumn(name="penguji", onDelete="SET NULL", referencedColumnName="nip")
	 **/
	private $penguji;

	const KKM = 80;

	public function getId() {
		return $this->id;
	}

	public function getNo_uh() {
		return $this->no_uh;
	}

	public function getKelas() {
		return $this->kelas;
	}

	public function getSiswa() {
		return $this->siswa;
	}

	public function getTanggal() {
		return $this->tanggal;
	}

	public function getJuz() {
		return $this->juz;
	}

	public function getHalaman() {
		return $this->halaman;
	}

	public function getNilai() {
		return $this->nilai;
	}

	public function getNilai_remidi() {
		if ($this->nilai >= self::KKM) {
			return null;
		} else {
			return $this->nilai_remidi;
		}
	}

	public function getNilai_akhir() {
		if ($this->getNilai() >= self::KKM) {
			return $this->getNilai();
		} elseif ($this->getNilai_remidi() >= self::KKM) {
			return self::KKM;
		} else {
			return $this->getNilai();
		}
	}

	public function getPenguji() {
		return $this->penguji;
	}

	public function getSemester() {
		return $this->semester;
	}

	public function setSemester($semester) {
		$this->semester = $semester;
		return $this;
	}

	public function setNo_uh($no_uh) {
		$this->no_uh = $no_uh;
		return $this;
	}

	public function setKelas($kelas) {
		$this->kelas = $kelas;
		return $this;
	}

	public function setSiswa(SiswaEntity $siswa) {
		$this->siswa = $siswa;
		return $this;
	}

	public function setTanggal($tanggal) {
		$this->tanggal = $tanggal;
		return $this;
	}

	public function setJuz($juz) {
		$this->juz = $juz;
		return $this;
	}

	public function setHalaman($halaman) {
		$this->halaman = $halaman;
		return $this;
	}

	public function setNilai($nilai) {
		$this->nilai = $nilai;
		return $this;
	}

	public function setNilai_remidi($nilai_remidi) {
            if ($this->nilai >= self::KKM || $nilai_remidi <= 0) {
                $this->nilai_remidi = null;
            } else {
                $this->nilai_remidi = $nilai_remidi;
            }
            return $this;
	}

	public function setPenguji($penguji) {
		$this->penguji = $penguji;
		return $this;
	}

	public function generateId() {
		$this->id = $this->siswa->getNis() . '-' . $this->kelas . '-' . $this->semester . '-' . $this->no_uh;
	}

	//keterangan lulusnya seperti apa
	public function getKeterangan() {
		if ($this->nilai >= self::KKM) {
			return "Lulus tanpa remidi";
		} elseif ($this->nilai_remidi >= self::KKM) {
			return "Lulus dengan remidi";
		} else {
			return "Belum lulus/remidi";
		}
	}

}
