<?php

/**
 * @Entity(repositoryClass="SertifikatRepository")
 * @Table(name="sertifikat")
 */
class SertifikatEntity
{
    
    /**
     * @Id @Column(type="string")
     * @GeneratedValue(strategy="NONE")
     */
    private $id;
    
    /**
     * @ManyToOne(targetEntity="SiswaEntity", inversedBy="sertifikat")
     * @JoinColumn(name="siswa", referencedColumnName="nis", onDelete="CASCADE", nullable=false)
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
        if($this->nilai >=90){
            return 'Mumtaz';
        }elseif($this->nilai >=80){
            return 'Jayyid Jiddan';
        }elseif($this->nilai >=70){
            return 'Jayyid';
        }  else {
            return 'Dha\'if';
        }
    }

    public function getKeterangan() {
        return $this->keterangan;
    }
    
    public function generateId() {
        $this->id = $this->siswa->getNis().'-'.$this->juz;
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

    public function setKeterangan($keterangan) {
        $this->keterangan = $keterangan;
        return $this;
    }


}
