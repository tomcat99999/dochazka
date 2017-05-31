
<table>
   <tr>
      
      <td>Username</td>
      <td>Typ</td>
      <td>Datum</td>
    <!--  <td>Edit</td>
      <td>Delete</td>-->
   </tr>

   <?php
   
      foreach ($results as $row):
       //   var_dump($row);
         echo "<tr>";
     // echo "<td>".$row["username"]."</td>";
         echo "<td><a href = '".$this->Url->build
         (["controller" => "DisplayUser","action"=>"index",$row["uid"]])."'>".$row["username"]."</a></td>";
         echo "<td>".$row["typ"]."</td>";
         echo "<td>".$row["datum"]."</td>";
     /*    echo "<td><a href = '".$this->Url->build
         (["controller" => "Display","action"=>"edit",$row["id"]])."'>Edit</a></td>";
         
         echo "<td><a href = '".$this->Url->build
         (["controller" => "Display","action"=> "delete",$row["id"]])."'>Delete</a></td></tr>";*/
      endforeach;
   ?>
</table>