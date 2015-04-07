<?php

Use Doctrine\Common\Collections\ArrayCollection;

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
     * @ManyToOne(targetEntity="GuruEntity")
     * @JoinColumn(name="penguji", onDelete="SET NULL", referencedColumnName="nip")
     **/
    private $penguji;
    
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

    public function getPenguji() {
        return $this->penguji;
    }

    //disabled
//    public function setId($id) {
//        $this->id = $id;
//        return $this;
//    }

    public function setNo_uh($no_uh) {
        $this->no_uh = $no_uh;
        return $this;
    }

    public function setKelas($kelas) {
        $this->kelas = $kelas;
        return $this;
    }

    public function setSiswa($siswa) {
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

    public function setPenguji($penguji) {
        $this->penguji = $penguji;
        return $this;
    }

    public function generateId(){
        $this->id = $this->no_uh.$this->kelas.$this->siswa->getNis();
    }
    
}