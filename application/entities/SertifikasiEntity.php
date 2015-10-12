<?php

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

/**
 * @Entity(repositoryClass="SertifikasiRepository")
 * @Table(name="sertifikasi")
 */

class SertifikasiEntity {
    
    /**
     * @Id @Column(type="string")
     * @GeneratedValue(strategy="UUID")
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
     * @Column(type="string", nullable=false, length=120)
     */
    private $tempat;
    
    /**
     * @Column(type="string", nullable=false, length=40)
     */
    private $kota;
    
    /**
     * @OneToMany(targetEntity="PesertaEntity", mappedBy="sertifikasi" , cascade={"persist", "remove"})
     **/
    private $peserta;
    
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
    
    public function getKota() {
        return $this->kota;
    }

    public function getPeserta($id_peserta = -1) {
        if($id_peserta == -1){
            return $this->peserta;
        }else{
            $criteria = Criteria::create()
                    ->Where(Criteria::expr()->eq('id', $id_peserta));
            return $this->peserta->matching($criteria);
        }
    }
    
    //custom
    public function getJumlahPeserta(){
        return $this->getPeserta()->count();
    }
    
    //belum selesai... :p
    public function getStatus(){
        return "belum";
    }
    //end custom

    public function setId($id) {
        $this->id = $id;
        return $this;
    }
    
    public function setKota($kota) {
        $this->kota = $kota;
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
    
}