<?php
   echo $this->Form->create("dochazka",array('url'=>'/disp/edit/'.$id));
      
    echo $this->Form->create("Users",array('url'=>'/'));
  //  echo  $this->Form->dateTime("datum");
 // echo"<input type='datetime-local' name='datum'/>";
   echo $this->Form->input('datum', array('datum'=>'datetime-local', 'label'=>'datum',"value"=>$datum->format("Y-m-d")."T".$datum->format("H:i:s")));
 //  echo $this->Form->select('typ',['multiple' => true,'value' => ["Pøíchod","Pøestávka","Odchod", "Doktor"]]);
  echo $this->Form->input('typ', array('type'=>'select', 'label'=>'typ', 'options'=>["P"=> "Prichod","R"=> "Prestavka","O"=> "Odchod","D"=>  "Doktor"], 'default'=>$typ));
 echo $this->Form->input('uid', array('type'=>'hidden','options' => array('hiddenField'=> 'true'), 'value'=>$uid )); 

  //echo  $this->Form->select('typ',    ["P"=> "Prichod","R"=> "Prestavka","O"=> "Odchod","D"=>  "Doktor"], 'default' => $typ );
   echo $this->Form->button('Submit');
   echo $this->Form->end();
?>