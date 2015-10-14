<?php

/**
 * @Entity
 * @Table(name="peserta_sertifikasi")
 */
class PesertaEntity {
    
    /**
     * @Id @Column(type="string")
     * @GeneratedValue(strategy="NONE")
     */
    private $id;
    
    /**
     * @ManyToOne(targetEntity="SertifikasiEntity", inversedBy="peserta")
     * @JoinColumn(referencedColumnName="id", onDelete="CASCADE", nullable=false)
     **/
    private $sertifikasi;
    
    /**
     * @OneToOne(targetEntity="SertifikatEntity")
     * @JoinColumn(name="sertifikat_id", referencedColumnName="id")
     * @Column(nullable=true)
     **/
    private $sertifikat;
   
    /**
     * @ManyToOne(targetEntity="SiswaEntity")
     * @JoinColumn(name="siswa_nis", referencedColumnName="nis", onDelete="CASCADE", nullable=false)
     **/
    private $siswa;
    
    /**
     * @Column(type="integer", nullable=false)
     */
    private $juz;
    
    /**
     * @Column(type="integer", nullable=true)
     */
    private $nilai;
    
    public function getId() {
        return $this->id;
    }

    public function getSertifikasi() {
        return $this->sertifikasi;
    }

    public function getSiswa() {
        return $this->siswa;
    }

    public function getNilai() {
        return $this->nilai;
    }
    public function getJuz() {
        return $this->juz;
    }

    public function setJuz($juz) {
        $this->juz = $juz;
        return $this;
    }
    public function getSertifikat() {
        return $this->sertifikat;
    }
    
    public function generateId(){
        if(isset($this->siswa, $this->juz, $this->sertifikasi)){
            $this->id = $this->sertifikasi->getId() . '-' . $this->siswa->getNis() . '-' . $this->juz;
            return true;
        } else {
            return FALSE;
        }
    }

    public function setSertifikasi($sertifikasi) {
        $this->sertifikasi = $sertifikasi;
        return $this;
    }

    public function setSiswa($siswa) {
        $this->siswa = $siswa;
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