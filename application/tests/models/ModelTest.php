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
            //delete data
            $this->assertTrue($model->deleteData(['nip' => 1]));
            $this->assertFalse($model->deleteData(['nip' => 1]));
            //add data
            $data = [
                'nip' => 1,
                'nama' => 'admin',
                'jenis_kelamin' => 'L',
                'alamat' => 'foo city',
                'email' => 'foo@google.com',
                'no_telp' => '08674839291',
                'password' => md5('qwerty'),
                ];
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
        
        public function testModel_login() {
            $this->assertTrue(class_exists('Model_login'), 'Login is loadable');
            $model = new Model_login();
            $this->assertStringStartsWith($model->checkUserid(1), 'guru');
            $this->assertStringStartsWith($model->checkUserid(1001), 'user');
            $this->assertStringStartsWith($model->checkUserid(109), 'null');
            //method checkPassword
            $this->assertTrue($model->checkPassword(1, 'qwerty', 'guru'));
            $this->assertTrue($model->checkPassword(1001, 'qwerty', 'user'));
            $this->assertFalse($model->checkPassword(1, 'foo', 'user'));
            //method getData
            $this->assertObjectHasAttribute('nip', $model->getData('1','guru'));
            $this->assertObjectHasAttribute('nis', $model->getData('1001','user'));
            $this->assertTrue($model->updatePassword(1, 'qwerty', 'guru'));
        }
        
        public function testModel_siswa() {
            $this->assertTrue(class_exists('Model_siswa'), 'Siswa is loadable');
            $model = new Model_siswa();
            //delete data
            $this->assertTrue($model->deleteData(['nis' => 1001]));
            $this->assertFalse($model->deleteData(['nis' => 1001]));
            //add data
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
                'password' => md5('qwerty'),
                'nama_ortu' => 'ortu'
                ];
            $this->assertTrue($model->insertData($data));
            $this->assertFalse($model->insertData($data));
            //update data
            $data['no_kelas'] = '2';
            $this->assertTrue($model->updateData($data));
            $data['nis'] = 4321;
            $this->assertFalse($model->updateData($data));
            
        }
        
        public function testModel_siswa_2(){
            $model = new Model_siswa();
            //checkAttributes
            $siswa = $model->getData(1001);
            $this->assertObjectHasAttribute('nis', $siswa);
            $this->assertObjectHasAttribute('nama', $siswa);
            $this->assertObjectHasAttribute('jenis_kelamin', $siswa);
            $this->assertObjectHasAttribute('tempat_lahir', $siswa);
            $this->assertObjectHasAttribute('tgl_lahir', $siswa);
            $this->assertObjectHasAttribute('kelas', $siswa);
            $this->assertObjectHasAttribute('jurusan', $siswa);
            $this->assertObjectHasAttribute('no_kelas', $siswa);
            $this->assertObjectHasAttribute('password', $siswa);
            $this->assertObjectHasAttribute('nama_ortu', $siswa);
            $mod_array = $model->getData();
            $this->assertObjectHasAttribute('nis', $mod_array[0]);
            $mod_array1 = $model->getFilteredData(['kelas' => 'XI',
                'jurusan' => 'IPS',
                'no_kelas' => '2']);
            $this->assertObjectHasAttribute('nis', $mod_array1[0]);
            $mod_array2 = $model->getFilteredData(['kelas' => 'XI',
                'jurusan' => 'IPS',
                'no_kelas' => '100']);
            $this->assertEmpty($mod_array2);
            $this->assertEquals(0, $model->importData('assets/test/coba_siswa.xls'));
            $this->assertEquals(-1, $model->importData('assets/test/coba_file_error.txt'));
            $this->assertGreaterThan(0,$model->importData('assets/test/coba_siswa_error.xls'));
        }
        
        public function testModel_nilai() {
            $this->assertTrue(class_exists('Model_nilai'), 'NIlai is loadable');
            $model = new Model_nilai();
            //add data
            $data = [
                'no_uh' => 1,
                'kelas' => 'XI',
                'nis' => 1001,
                'tanggal' => '2015-12-12',
                'juz' => 4,
                'halaman' => 4,
                'nilai' => 89,
                'penguji' => 1
                ];
            $this->assertTrue($model->insertData($data));
            $this->assertFalse($model->insertData($data));
            //data exist
            $this->assertTrue($model->dataExist(1,1001, 'XI'));
            //delete data
            $this->assertTrue($model->deleteData(['no_uh' => 1, 'nis' => 1001, 'kelas' => 'XI']));
            $this->assertFalse($model->deleteData(['no_uh' => 1, 'nis' => 1001, 'kelas' => 'XI']));
            $model->insertData($data);
            //update data
            $data['nilai'] = 78;
            $this->assertTrue($model->updateData($data));
            $data['no_uh'] = 10;
            $this->assertFalse($model->updateData($data));
            
        }
        
        public function testModel_nilai_2(){
            $model = new Model_nilai();
            //checkAttributes
            $no_uh = 1;
            $nis = 1001;
            $kelas = 'XI';
            for($i = 0; $i <=4; $i++){
                if ($i === 0) {
                    $nilai = $model->getDatabyNis($nis)[0];
                }elseif ($i === 1){
                    $nilai = $model->getDatabyId($no_uh)[0];
                }elseif ($i === 2){
                    $nilai = $model->getDatabyKelas($kelas)[0];
                }elseif ($i === 3){
                    $nilai = $model->getData(['no_uh' => $no_uh, 'nis' => $nis, 'kelas' => $kelas])[0];
                }else{
                    $nilai_arr = $model->getNilaiSiswa();
                    $nilai = $nilai_arr['1001']['1'];
                    $nilai2 = empty($nilai_arr['1001'][10])?null:'not empty';
                    $this->assertNull($nilai2);
                }
                $this->assertObjectHasAttribute('no_uh', $nilai);
                $this->assertObjectHasAttribute('nis', $nilai);
                $this->assertObjectHasAttribute('tanggal', $nilai);
                $this->assertObjectHasAttribute('juz', $nilai);
                $this->assertObjectHasAttribute('halaman', $nilai);
                $this->assertObjectHasAttribute('nilai', $nilai);
                $this->assertObjectHasAttribute('penguji', $nilai);
            }
        }
        
        public function testModel_sertifikasi() {
            $this->assertTrue(class_exists('Model_sertifikasi'), 'Sertifikasi is loadable');
            $model = new Model_sertifikasi();
            //add data
            $data = [
                'id' => 12345,
                'nis' => 1001,
                'nama' => 'user',
                'tgl_ujian' => '2015-12-12',
                'tempat_ujian' => 'SMA IT Ihsanul Fikri Magelang',
                'juz' => 4,
                'nilai' => 89,
                'predikat' => 'Jayyid Jiddan',
                'keterangan' => 'terferifikasi'
                ];
            $this->assertTrue($model->insertData($data));
            $this->assertFalse($model->insertData($data));
            //delete data
            $this->assertTrue($model->deleteData(['id' => 12345]));
            $this->assertFalse($model->deleteData(['id' => 12345]));
            $model->insertData($data);
            //update data
            $data['tgl_ujian'] = '2014-12-12';
            $this->assertTrue($model->updateData($data));
            $data['id'] = 10002;
            $this->assertFalse($model->updateData($data));
            
        }
        
        public function testModel_sertifikasi_2(){
            $model = new Model_sertifikasi();
            //checkAttributes
            $id = 12345;
            $nis = 1001;
            for($i = 0; $i <=1; $i++){
                if ($i === 0) {
                    $nilai_array = $model->getDatabyNis($nis);
                }else{
                    $nilai_array = $model->getDatabyId($id);
                }
                $this->assertObjectHasAttribute('id', $nilai_array[0]);
                $this->assertObjectHasAttribute('nis', $nilai_array[0]);
                $this->assertObjectHasAttribute('nama', $nilai_array[0]);
                $this->assertObjectHasAttribute('tempat_ujian', $nilai_array[0]);
                $this->assertObjectHasAttribute('tgl_ujian', $nilai_array[0]);
                $this->assertObjectHasAttribute('juz', $nilai_array[0]);
                $this->assertObjectHasAttribute('nilai', $nilai_array[0]);
                $this->assertObjectHasAttribute('predikat', $nilai_array[0]);
                $this->assertObjectHasAttribute('keterangan', $nilai_array[0]);
            }
        }
}