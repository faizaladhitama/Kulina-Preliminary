
<?php
 
header('Content-type:application/json;charset=utf-8');

// get the HTTP method, path and body of the request
$method = $_SERVER['REQUEST_METHOD'];

// connect to the mysql database
$link = mysqli_connect('127.0.0.1', 'root', 'root', 'myDB');
mysqli_set_charset($link,'utf8');
 
// retrieve the table and key from the path
$table = 'user_review';

$status = "FAIL";
$temp_arr=NULL;

if($method == "GET"){
  $sql = "SELECT * FROM $table";
  if(count($_GET) > 0){
    $sql .= " WHERE";
    $ind = 0;
    foreach ($_GET as $key => $value) {
      $sql .= " $key=$value";
      if($ind < count($_GET)-1){
        $sql .= " AND";
      }
      $ind++;
    }
  }
} elseif ($method == "POST"){
  $post_method = $_POST['method'];
  switch ($post_method) {
    case 'DELETE':
      $id = $_POST['id'];
      $sql = "DELETE * FROM $table WHERE id=$id";
      break;
    case 'INSERT':
      $order_id = $_POST['order_id'];
      $product_id = $_POST['product_id'];
      $user_id = $_POST['user_id'];
      $rating = (int) $_POST['rating'];
      $review = $_POST['review'];
      $sql = "INSERT INTO user_review (order_id,product_id,user_id,rating,review) VALUES ($order_id,$product_id,$user_id,$rating,$review)";
      break;
    case 'UPDATE':
      $id = $_POST['id'];
      $sql = "UPDATE $table";
      if(count($_POST) > 1){
        $sql .= " SET";
        $ind = 0;
        foreach ($_POST as $key => $value) {
          if($key != "id"){
            $sql .= " $key=$value";
            if($ind < count($_GET)-1){
              $sql .= " AND";
            }
          }
          $ind++;
        }
      }
      $sql .= " WHERE id=$id";
      break;
    default:
      break;
  }
}else{

}

// excecute SQL statement
$result = mysqli_query($link,$sql);
 
// die if SQL statement failed
if (!$result) {
  http_response_code(404);
  die(mysqli_error());
}

$temp_arr = [];
// print results, insert id or affected row count
if ($method == 'GET') {
  $status = "SUCCESS";
  if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
      array_push($temp_arr, $row);
    }
  }else{
    $temp_arr = NULL;
  }
}elseif ($method == "POST"){
  $post_method = $_POST['method'];
  switch ($post_method) {
    case 'DELETE':
      if($result){
        $status = "SUCCESS";
        $temp_arr = "DELETE SUCCESS";
      }
      break;
    case 'INSERT':
      if($result){
        $status = "SUCCESS";
        $temp_arr = "INSERT SUCCESS"; 
      }
      break;
    case 'UPDATE':
      if($result){
        $status = "SUCCESS";
        $temp_arr = "UPDATE SUCCESS";         
      }
      break;
    default:
      break;
  }
}
 
// close mysql connection
mysqli_close($link);

$ret = array('status' => $status, 'data' => $temp_arr);
echo json_encode($ret);