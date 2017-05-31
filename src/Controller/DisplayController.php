<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use Cake\Auth\DefaultPasswordHasher;

/*

  App::uses('AppModel', 'Model');
  class Users extends AppModel {
  public $username = 'username';
  public $password = 'password';
  }
  class dochazka extends AppModel {
  public $typ = 'typ';
  public $datum = 'datum';
  public $uid = 'uid';
  } */

class DisplayController extends AppController {

    public function index() {
        //Výpis všech zaznamenaných docházek 
        //po kliknutí na uživatele se ukáže výpis jeho docházek 
        $users = TableRegistry::get('users');



        $query = $users->find('all', array('recursive' => -1, 'conditions' => array(
                'dochazka.uid = users.id'
            )
        ));

 
        $options['fields'] = array('dochazka.typ', 'users.username');
        $query = $users->find('all', $options);
    
        $db = ConnectionManager::get("default"); // name of your database connection
        $query = $db->execute("Select dochazka.id,dochazka.typ,users.username,dochazka.datum,dochazka.uid FROM dochazka,users WHERE dochazka.uid=users.id ")->fetchAll('assoc');
        //   $query=$this->AnyModel->query("Select dochazka.typ,users.username,dochazka.datum FROM dochazka,users WHERE dochazka.uid=users.id ");

        $this->set('results', $query);
    }

    public function edit($id) {
        //umožòuje úpravu jednotlivých docházek (datum a typ)
        if ($this->request->is('post')) {
            // $username = $this->request->data('typ');
            $typ = $this->request->data('typ');
            $date = $this->request->data('datum');
            $uid=  $this->request->data('uid');
            $d_table = TableRegistry::get('dochazka');
            $d = $d_table->get($id);
            $d->typ = $typ;
            $d->datum = $date;
            $d->uid=$uid;
         //   var_dump($d);
            if ($d_table->save($d)) {
                echo "upraveno";
            }else{
                 echo "problem";
            }
            return $this->redirect('/dispbyuser/'.$uid);
        
        } else {
            $d_table = TableRegistry::get('dochazka')->find();
            $d = $d_table->where(['id' => $id])->first();
            $this->set('typ', $d->typ);
            $this->set('datum', $d->datum);
            $this->set('id', $id);
             $this->set('uid', $d->uid);
        }
    }
      public function delete($id){
          //mazání docházek
         $users_table = TableRegistry::get('dochazka');
         $users = $users_table->get($id);
         $users_table->delete($users);
         echo "User deleted successfully.";
         $this->setAction('index');
      }

}

?>