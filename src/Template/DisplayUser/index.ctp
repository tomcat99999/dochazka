
<?php

echo '<h1>'.$results[0]["username"]."</h1>";


    echo $this->Form->create("Users",array('url'=>'/dispbyuser/'.$results[0]["uid"]));

   echo $this->Form->input('OD', array('type'=>'datetime-local', 'label'=>'OD',"value"=>$datumOd));
     echo $this->Form->input('DO', array('type'=>'datetime-local', 'label'=>'DO',"value"=>$datumDo));

   echo $this->Form->button('Submit');
   echo $this->Form->end();
   
   echo "<p>Odpracovano: ".$odpracovano."H </p>";
   if($in){
       echo "<p>Pøítomen</p>";
   }else{
        echo "<p>Nepøítomen</p>";
   }
   echo "<p>Chyby:</br> ".$chyba." </p>";
?>
<table>
    
   <tr>
      
     
      <td>Typ</td>
      <td>Datum</td>
      <td>Edit</td>
      <td>Delete</td>
   </tr>

   <?php
   
      foreach ($results as $row):
  
         echo "<td>".$row["typ"]."</td>";
         echo "<td>".$row["datum"]."</td>";
         echo "<td><a href = '".$this->Url->build
         (["controller" => "Display","action"=>"edit",$row["id"]])."'>Edit</a></td>";
         
         echo "<td><a href = '".$this->Url->build
         (["controller" => "Display","action"=> "delete",$row["id"]])."'>Delete</a></td></tr>";
      endforeach;
   ?>
</table>