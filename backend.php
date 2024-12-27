<?php

if(isset($_POST['limit_no'])){
    $limit = $_POST['limit_no'];
}
else{
    $limit = 2;
}

$str="";

if(isset($_POST['search_str'])){
    $str=$_POST['search_str'];
}
else{
    $str="";
}
$con = new mysqli("localhost", "root", "", "karan") or die("connection fail");


$sql1 = "select * from kiran where Name like '%{$str}%' ";

$result1 = $con->query($sql1);
$total_records = $result1->num_rows;

$total_pno = ceil( $total_records / $limit);



$page = "";
if (isset($_POST['page_no'])) {
    $page = $_POST['page_no'];
} else {
    $page = 1;
}

$output = "";

if ($total_records > 0) {

    $output .= "<div class='pagination'>";
    for ($i = 1; $i <= $total_pno; $i++) {
        if($i == $page){
            $class_val = "active";
        }
        else{
            $class_val = "";
        }
        $output .= "<li id='{$i}' class='{$class_val}'>{$i}</li>";
    }

    $output .= "</div>";
}


$offset = ($page - 1) * $limit;

$sql = "select * from kiran  where Name like '%{$str}%'  limit {$offset} , {$limit}";


$result = $con->query($sql);

$output .= "<table class='table'>
<thead>
  <tr>
    <th scope='col'>SNO.</th>
    <th scope='col'>Id</th>
    <th scope='col'>Name</th>
    <th scope='col'>Address</th>
    <th scope='col'>Mobile number</th>
    <th scope='col'>City</th>
  </tr>
</thead >";

if ($result->num_rows > 0) {
    $offset += 1;
    while ($row = $result->fetch_assoc()) {
        $output .= " <tr>
      <th scope='row'>{$offset}</th>
      <th scope='row'>{$row['id']}</th>
      <td>{$row['Name']}</td>
      <td>{$row['Address']}</td>
      <td>{$row['Mobile_number']}</td>
      <td>{$row['City']}</td>
      </tr>";
      $offset++;
    }

    $output .= "</table>";
    echo $output;
}
else{
    echo "<h2>No record found</h2>";
}
