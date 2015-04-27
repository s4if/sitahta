<?php

Use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity(repositoryClass="SiswaRepository")
 * @Table(name="kelas")
 */
class KelasEntity {
    
    /**
     * @Id @Column(type="string")
     * @GeneratedValue(strategy="NONE")
     */
    private $id;
    
    /**
     * @Column(type="string", nullable=false, length=4)
     */
    private $kelas;
    
    /**
     * @Column(type="string", nullable=false, length=10)
     */
    private $jurusan;
    
    /**
     * @Column(type="integer", nullable=false)
     */
    private $no_kelas;
    
    /**
     * @Column(type="string", nullable=false, length=10)
     */
    private $tahun_ajaran;
    
    //bisa ditambah wali kelas, tapi tidak sekarang
    
    /**
     * @ManyToMany(targetEntity="SiswaEntity", mappedBy="kelas")
     * @JoinColumn(name="siswa", onDelete="CASCADE", referencedColumnName="nis", nullable=false)
     **/
    private $siswa;
    
    public function __construct() {
        $this->nilai = new Doctrine\Common\Collections\ArrayCollection();
        $this->sertifikat = new Doctrine\Common\Collections\ArrayCollection();
        $this->kelas = new Doctrine\Common\Collections\ArrayCollection();
    }
    
    public function generateId(){
        $str_jur = ($this->kelas == 'X')?'':$this->jurusan.'-';
        $this->id = $this->kelas."-".$str_jur.$this->no_kelas.'-'.$this->tahun_ajaran;
    }
    
    public function getId() {
        return $this->id;
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

    public function getTahun_ajaran() {
        return $this->tahun_ajaran;
    }

    public function getSiswa() {
        return $this->siswa;
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

    public function setTahun_ajaran($tahun_ajaran) {
        $this->tahun_ajaran = $tahun_ajaran;
        return $this;
    }

    public function addSiswa(SiswaEntity $siswa) {
        $this->siswa[] = $siswa;
        return $this;
    }


}
