<?php
   echo $this->Form->create("Users",array('url'=>'/'));
 //  echo $this->Form->select('typ',['multiple' => true,'value' => ["P��chod","P�est�vka","Odchod", "Doktor"]]);
  echo  $this->Form->select('typ',    ["P"=> "Prichod","R"=> "Prestavka","O"=> "Odchod","D"=>  "Doktor"]);
   echo $this->Form->button('Submit');
   echo $this->Form->end();
?>