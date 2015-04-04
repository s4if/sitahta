<?php

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity(repositoryClass="SertifikatRepository")
 * @Table(name="sertifikat")
 */
class SertifikatEntity
{
    
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ManyToOne(targetEntity="SiswaEntity", inversedBy="sertifikat")
     * @JoinColumn(name="siswa", referencedColumnName="nis", nullable=false)
     **/
   private $siswa;
    
    /**
     * @Column(type="string", nullable=true)
     */
    private $tempat_ujian;
    
    /**
     * @Column(type="date", nullable=false)
     */
    private $tgl_ujian;
    
    /**
     * @Column(type="integer", nullable=false)
     */
    private $juz;
    
    /**
     * @Column(type="integer", nullable=false)
     */
    private $nilai;
    
    /**
     * @Column(type="string", length=15, nullable=true)
     */
    private $predikat;
    
    /**
     * @Column(type="string", nullable=true)
     */
    private $keterangan;
    
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
