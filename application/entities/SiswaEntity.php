<?php

Use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity(repositoryClass="SiswaRepository")
 * @Table(name="siswa")
 */
class SiswaEntity
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue(strategy="NONE")
     */
    private $nis;
    
    /**
     * @Column(type="string", length=40, nullable=false)
     */
    private $nama;
    
    /**
     * @Column(type="string", name="jenis_kelamin", length=2, nullable=false)
     */
    private $jenis_kelamin;
    
    /**
     * @Column(type="string", nullable=false)
     */
    private $tempat_lahir;
    
    /**
     * @Column(type="date", nullable=false)
     */
    private $tgl_lahir;
    
    /**
     * @Column(type="string", nullable=true, length=4)
     */
    private $kelas;
    
    /**
     * @Column(type="string", nullable=true, length=10)
     */
    private $jurusan;
    
    /**
     * @Column(type="integer", nullable=true)
     */
    private $no_kelas;
    
    /**
     * @Column(type="string", nullable=false)
     */
    private $password;
    
    /**
     * @Column(type="string", nullable=true)
     */
    private $nama_ortu;
    
    /**
     * @OneToMany(targetEntity="NilaiHarianEntity", mappedBy="siswa", cascade={"persist", "remove"})
     **/
    private $nilai;
    
    /**
     * @OneToMany(targetEntity="SertifikatEntity", mappedBy="siswa" , cascade={"persist", "remove"})
     **/
    private $sertifikat;

    public function __construct() {
        $this->nilai = new Doctrine\Common\Collections\ArrayCollection();
        $this->sertifikat = new Doctrine\Common\Collections\ArrayCollection();
    }

    public function getNis() {
        return $this->nis;
    }

    public function getNama() {
        return $this->nama;
    }

    public function getJenis_kelamin() {
        return $this->jenis_kelamin;
    }

    public function getTempat_lahir() {
        return $this->tempat_lahir;
    }

    public function getTgl_lahir() {
        return $this->tgl_lahir;
    }

    public function getKelas() {
        return $this->kelas;
    }

    public function getJurusan() {
        return $this->jurusan;
    }

    public function getNo_kelas() {
        return $this->no_kelas;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getNama_ortu() {
        return $this->nama_ortu;
    }
    
    public function getNilai() {
        return $this->nilai;
    }
    
    public function getSertifikat() {
        return $this->sertifikat;
    }

    public function setNis($nis) {
        $this->nis = $nis;
        return $this;
    }

    public function setNama($nama) {
        $this->nama = $nama;
        return $this;
    }

    public function setJenis_kelamin($jenis_kelamin) {
        $this->jenis_kelamin = $jenis_kelamin;
        return $this;
    }

    public function setTempat_lahir($tempat_lahir) {
        $this->tempat_lahir = $tempat_lahir;
        return $this;
    }

    public function setTgl_lahir($tgl_lahir) {
        $this->tgl_lahir = $tgl_lahir;
        return $this;
    }

    public function setKelas($kelas) {
        $this->kelas = $kelas;
        return $this;
    }

    public function setJurusan($jurusan) {
        $this->jurusan = $jurusan;
        return $this;
    }

    public function setNo_kelas($no_kelas) {
        $this->no_kelas = $no_kelas;
        return $this;
    }

    public function setPassword($password) {
        $this->password = $password;
        return $this;
    }

    public function setNama_ortu($nama_ortu) {
        $this->nama_ortu = $nama_ortu;
        return $this;
    }

    public function setNilai($nilai) {
        $this->nilai = $nilai;
        return $this;
    }
    
    public function setSertifikat($sertifikat) {
        $this->sertifikat = $sertifikat;
        return $this;
    }


}