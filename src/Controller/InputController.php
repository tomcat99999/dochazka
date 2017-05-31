<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use Cake\Auth\DefaultPasswordHasher;

class InputController extends AppController {

    public function index() { 
//Џvodnн strбnka sem se zadб typ dochбzky Pшнchod Odchod Pшestбvka Doktor
//UЮivatel se urин podle loginu a иas se vezme momentбlnн 
        if ($this->request->is('post')) {
            $typ = $this->request->data('typ');
        //    $datum = $this->request->data('cas');
            $d_table = TableRegistry::get('dochazka');
            $dochazka = $d_table->newEntity();
            $dochazka->typ = $typ;
            $dochazka->datum = date("Y-m-d H:i:s");
           // var_dump($this->Auth->user('id'));
            $dochazka->uid = $this->Auth->user('id');
            if ($d_table->save($dochazka)) {
                echo "Pridano";
            }
        }
    }

  
}

?>