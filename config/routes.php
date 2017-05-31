<?php
   use Cake\Core\Plugin;
   use Cake\Routing\RouteBuilder;
   use Cake\Routing\Router;

   Router::defaultRouteClass('DashedRoute');
   Router::scope('/', function (RouteBuilder $routes) {
       //$routes->connect('/', ['controller' => 'Input', 'action'=>'index'],['pass' =>['arg1', 'arg2']]);
        $routes->connect('/',['controller'=>'Input','action'=>'index']);
       $routes->connect('/disp',['controller'=>'Display','action'=>'index']);
          $routes->connect('/disp/delete/:arg1', ['controller' => 'Display', 'action' => 'delete'],['pass' => ['arg1']]);
        $routes->connect('/disp/edit/:arg1', ['controller' => 'Display', 'action' => 'edit'],['pass' => ['arg1']]);
        $routes->connect('/dispbyuser/:arg1',['controller'=>'DisplayUser','action'=>'index'],['pass' => ['arg1']]);
       $routes->connect('/auth',['controller'=>'Authexs','action'=>'index']);
      $routes->connect('/login',['controller'=>'Authexs','action'=>'login']);
      $routes->connect('/logout',['controller'=>'Authexs','action'=>'logout']);
        $routes->connect('/users', ['controller' => 'Users', 'action' => 'index']);
       $routes->connect('/users/add', ['controller' => 'Users', 'action' => 'add']);
       $routes->connect('/users/delete/:arg1', ['controller' => 'Users', 'action' => 'delete'],['pass' => ['arg1']]);
        $routes->connect('/users/edit/:arg1', ['controller' => 'Users', 'action' => 'edit'],['pass' => ['arg1']]);

   });
   

   Plugin::routes();