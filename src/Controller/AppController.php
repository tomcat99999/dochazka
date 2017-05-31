<?php
   namespace App\Controller;
   use Cake\Controller\Controller;
   use Cake\Event\Event;
   use Cake\Controller\Component\AuthComponent;

   class AppController extends Controller{
      public function initialize(){
         parent::initialize();
         
         $this->loadComponent('RequestHandler');
         $this->loadComponent('Flash');
         $this->loadComponent('Auth', [
            'authenticate' => [
               'Form' => [
                  'fields' => ['username' => 'username', 'password' => 'password']
               ]
            ],
            'loginAction' => ['controller' => 'Authexs', 'action' => 'login'],
            'loginRedirect' => ['controller' => 'Authexs', 'action' => 'index'],
            'logoutRedirect' => ['controller' => 'Authexs', 'action' => 'login']
         ]);
      
         $this->Auth->config('authenticate', [
            AuthComponent::ALL => ['userModel' => 'users'], 'Form']);
      }
   
      public function beforeRender(Event $event){
         if (!array_key_exists('_serialize', $this->viewVars) && in_array($this->response->type(), ['application/json', 'application/xml'])) {
            $this->set('_serialize', true);
         }
      }
   }