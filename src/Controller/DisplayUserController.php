<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use Cake\Auth\DefaultPasswordHasher;



class DisplayUserController extends AppController {

    public function index($id) {
        //zobrazení docházek pro jednotlivého uživatele
     /*   $users = TableRegistry::get('users');



        $query = $users->find('all', array('recursive' => -1, 'conditions' => array(
                'dochazka.uid = users.id'
            )
        ));

        $options['fields'] = array('dochazka.typ', 'users.username');
        $query = $users->find('all', $options);*/

        
        
        //urèení rozsahu zobrazených docházek
        if ($this->request->is('post')) {
  
            var_dump($this->request->data());
            $datumOd = $this->request->data('OD');
            $datumDo = $this->request->data('DO');
        } else {

// First day of the month.
            $datumOd = date('Y-m-01') . "T00:00:00";

// Last day of the month.
            $datumDo = date('Y-m-t') . "T23:59:59";
            ;
        }
        $db = ConnectionManager::get("default"); // name of your database connection
     
        $result = $db->newQuery()
                ->select('dochazka.id,dochazka.uid,dochazka.typ,users.username,dochazka.datum ')
                ->from('dochazka,users')
                ->where('dochazka.uid=users.id  ')
                ->andWhere(['dochazka.datum >' => $datumOd])
                ->andWhere(['dochazka.datum <' => $datumDo])
                ->order(['dochazka.datum' => 'ASC'])
                ->execute()
                ->fetchAll('assoc');

        $cas = 0;
        $chyba = "";
        $in = false;
        $date = null;
        //výpoèet odpracované doby a vyhledává chyby v docházkách (dva odchody za sebou apod.)
        foreach ($result as $row) {
            $typ = $row["typ"];
            if ($typ == "P") {
                if ($in) {
                    $chyba.="Chyba: typ: " . $typ . " Datum: " . $row["datum"] . "<br/>";
                } else {
                    $in = true;
                    $date = $row["datum"];
                }
            } else {
                if ($in) {
                    $in = false;
                    $date1 = new \DateTime($date);
                    $date2 = new \DateTime($row["datum"]);
                
                    $diff = $date2->diff($date1);
                
                    $hours = $diff->h;
                    $hours = $hours + ($diff->days * 24) + ($diff->m / 60);
                    if ($hours > 12) {
                        $chyba.="Chyba: Pracovník pracoval více než 12H od" . $date . " do " . $row["datum"] . "<br/>";
                    }
                    $cas+=$hours;
                } else {
                    $chyba.="Chyba: typ: " . $typ . " Datum: " . $row["datum"] . "<br/>";
                }
            }
        }
        $this->set('chyba', $chyba);
        $this->set('odpracovano', $cas);
        $this->set('in', $in);
        $this->set('datumOd', $datumOd);
        $this->set('datumDo', $datumDo);
        $this->set('results', $result);
    }
/*
    public function edit($id) {

        if ($this->request->is('post')) {
           
            $typ = $this->request->data('typ');
            $date = $this->request->data('datum');

            $d_table = TableRegistry::get('dochazka');
            $d = $d_table->get($id);
            $d->typ = $typ;
            $d->datum = $date;

            if ($users_table->save($users)) {
                echo "User is udpated";
            }
            $this->setAction('index');
        } else {
            $d_table = TableRegistry::get('dochazka')->find();
            $d = $d_table->where(['id' => $id])->first();
            $this->set('typ', $d->typ);
            $this->set('datum', $d->datum);
            $this->set('id', $id);
        }
    }*/

}

?>