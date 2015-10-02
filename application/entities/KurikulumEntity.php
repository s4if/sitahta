<?php

/**
 * @Entity(repositoryClass="KurikulumRepository")
 * @Table(name="kurikulum")
 */
class KurikulumEntity {
    
    /**
    * @Id @Column(type="string")
    * @GeneratedValue(strategy="NONE")
    */
    private $id;
    
    /**
    * @Column(type="string", nullable=false)
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
     * @Column(type="string", nullable=false, length=9)
     */
    private $tahun;
    
    /**
    * @Column(type="integer", nullable=true)
    */
    private $juz;

    /**
     * @Column(type="string", nullable=true, length=100)
     */
    private $surat_awal;
    
    /**
    * @Column(type="integer", nullable=true)
    */
    private $ayat_awal;
    
    /**
     * @Column(type="string", nullable=true, length=100)
     */
    private $surat_akhir;
    
    /**
    * @Column(type="integer", nullable=true)
    */
    private $ayat_akhir;
    
    public function getId() {
        return $this->id;
    }

    public function getNo_uh() {
        return $this->no_uh;
    }

    public function getKelas() {
        return $this->kelas;
    }

    public function getSemester() {
        return $this->semester;
    }

    public function getJuz() {
        return $this->juz;
    }

    public function getSurat_awal() {
        return $this->surat_awal;
    }

    public function getAyat_awal() {
        return $this->ayat_awal;
    }

    public function getSurat_akhir() {
        return $this->surat_akhir;
    }

    public function getAyat_akhir() {
        return $this->ayat_akhir;
    }
    public function getTahun() {
        return $this->tahun;
    }

    public function generateId() {
        if(isset($this->no_uh, $this->kelas, $this->semester, $this->tahun)){
            $this->id = $this->kelas.'-'.$this->semester.'-'.$this->no_uh.'-'.$this->tahun;
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function reset(){
        $this->juz = null;
        $this->surat_awal = null;
        $this->surat_akhir = null;
        $this->ayat_awal = null;
        $this->ayat_akhir = null;
    }

    public function setNo_uh($no_uh) {
        $this->no_uh = $no_uh;
        return $this;
    }

    public function setKelas($kelas) {
        $this->kelas = $kelas;
        return $this;
    }

    public function setSemester($semester) {
        $this->semester = $semester;
        return $this;
    }
    
    public function setTahun($tahun) {
        $this->tahun = $tahun;
        return $this;
    }

    public function setJuz($juz) {
        $this->juz = $juz;
        return $this;
    }

    public function setSurat_awal($surat_awal) {
        $this->surat_awal = $surat_awal;
        return $this;
    }

    public function setAyat_awal($ayat_awal) {
        $this->ayat_awal = $ayat_awal;
        return $this;
    }

    public function setSurat_akhir($surat_akhir) {
        $this->surat_akhir = $surat_akhir;
        return $this;
    }

    public function setAyat_akhir($ayat_akhir) {
        $this->ayat_akhir = $ayat_akhir;
        return $this;
    }

}
