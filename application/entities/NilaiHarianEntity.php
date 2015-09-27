<?php

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
    * @ManyToOne(targetEntity="KurikulumEntity")
    * @JoinColumn(name="kurikulum_id", referencedColumnName="id", nullable=false)
    **/
    private $meta;

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
    private $nilai;

    /**
     * @Column(type="integer", nullable=true)
     */
    private $nilai_remidi;

    /**
     * @ManyToOne(targetEntity="GuruEntity")
     * @JoinColumn(name="penguji", onDelete="SET NULL", referencedColumnName="nip")
     **/
    private $penguji;

    const KKM = 80;

    public function getId() {
        return $this->id;
    }

    public function getTanggal() {
        return $this->tanggal;
    }

    public function getNilai() {
        return $this->nilai;
    }

    public function getNilai_remidi() {
        if ($this->nilai >= self::KKM) {
            return null;
        } else {
            return $this->nilai_remidi;
        }
    }

    public function getNilai_akhir() {
        if ($this->getNilai() >= self::KKM) {
            return $this->getNilai();
        } elseif ($this->getNilai_remidi() >= self::KKM) {
            return self::KKM;
        } else {
            return $this->getNilai();
        }
    }

    public function getPenguji() {
        return $this->penguji;
    }
    public function getMeta() {
        return $this->meta;
    }

    public function setMeta($meta) {
        $this->meta = $meta;
        return $this;
    }

    public function setSiswa(SiswaEntity $siswa) {
        $this->siswa = $siswa;
        return $this;
    }

    public function setTanggal($tanggal) {
        $this->tanggal = $tanggal;
        return $this;
    }

    public function setNilai($nilai) {
        $this->nilai = $nilai;
        return $this;
    }

    public function setNilai_remidi($nilai_remidi) {
        if ($this->nilai >= self::KKM || $nilai_remidi <= 0) {
            $this->nilai_remidi = null;
        } else {
            $this->nilai_remidi = $nilai_remidi;
        }
        return $this;
    }

    public function setPenguji($penguji) {
        $this->penguji = $penguji;
        return $this;
    }

    public function generateId() {
        if(isset($this->siswa, $this->meta)){
            $this->id = $this->siswa->getNis() . '-' . $this->meta->getId();
            return true;
        } else {
            return FALSE;
        }
    }

    //keterangan lulusnya seperti apa
    public function getKeterangan() {
        if ($this->nilai >= self::KKM) {
                return "Lulus tanpa remidi";
        } elseif ($this->nilai_remidi >= self::KKM) {
                return "Lulus dengan remidi";
        } else {
                return "Belum lulus/remidi";
        }
    }

}
