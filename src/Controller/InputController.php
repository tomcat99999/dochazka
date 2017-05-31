<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use Cake\Auth\DefaultPasswordHasher;

class InputController extends AppController {

    public function index() { 
//�vodn� str�nka sem se zad� typ doch�zky P��chod Odchod P�est�vka Doktor
//U�ivatel se ur�� podle loginu a �as se vezme moment�ln� 
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