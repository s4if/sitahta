<?php

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

/**
 * @Entity(repositoryClass="SiswaRepository")
 * @Table(name="siswa")
 */
class SiswaEntity {
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue(strategy="NONE")
     */
    private $nis;

    /**
     * @Column(type="string", length=40, nullable=false)
     */
    private $nama;

    /**
     * @Column(type="string", name="jenis_kelamin", length=2, nullable=false)
     */
    private $jenis_kelamin;

    /**
     * @Column(type="string", nullable=false)
     */
    private $tempat_lahir;

    /**
     * @Column(type="date", nullable=false)
     */
    private $tgl_lahir;

    /**
     * @ManyToMany(targetEntity="KelasEntity", inversedBy="siswa")
     * @JoinTable(name="list_kelas",
     *      joinColumns={@JoinColumn(name="siswa_nis", referencedColumnName="nis")},
     *      inverseJoinColumns={@JoinColumn(name="kelas_id", referencedColumnName="id")}
     *      )
     **/
    private $kelas;
    
    /**
     * @Column(type="integer", nullable=true)
     */
    private $X_absen;
    
    /**
     * @Column(type="integer", nullable=true)
     */
    private $XI_absen;
    
    /**
     * @Column(type="integer", nullable=true)
     */
    private $XII_absen;

    /**
     * @Column(type="string", nullable=false)
     */
    private $password;

    /**
     * @Column(type="string", nullable=true)
     */
    private $nama_ortu;

    /**
     * @OneToMany(targetEntity="NilaiHarianEntity", mappedBy="siswa", cascade={"persist", "remove"})
     **/
    private $nilai;

    /**
     * @OneToMany(targetEntity="SertifikatEntity", mappedBy="siswa" , cascade={"persist", "remove"})
     **/
    private $sertifikat;

    public function __construct() {
        $this->nilai = new ArrayCollection();
        $this->sertifikat = new ArrayCollection();
        $this->kelas = new ArrayCollection();
    }

    public function getNis() {
        return $this->nis;
    }

    public function getNama() {
        return $this->nama;
    }

    public function getJenis_kelamin() {
        return $this->jenis_kelamin;
    }

    public function getTempat_lahir() {
        return $this->tempat_lahir;
    }

    public function getTgl_lahir() {
        return $this->tgl_lahir;
    }

    public function getKelas() {
        return $this->kelas;
    }
    
    public function getAbsen($kelas) {
        return $this->$kelas."_absen";
    }

    //belum terji
    public function getKelasTahun($tahun_ajaran) {
        $criteria = Criteria::create();
        $criteria->where(Criteria::expr()->eq('tahun_ajaran', $tahun_ajaran))
                 ->getFirstResult();
        return $this->kelas->matching($criteria);
    }

    public function getPassword() {
        return $this->password;
    }

    public function getNama_ortu() {
        return $this->nama_ortu;
    }

    public function getNilai() {
        return $this->nilai;
    }

    public function getNilaiByKelas($kelas, $semester = -4) {
        $criteria = Criteria::create()
                ->where(Criteria::expr()->eq('kelas', $kelas));
        if ($semester == 1 || $semester == 2) {
            $criteria->andWhere(Criteria::expr()->eq('semester', $semester));
        }
        $criteria->orderBy(array("no_uh" => Criteria::ASC));
        return $this->nilai->matching($criteria);
    }
    
    public function getNilaiByUH($kelas, $no_uh, $semester = -4) {
        $criteria = Criteria::create()
                ->where(Criteria::expr()->eq('kelas', $kelas))
                ->andWhere(Criteria::expr()->eq('no_uh', $no_uh))
                ->andWhere(Criteria::expr()->eq('semester', $semester));
        return $this->nilai->matching($criteria);
    }

    public function getSertifikat() {
        return $this->sertifikat;
    }

    public function setNis($nis) {
        $this->nis = $nis;
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

    public function setTempat_lahir($tempat_lahir) {
        $this->tempat_lahir = $tempat_lahir;
        return $this;
    }

    public function setTgl_lahir($tgl_lahir) {
        $this->tgl_lahir = $tgl_lahir;
        return $this;
    }

    public function setPassword($password) {
        $this->password = $password;
        return $this;
    }

    public function setNama_ortu($nama_ortu) {
        $this->nama_ortu = $nama_ortu;
        return $this;
    }

    public function addNilai(NilaiHarianEntity $nilai) {
        $this->nilai[] = $nilai;
        return $this;
    }

    public function addSertifikat(SertifikatEntity $sertifikat) {
        $this->sertifikat[] = $sertifikat;
        return $this;
    }

    protected function realAddKelas($kelas){
        $kelas->addSiswa($this);
        $this->kelas[] = $kelas;
        return $this;
    }
    
    protected function cekKelas($kelas, $tahun){
        $criteria = Criteria::create();
        $criteria->where(Criteria::expr()->eq('tahun_ajaran', $tahun))
                ->andWhere(Criteria::expr()->eq('kelas', $kelas));
        return $this->kelas->matching($criteria);
    }
    
    protected function cekTingkat($kelas){
        $criteria = Criteria::create();
        $criteria->where(Criteria::expr()->eq('kelas', $kelas));
        return $this->kelas->matching($criteria);
    }
    
    protected function cekTahun($tahun){
        $criteria = Criteria::create();
        $criteria->where(Criteria::expr()->eq('tahun_ajaran', $tahun));
        return $this->kelas->matching($criteria);
    }
    
    protected function cekInstance($kelas_ref, $kelas_cek){
        if($kelas_ref === $kelas_cek){
            return 0;
        }  else {
            $this->kelas->removeElement($kelas_ref);
            //throw new Exception("Error, kelas berbeda tapi tahun sama!!!");
            $this->kelas->add($kelas_cek);
            return 1;
        }
    }

    public function addKelas(KelasEntity $kelas, $tingkat, $tahun) {
        $kelas_cek_tingkat = $this->cekTingkat($tingkat);
        //jika tingkat tidak sama
        if($kelas_cek_tingkat->isEmpty()){
            //jika tingkat dan tahun berbeda langsung tambah (return 1)
            if($this->cekTahun($tahun)->isEmpty()){
                //throw new Exception("Error, kelas berbeda tapi tahun sama!!!");
                $this->realAddKelas($kelas);
                return 1;
            }  
            //jika tingkat berbeda dan tahun sama maka return error (return minus)
            else {
                throw new Exception("Error, kelas berbeda tapi tahun sama!!!");
                //return -1;
            }
        }
        //jika tingkat sama
        else{
            $kelas_cek_tahun = $this->cekTahun($tahun);
            //jika tingkat sama tahun berbeda
            if($kelas_cek_tahun->isEmpty()){
                $this->kelas->removeElement($kelas_cek_tingkat->first()->current());
                $this->kelas->add($kelas);
                return 1;
            }  else {
                $this->cekInstance($this->cekKelas($tingkat, $tahun)->first()->current(), $kelas);
            }
        }
    }
}