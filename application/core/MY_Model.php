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
 * Description of MY_Model
 *
 * @author s4if
 */

use Doctrine\ORM\Tools\Setup;

class MY_Model extends CI_Model {
    
    protected $em;
    
    public function __construct() {
        parent::__construct();
        //Adding Doctrine
        // Create a simple "default" Doctrine ORM configuration for XML Mapping
        $isDevMode = true;
        $config = Setup::createAnnotationMetadataConfiguration(array(FCPATH."application/entities"), $isDevMode, FCPATH."data/proxyData");

        // database configuration parameters
        $conn = array(
            'driver' => 'pdo_sqlite',
            'path' => FCPATH . '/db.sqlite',
        );

        // obtaining the entity manager
        $this->em = \Doctrine\ORM\EntityManager::create($conn, $config);
    }
    
    public function truncate($tableNames, $cascade = false){
        $connection = $this->em->getConnection();
        $platform = $connection->getDatabasePlatform();
        //MUSTBE Enabled if i wanna use MYSQL
        //$connection->executeQuery('SET FOREIGN_KEY_CHECKS = 0;');
        foreach ($tableNames as $name) {
            $connection->executeUpdate($platform->getTruncateTableSQL($name,$cascade));
        }
        //$connection->executeQuery('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
