<?php

class ModelTest extends PHPUnit_Framework_TestCase
{
    private $CI;

    public function setUp()
    {
            $this->CI =& get_instance();
    }

    /**
     * This test will create a controller subfolder with a stub file.
     * It skips the test if the environment doesn't grant enough permissions
     * to create folder and file.
     */
    public function testLoadModelFromSubfolder()
    {
            $folder = APPPATH.'models/testsubfolder';

            // check if we can run the test
            if (!is_dir($folder)) {
                    // create subfolder
                    $success = mkdir(APPPATH.'models/testsubfolder');
                    if (!$success)
                            $this->markTestSkipped('Cannot create subfolder');
            }
            if (!is_writable($folder))
                    $this->markTestSkipped('Cannot write in subfolder');

            // create a test controller
            if (!is_writable($folder.'/Stub.php')) {
                    // create stub file
                    $success = file_put_contents($folder.'/Stub.php',
                                                                    '<?php class Stub extends CI_Model { public function index(){} } ?>');
                    if (!$success)
                            $this->markTestSkipped('Cannot create test controller file');
            }

            // Stub is there, let's autoload it
            $this->assertTrue(class_exists('Stub'), 'Stub is loadable');
            $this->CI = new Stub();
            $this->CI->index();

            // remove stub
            unlink($folder.'/Stub.php');
            rmdir($folder);
    }

    /**
     * This test will check if our bootstrap autoload won't make an
     * inexistent class suddenly be loadable
     */
    public function testLoadInexistentModelsFromSubfolder()
    {
            $this->assertFalse(class_exists('InexistentStub'), 'Inexistent class is not loadable');
    }

    //======================================================================
    //Hasil Kreasi sendiri
    //======================================================================

    public function testModel_guru() {
        $this->assertTrue(class_exists('Model_guru'), 'guru is loadable');
        $model = new Model_guru();
        $model->truncate([0 => 'guru']);
        $data = [
            'nip' => 1,
            'nama' => 'admin',
            'jenis_kelamin' => 'L',
            'alamat' => 'foo city',
            'email' => 'foo@google.com',
            'no_telp' => '08674839291',
            'password' => password_hash('zaraki', PASSWORD_BCRYPT),
            'kewenangan' => 'guru'
            ];
        //initial Data
        $model->insertData($data);
        //delete data
        $this->assertTrue($model->deleteData(['nip' => 1]));
        $this->assertFalse($model->deleteData(['nip' => 1]));
        //add data
        $this->assertTrue($model->insertData($data));
        $this->assertFalse($model->insertData($data));
        //update data
        $data['kewenangan'] = 'admin';
        $this->assertTrue($model->updateData($data));
        $data['nip'] = 4321;
        $this->assertFalse($model->updateData($data));

    }

    public function testModel_guru_2(){
        $model = new Model_guru();
        //checkAttributes
        $this->assertObjectHasAttribute('nip', $model->getData(1));
        $this->assertObjectHasAttribute('nama', $model->getData(1));
        $this->assertObjectHasAttribute('jenis_kelamin', $model->getData(1));
        $this->assertObjectHasAttribute('alamat', $model->getData(1));
        $this->assertObjectHasAttribute('email', $model->getData(1));
        $this->assertObjectHasAttribute('password', $model->getData(1));
        $this->assertObjectHasAttribute('kewenangan', $model->getData(1));
        $mod_array = $model->getData();
        $this->assertObjectHasAttribute('nip', $mod_array[0]);
        $this->assertEquals(0, $model->importData('assets/test/coba_guru.xls'));
        $this->assertEquals(-1, $model->importData('assets/test/coba_file_error.txt'));
        $this->assertGreaterThan(0,$model->importData('assets/test/coba_guru_error.xls'));
    }

    public function testModel_siswa() {
        $this->assertTrue(class_exists('Model_siswa'), 'Siswa is loadable');
        $model = new Model_siswa();
        $model->truncate([0 => 'kelas', 1 => 'siswa', 2 => 'list_kelas']);
        $data = [
            'nis' => 1001,
            'nama' => 'user',
            'jenis_kelamin' => 'L',
            'alamat' => 'foo city',
            'tempat_lahir' => 'magelang',
            'tgl_lahir' => '2000-12-12',
            'kelas' => 'XI',
            'jurusan' => 'IPS',
            'no_kelas' => '1',
            'tahun_ajaran' => '2014',
            'password' => password_hash('qwerty', PASSWORD_BCRYPT),
            'nama_ortu' => 'ortu'
            ];
        $model->insertData($data);
        //delete data
        $this->assertTrue($model->deleteData(['nis' => 1001]));
        $this->assertFalse($model->deleteData(['nis' => 1001]));
        //add data
        $this->assertTrue($model->insertData($data));
        $this->assertFalse($model->insertData($data));
        //update data
        $data['alamat'] = 'Pabelan City';
        $this->assertTrue($model->updateData($data));
        $data['nis'] = 4321;
        $this->assertFalse($model->updateData($data));

    }
    
    public function testModel_siswa_2() {
        $model = new Model_siswa();
        // Tahun Sama Tingkat Sama -> Edit
        $data = [
            'nis' => '1001',
            'kelas' => 'XI',
            'jurusan' => 'IPA',
            'no_kelas' => '1',
            'tahun_ajaran' => '2015',
            ];
        $this->assertTrue($model->updateData($data));
        
        // Tahun Sama, Tingkat Berbeda -> Edit
        $data['kelas'] = 'X';
        $data['tahun_ajaran'] = '2014';
        $this->assertTrue($model->updateData($data));
        
        // Tahun berbeda, Tingkat Sama -> Add
        $data['kelas'] = 'X';
        $data['tahun_ajaran'] = '2013';
        $this->assertTrue($model->updateData($data));
        
        //Tahun Berbeda Tingkat Berbeda -> Add
        $data['kelas'] = 'XII';
        $data['tahun_ajaran'] = '2016';
        $this->assertTrue($model->updateData($data));
        
        // Hapus Kelas
        $data['kelas'] = 'X';
        $data['tahun_ajaran'] = '2013';
        $this->assertTrue($model->deleteKelas($data));
    }

    public function testModel_siswa_3(){
        $model = new Model_siswa();
        //checkAttributes
        $siswa = $model->getData(1001);
        $this->assertObjectHasAttribute('nis', $siswa);
        $this->assertObjectHasAttribute('nama', $siswa);
        $this->assertObjectHasAttribute('jenis_kelamin', $siswa);
        $this->assertObjectHasAttribute('tempat_lahir', $siswa);
        $this->assertObjectHasAttribute('tgl_lahir', $siswa);
        $this->assertObjectHasAttribute('kelas', $siswa);
        $this->assertObjectHasAttribute('password', $siswa);
        $this->assertObjectHasAttribute('nama_ortu', $siswa);
        $kelas = $siswa->getKelas()[0];
        $this->assertObjectHasAttribute('id', $kelas);
        $this->assertObjectHasAttribute('kelas', $kelas);
        $this->assertObjectHasAttribute('jurusan', $kelas);
        $this->assertObjectHasAttribute('no_kelas', $kelas);
        $this->assertObjectHasAttribute('tahun_ajaran', $kelas);
        $this->assertObjectHasAttribute('siswa', $kelas);
        $mod_array = $model->getData();
        $this->assertObjectHasAttribute('nis', $mod_array[0]);
        $this->assertEquals(0, $model->importData('assets/test/coba_siswa.xls'));
        $this->assertEquals(-1, $model->importData('assets/test/coba_file_error.txt'));
        $this->assertGreaterThan(0,$model->importData('assets/test/coba_siswa_error.xls'));
    }

    public function testModel_login() {
        $this->assertTrue(class_exists('Model_login'), 'Login is loadable');
        $model = new Model_login();
        $this->assertStringStartsWith($model->checkUserid(1), 'guru');
        $this->assertStringStartsWith($model->checkUserid(1001), 'user');
        $this->assertStringStartsWith($model->checkUserid(109), 'null');
        //method checkPassword
        $this->assertTrue($model->checkPassword(1, 'zaraki', 'guru'));
        $this->assertTrue($model->checkPassword(1001, '12-12-2000', 'user'));
        $this->assertFalse($model->checkPassword(1, 'foo', 'guru'));
        //method getData
        $this->assertObjectHasAttribute('nip', $model->getData('1','guru'));
        $this->assertObjectHasAttribute('nis', $model->getData('1001','user'));
        $this->assertTrue($model->updatePassword(1, 'qwerty', 'guru'));
    }
    
    public function testModel_login2(){
        $model = new Model_login();
        $model_guru = new Model_guru();
        $model_siswa = new Model_siswa();
        foreach ($model_siswa->getData() as $siswa){
            $this->assertTrue($model->checkPassword($siswa->getNis(), date("d-m-Y", $siswa->getTgl_Lahir()->getTimestamp()), 'user'));
        }
        foreach ($model_guru->getData() as $guru){
            $this->assertTrue($model->checkPassword($guru->getNip(), 'qwerty', 'guru'));
        }
    }
    
    public function testModel_kurikulum() {
        $this->assertTrue(class_exists('Model_guru'), 'guru is loadable');
        $model = new Model_kurikulum();
        $model->truncate([0 => 'kurikulum']);
        $model->reset('2015');
        $data = [
            'no_uh' => 11,
            'kelas' => 'X',
            'semester' => 1,
            'tahun_ajaran' => 2015,
            'juz' => 1,
            'surat_awal' => 'Al Fatihah',
            'ayat_awal' => 1,
            'surat_akhir' => 'Al Baqarah',
            'ayat_akhir' => 15
            ];
        //initial Data
        $model->insertData($data);
        //delete data
        $this->assertTrue($model->deleteData(['id' => 'X-1-11-2015']));
        $this->assertFalse($model->deleteData(['id' => 'X-1-11-2015']));
        //add data
        $this->assertTrue($model->insertData($data));
        $this->assertFalse($model->insertData($data));
        //update data
        $data['ayat_akhir'] = 16;
        $this->assertTrue($model->updateData($data));
    }

    public function testModel_kurikulum_2(){
        $model = new Model_kurikulum();
        //checkAttributes
        $id = 'X-1-11-2015';
        $this->assertObjectHasAttribute('id', $model->getData($id));
        $this->assertObjectHasAttribute('kelas', $model->getData($id));
        $this->assertObjectHasAttribute('semester', $model->getData($id));
        $this->assertObjectHasAttribute('juz', $model->getData($id));
        $this->assertObjectHasAttribute('surat_awal', $model->getData($id));
        $this->assertObjectHasAttribute('ayat_awal', $model->getData($id));
        $this->assertObjectHasAttribute('surat_akhir', $model->getData($id));
        $this->assertObjectHasAttribute('ayat_akhir', $model->getData($id));
        $mod_array = $model->getData();
        $this->assertObjectHasAttribute('id', $mod_array[0]);
    }

    public function testModel_nilai() {
        $this->assertTrue(class_exists('Model_nilai'), 'NIlai is loadable');
        $model = new Model_nilai();
        //deleting data firs
        $model->truncate([0 => 'nilai_harian']);
        //add data
        $data = [
            'no_uh' => 1,
            'kelas' => 'XI',
            'semester' => 1,
            'tahun_ajaran' => 2015,
            'nis' => 1001,
            'tanggal' => '2015-12-12',
            'nilai' => 78,
            'nilai_remidi' => 82,
            'penguji' => 1
            ];
        $this->assertTrue($model->insertData($data));
        $this->assertFalse($model->insertData($data));
        //data exist
        $this->assertTrue($model->dataExist(1,1001, 'XI', 1, 2015));
        //update data
        $data['nilai'] = 78;
        $this->assertTrue($model->updateData($data));
        $data['no_uh'] = 10;
        $this->assertFalse($model->updateData($data));
        //delete data
        $this->assertTrue($model->deleteData(['no_uh' => 1, 'nis' => 1001, 'kelas' => 'XI', 'semester' => 1, 'tahun_ajaran' => 2015]));
        $this->assertFalse($model->deleteData(['no_uh' => 1, 'nis' => 1001, 'kelas' => 'XI', 'semester' => 1, 'tahun_ajaran' => 2015]));  
        //adding data last
        $data['no_uh'] = 1;
        $this->assertTrue($model->insertData($data));
    }

    public function testModel_nilai_2(){
        $model = new Model_nilai();
        //checkAttributes
        $no_uh = 1;
        $nis = 1001;
        $kelas = 'XI';
        $semester = 1;
        $tahun = 2015;
        $nilai1 = $model->getDatabyNis($nis)[0];
        $this->assertObjectHasAttribute('meta', $nilai1);
        $this->assertObjectHasAttribute('no_uh', $nilai1);
        $this->assertObjectHasAttribute('kelas', $nilai1);
        $this->assertObjectHasAttribute('semester', $nilai1);
        $this->assertObjectHasAttribute('siswa', $nilai1);
        $this->assertObjectHasAttribute('tanggal', $nilai1);
        $this->assertObjectHasAttribute('nilai', $nilai1);
        $this->assertObjectHasAttribute('nilai_remidi', $nilai1);
        $this->assertObjectHasAttribute('penguji', $nilai1);
        //===
        $nilai2 = $model->getDataByNo_uh($no_uh)[0];
        $this->assertObjectHasAttribute('meta', $nilai2);
        $this->assertObjectHasAttribute('no_uh', $nilai1);
        $this->assertObjectHasAttribute('kelas', $nilai1);
        $this->assertObjectHasAttribute('semester', $nilai1);
        $this->assertObjectHasAttribute('siswa', $nilai2);
        $this->assertObjectHasAttribute('tanggal', $nilai2);
        $this->assertObjectHasAttribute('nilai', $nilai2);
        $this->assertObjectHasAttribute('nilai_remidi', $nilai2);
        $this->assertObjectHasAttribute('penguji', $nilai2);
        //===
        $nilai3 = $model->getDatabyKelas($kelas)[0];
        $this->assertObjectHasAttribute('meta', $nilai3);
        $this->assertObjectHasAttribute('no_uh', $nilai1);
        $this->assertObjectHasAttribute('kelas', $nilai1);
        $this->assertObjectHasAttribute('semester', $nilai1);
        $this->assertObjectHasAttribute('siswa', $nilai3);
        $this->assertObjectHasAttribute('tanggal', $nilai3);
        $this->assertObjectHasAttribute('nilai', $nilai3);
        $this->assertObjectHasAttribute('nilai_remidi', $nilai3);
        $this->assertObjectHasAttribute('penguji', $nilai3);
        //===
        $nilai4 = $model->getData(['no_uh' => $no_uh, 'nis' => $nis, 'kelas' => $kelas, 'semester' => $semester, 'tahun_ajaran' => $tahun]);
        $this->assertObjectHasAttribute('meta', $nilai4);
        $this->assertObjectHasAttribute('no_uh', $nilai1);
        $this->assertObjectHasAttribute('kelas', $nilai1);
        $this->assertObjectHasAttribute('semester', $nilai1);
        $this->assertObjectHasAttribute('siswa', $nilai4);
        $this->assertObjectHasAttribute('tanggal', $nilai4);
        $this->assertObjectHasAttribute('nilai', $nilai4);
        $this->assertObjectHasAttribute('nilai_remidi', $nilai4);
        $this->assertObjectHasAttribute('penguji', $nilai4);
        $this->assertEquals(0, $model->importData('assets/test/coba_nilai.xls'));
        $this->assertEquals(-1, $model->importData('assets/test/coba_file_error.txt'));
        $this->assertGreaterThan(0,$model->importData('assets/test/coba_nilai_error.xls'));
    }

    public function testModel_sertifikat() {
        $this->assertTrue(class_exists('Model_sertifikat'), 'Sertifikasi is loadable');
        $model = new Model_sertifikat();
        $model->truncate([0 => 'sertifikat']);
        //add data
        $data = [
            'nis' => 1001,
            'nama' => 'user',
            'tgl_ujian' => '2015-12-12',
            'tempat_ujian' => 'SMA IT Ihsanul Fikri Magelang',
            'juz' => 4,
            'nilai' => 89,
            'keterangan' => 'terferifikasi'
            ];
        //delete first
        $this->assertTrue($model->insertData($data));
        $this->assertFalse($model->insertData($data));
        //delete data
        $this->assertTrue($model->deleteData($data));
        $this->assertFalse($model->deleteData($data));
        $model->insertData($data);
        //update data
        $data['tgl_ujian'] = '2015-12-13';
        $this->assertTrue($model->updateData($data));
        $data['nis'] = '1001';
        $data['juz'] = '1';
        $this->assertFalse($model->updateData($data));

    }

    public function testModel_sertifikat_2(){
        $model = new Model_sertifikat();
        //checkAttributes
        $id = '1001-4';
        $nis = 1001;
        $nilai_array = $model->getDataByNis($nis);
        $this->assertObjectHasAttribute('id', $nilai_array[0]);
        $this->assertObjectHasAttribute('siswa', $nilai_array[0]);
        $this->assertObjectHasAttribute('tempat_ujian', $nilai_array[0]);
        $this->assertObjectHasAttribute('tgl_ujian', $nilai_array[0]);
        $this->assertObjectHasAttribute('juz', $nilai_array[0]);
        $this->assertObjectHasAttribute('nilai', $nilai_array[0]);
        $this->assertObjectHasAttribute('keterangan', $nilai_array[0]);
        //==
        $nilai_array = $model->getData($id);
        $this->assertObjectHasAttribute('id', $nilai_array);
        $this->assertObjectHasAttribute('siswa', $nilai_array);
        $this->assertObjectHasAttribute('tempat_ujian', $nilai_array);
        $this->assertObjectHasAttribute('tgl_ujian', $nilai_array);
        $this->assertObjectHasAttribute('juz', $nilai_array);
        $this->assertObjectHasAttribute('nilai', $nilai_array);
        $this->assertObjectHasAttribute('keterangan', $nilai_array);
    }
    
    public function testModel_sertifikasi() {
        $this->assertTrue(class_exists('Model_sertifikasi'), 'Sertifikasi is loadable');
        $model = new Model_sertifikasi();
        $model->truncate([0 => 'sertifikasi']);
        //add data
        $data = [
            'nama' => 'Mukhoyyam sapujagad 1',
            'tahun_ajaran' => '2015',
            'tanggal' => '2015-06-10',
            'kota' => 'magelang',
            'tempat' => 'SMA IT Ihsanul Fikri',
            ];
        //insert first
        $this->assertTrue($model->insertData($data));
        //$this->assertFalse($model->insertData($data));
        $id = $model->getData()[0]->getId();
        //delete data
        $this->assertTrue($model->deleteData(['id' => $id]));
        $this->assertFalse($model->deleteData(['id' => $id]));
        $model->insertData($data);
        //update data
        $data['id'] = $model->getData()[0]->getId();
        $data['tempat'] = 'Masjid Nurul Ashri Yk';
        $this->assertTrue($model->updateData($data));
        $data['id'] = 10002;
        $this->assertFalse($model->updateData($data));
    }
    
    public function testModel_sertifikasi_2(){
        $model = new Model_sertifikasi();
        //checkAttributes
        $id = $model->getData()[0]->getId();
        $s = $model->getData($id);
        $this->assertObjectHasAttribute('id', $s);
        $this->assertObjectHasAttribute('nama', $s);
        $this->assertObjectHasAttribute('tempat', $s);
        $this->assertObjectHasAttribute('tanggal', $s);
        $this->assertObjectHasAttribute('tahun_ajaran', $s);
        $this->assertObjectHasAttribute('kota', $s);
        //==
        $s_array = $model->getData();
        $this->assertObjectHasAttribute('id', $s_array[0]);
        $this->assertObjectHasAttribute('nama', $s_array[0]);
        $this->assertObjectHasAttribute('tempat', $s_array[0]);
        $this->assertObjectHasAttribute('tanggal', $s_array[0]);
        $this->assertObjectHasAttribute('tahun_ajaran', $s_array[0]);
        $this->assertObjectHasAttribute('kota', $s_array[0]);
        
    }
    //Untuk menguji Pengendalian Peserta
    public function testModel_sertifikasi_3() {
        $this->assertTrue(class_exists('Model_sertifikasi'), 'Sertifikasi is loadable');
        $model = new Model_sertifikasi();
        $model->truncate([0 => 'peserta_sertifikasi']);
        $id_sertifikasi = $model->getData()[0]->getId();
        //add data
        $data = [
            'sertifikasi' => $id_sertifikasi,
            'nis' => 1001,
            'juz' => '1',
            'nilai' => '92',
            ];
        //insert first
        $this->assertTrue($model->addPeserta($data));
        //$this->assertFalse($model->insertData($data));
        //delete data
        $id_peserta = $model->getPeserta($id_sertifikasi)[0]->getId();
        $this->assertTrue($model->removePeserta(['id' => $id_peserta]));
        $this->assertFalse($model->removePeserta(['id' => $id_peserta]));
        $model->addPeserta($data);
        //Unset then set it again because doctrine nature block my way... :v
        unset($model);
        $model = new Model_sertifikasi();
        //update data
        $data['id'] = $model->getPeserta($id_sertifikasi)[0]->getId();
        $data['nilai'] = 88;
        $this->assertTrue($model->updatePeserta($data));
        $data['id'] = 10002;
        $this->assertFalse($model->updatePeserta($data));
        //Import Data Peserta
        $this->assertEquals(0, $model->importData('assets/test/coba_sertifikasi.xls'));
        $this->assertEquals(-1, $model->importData('assets/test/coba_file_error.txt'));
        $this->assertGreaterThan(0,$model->importData('assets/test/coba_sertifikasi_error_1.xls'));
        $this->assertGreaterThan(0,$model->importData('assets/test/coba_sertifikasi_error_2.xls'));
        $this->assertGreaterThan(0,$model->importData('assets/test/coba_sertifikasi_error_3.xls'));
    }
    
    public function testModel_sertifikasi_4(){
        $model = new Model_sertifikasi();
        //checkAttributes
        $id_sertifikasi = $model->getData()[0]->getId();
//        $id = $model->getPeserta($id_sertifikasi)[0]->getId();
//        $s = $model->getPeserta($id);
//        $this->assertObjectHasAttribute('id', $s);
//        $this->assertObjectHasAttribute('sertifikasi', $s);
//        $this->assertObjectHasAttribute('siswa', $s);
//        $this->assertObjectHasAttribute('juz', $s);
//        $this->assertObjectHasAttribute('nilai', $s);
//        $this->assertObjectHasAttribute('sertifikat', $s);
        //==
        $s_array = $model->getPeserta($id_sertifikasi);
        $this->assertObjectHasAttribute('id', $s_array[0]);
        $this->assertObjectHasAttribute('sertifikasi', $s_array[0]);
        $this->assertObjectHasAttribute('siswa', $s_array[0]);
        $this->assertObjectHasAttribute('juz', $s_array[0]);
        $this->assertObjectHasAttribute('nilai', $s_array[0]);
        $this->assertObjectHasAttribute('sertifikat', $s_array[0]);
        
    }
    
    public function testModel_sertifikasi_5(){
        $model = new Model_sertifikasi();
        $id_sertifikasi = $model->getData()[0]->getId();
        unset($model);
        $model = new Model_sertifikasi();
        $this->assertFalse($model->generateSertifikat($id_sertifikasi));
        $data_peserta = [
            'sertifikasi' => $id_sertifikasi,
            'id' => $id_sertifikasi.'-1030-2',
            'nilai' => 100,
        ];
        $this->assertTrue($model->updatePeserta($data_peserta));
        unset($model);
        $model = new Model_sertifikasi();
        $this->assertTrue($model->generateSertifikat($id_sertifikasi));
    }
}