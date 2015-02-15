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
            $this->assertTrue(class_exists('Model_login'), 'Login is loadable');
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
                'password' => md5('qwerty')
                ];
            $this->assertTrue($model->insertData($data));
            $this->assertFalse($model->insertData($data));
            //update data
            $this->assertTrue($model->updateData($data));
            $data['nip'] = 4321;
            $this->assertFalse($model->updateData($data));
            //checkAttributes
            $this->assertObjectHasAttribute('nip', $model->getData(1));
            $this->assertObjectHasAttribute('nama', $model->getData(1));
            $this->assertObjectHasAttribute('jenis_kelamin', $model->getData(1));
            $this->assertObjectHasAttribute('alamat', $model->getData(1));
            $this->assertObjectHasAttribute('email', $model->getData(1));
            $this->assertObjectHasAttribute('password', $model->getData(1));
            $mod_array = $model->getData();
            $this->assertObjectHasAttribute('nip', $mod_array[0]);
        }
        
        public function testModel_login() {
            $this->assertTrue(class_exists('Model_login'), 'Login is loadable');
            $model = new Model_login();
            $this->assertStringStartsWith($model->checkUserid(1), 'admin');
            $this->assertStringStartsWith($model->checkUserid(1001), 'user');
            $this->assertStringStartsWith($model->checkUserid(109), 'null');
            //method checkPassword
            $this->assertTrue($model->checkPassword(1, 'qwerty', 'admin'));
            $this->assertTrue($model->checkPassword(1001, 'qwerty', 'user'));
            $this->assertFalse($model->checkPassword(1, 'foo', 'user'));
            //method getData
            $this->assertObjectHasAttribute('nip', $model->getData('1','admin'));
            $this->assertObjectHasAttribute('nis', $model->getData('1001','user'));
            $this->assertTrue($model->updatePassword(1, 'qwerty', 'admin'));
        }
}