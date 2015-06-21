<?php

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 * @Table(name="peserta_sertifikasi")
 */
class PesertaEntity {
    
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ManyToOne(targetEntity="SertifikasiEntity", inversedBy="peserta")
     * @JoinColumn(referencedColumnName="id", onDelete="CASCADE", nullable=false)
     **/
    private $sertifikasi;
   
    /**
     * @OneToOne(targetEntity="SiswaEntity")
     * @JoinColumn(name="siswa_nis", referencedColumnName="nis")
     **/
    private $siswa;
    
    /**
     * @Column(type="integer", nullable=false)
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

    public function setId($id) {
        $this->id = $id;
        return $this;
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
    
}