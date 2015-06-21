<?php

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 * @Table(name="sertifikasi")
 */

class SertifikasiEntity {
    
    /**
     * @Id @Column(type="string")
     * @GeneratedValue(strategy="NONE")
     */
    private $id;
    
    /**
     * @Column(type="string", nullable=false, length=30)
     */
    private $nama;
    
    /**
     * @Column(type="string", nullable=false, length=10)
     */
    private $tahun_ajaran;
    
    /**
     * @Column(type="date", nullable=false)
     */
    private $tanggal;
    
    /**
     * @Column(type="string", nullable=false, length=30)
     */
    private $tempat;
    
    /**
     * @OneToMany(targetEntity="PesertaEntity", mappedBy="sertifikasi" , cascade={"persist", "remove"})
     **/
    private $peserta;
    
    /**
     * @Column(type="integer", nullable=false)
     */
    private $kkm;
    
    public function __construct() {
        $this->peserta = new ArrayCollection();
    }
    
    public function getId() {
        return $this->id;
    }

    public function getNama() {
        return $this->nama;
    }

    public function getTahun_ajaran() {
        return $this->tahun_ajaran;
    }

    public function getTanggal() {
        return $this->tanggal;
    }

    public function getTempat() {
        return $this->tempat;
    }

    public function getPeserta() {
        return $this->peserta;
    }

    public function getKkm() {
        return $this->kkm;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setNama($nama) {
        $this->nama = $nama;
        return $this;
    }

    public function setTahun_ajaran($tahun_ajaran) {
        $this->tahun_ajaran = $tahun_ajaran;
        return $this;
    }

    public function setTanggal($tanggal) {
        $this->tanggal = $tanggal;
        return $this;
    }

    public function setTempat($tempat) {
        $this->tempat = $tempat;
        return $this;
    }

    public function setKkm($kkm) {
        $this->kkm = $kkm;
        return $this;
    }
    
}