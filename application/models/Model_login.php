<?php

/*
 * The MIT License
 *
 * Copyright 2015 s4if.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

/**
 * Description of Model_user
 *
 * @author s4if
 */
class Model_login extends MY_Model{

    public function __construct() {
        parent::__construct();
    }
    
    public function checkUserid($id){
        if(!is_null($this->em->find('GuruEntity', $id))){
            //return level admin (guru)
            return 'guru';
        }else{
            if(!is_null($this->em->find('SiswaEntity', $id))){
                //return level user (siswa)
                return 'user';
            }else{
                //return string 'null' if nothing found
                return 'null';
            }
        }
    }
    
    public function checkPassword($id, $passwd, $position){
        $ent = ($position == 'user')?'Siswa':'Guru';
        $data = $this->em->find(ucfirst($ent).'Entity',$id);
        $stored_passwd =  $data->getPassword();
        return (md5($passwd) === $stored_passwd)? true : false;
    }
    
    public function getData($id, $position){
        $ent = ($position == 'user')?'Siswa':$position;
        return $this->em->find(ucfirst($ent).'Entity',$id);
    }
            
    public function updatePassword($id, $passwd, $position){
        $ent = ($position == 'user')?'Siswa':$position;
        $ent = ($ent == 'admin')?'Guru':$position;
        $data = $this->em->find(ucfirst($ent).'Entity',$id);
        if(!is_null($data)){
            $data->setPassword(md5($passwd));
            $this->em->persist($data);
            $this->em->flush();
            return true;
        } else {
            return false;
        }
    }
    
}
