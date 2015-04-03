<?php

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity(repositoryClass="SertifikatRepository")
 * @Table(name="sertifikat")
 */
class Sertifikat 
{
    
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ManyToOne(targetEntity="Siswa", inversedBy="sertifikat")
     * @JoinColumn(name="siswa", referencedColumnName="nis", nullable=false)
     **/
   protected $siswa;
    
    /**
     * @Column(type="string", nullable=true)
     */
    protected $tempat_ujian;
    
    /**
     * @Column(type="date", nullable=false)
     */
    protected $tgl_ujian;
    
    /**
     * @Column(type="integer", nullable=false)
     */
    protected $juz;
    
    /**
     * @Column(type="integer", nullable=false)
     */
    protected $nilai;
    
    /**
     * @Column(type="string", length=15, nullable=true)
     */
    protected $predikat;
    
    /**
     * @Column(type="string", nullable=true)
     */
    protected $keterangan;
    
    public function getId() {
        return $this->id;
    }

    public function getSiswa() {
        return $this->siswa;
    }

    public function getTempat_ujian() {
        return $this->tempat_ujian;
    }

    public function getTgl_ujian() {
        return $this->tgl_ujian;
    }

    public function getJuz() {
        return $this->juz;
    }

    public function getNilai() {
        return $this->nilai;
    }

    public function getPredikat() {
        return $this->predikat;
    }

    public function getKeterangan() {
        return $this->keterangan;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setSiswa($siswa) {
        $this->siswa = $siswa;
        return $this;
    }

    public function setTempat_ujian($tempat_ujian) {
        $this->tempat_ujian = $tempat_ujian;
        return $this;
    }

    public function setTgl_ujian($tgl_ujian) {
        $this->tgl_ujian = $tgl_ujian;
        return $this;
    }

    public function setJuz($juz) {
        $this->juz = $juz;
        return $this;
    }

    public function setNilai($nilai) {
        $this->nilai = $nilai;
        return $this;
    }

    public function setPredikat($predikat) {
        $this->predikat = $predikat;
        return $this;
    }

    public function setKeterangan($keterangan) {
        $this->keterangan = $keterangan;
        return $this;
    }


}
