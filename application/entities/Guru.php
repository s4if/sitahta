<?php

Use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity(repositoryClass="GuruRepository")
 * @Table(name="guru")
 */
class Guru 
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue(strategy="NONE")
     */
    protected $nip;
    
    /**
     * @Column(type="string", length=40)
     */
    protected $nama;
    
    /**
     * @Column(type="string", name="jenis_kelamin", length=2, nullable=false)
     */
    protected $jenis_kelamin;
    
    /**
     * @Column(type="string", nullable=true)
     */
    protected $alamat;
    
    /**
     * @Column(type="string", nullable=true, length=40)
     */
    protected $email;
    
    /**
     * @Column(type="string", nullable=true, name="no_telp", length=14)
     */
    protected $no_telp;
    
    /**
     * @Column(type="string", nullable=false)
     */
    protected $password;
    
    /**
     * @Column(type="string", nullable=false, length=8)
     */
    protected $kewenangan;
    
    public function getNip() {
        return $this->nip;
    }

    public function getNama() {
        return $this->nama;
    }

    public function getJenis_kelamin() {
        return $this->jenis_kelamin;
    }

    public function getAlamat() {
        return $this->alamat;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getNo_elp() {
        return $this->no_elp;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getKewenangan() {
        return $this->kewenangan;
    }

    public function setNip($nip) {
        $this->nip = $nip;
        return $this;
    }

    public function setNama($nama) {
        $this->nama = $nama;
        return $this;
    }

    public function setJenis_kelamin($jenis_kelamin) {
        $this->jenis_kelamin = $jenis_kelamin;
        return $this;
    }

    public function setAlamat($alamat) {
        $this->alamat = $alamat;
        return $this;
    }

    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    public function setNo_Telp($no_telp) {
        $this->no_telp = $no_telp;
        return $this;
    }

    public function setPassword($password) {
        $this->password = $password;
        return $this;
    }

    public function setKewenangan($kewenangan) {
        $this->kewenangan = $kewenangan;
        return $this;
    }

}