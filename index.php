<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'master');

$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
// $title = $content ="";
// $title_error = $content_error ="";

if($_SERVER["REQUEST_METHOD"] == "POST"){
  if(empty(trim($_POST["username"]))){
     $username_error = "Please enter a username";
 } else{
     $username = trim($_POST["username"]);
 }
  if(empty(trim($_POST["titles"]))){
     $titles_error = "Please enter a title";
 } else{
     $titles= trim($_POST["titles"]);
 }
 if(empty(trim($_POST["description"]))){
    $description_error = "Please enter a description ";
} else{
    $description = trim($_POST["description"]);
}

if(empty(trim($_POST["topics"]))){
     $topics_error = "Please enter a topic";
 } else{
     $topics = trim($_POST["topics"]);
 }
 
if(empty($username_error) && empty($titles_error)){

       // Prepare an insert statement
       $sql = "INSERT INTO title (username,titles,description,topics) VALUES (?, ?,?,?)";

       if($stmt = mysqli_prepare($link, $sql)){
           // Bind variables to the prepared statement as parameters
           mysqli_stmt_bind_param($stmt, "ssss", $param_username, $param_titles,$param_description,$param_topics);

           // Set parameters
           $param_username=$username;
           $param_titles = $titles;
           $param_description = $description;
           $param_topics=$topics;

           // Attempt to execute the prepared statement
           if(mysqli_stmt_execute($stmt)){
               // Redirect to login page
               // header("location: login.php");
               
           } else{
               echo "Something went wrong. Please try again later.";
           }
       }

       // Close statement
       mysqli_stmt_close($stmt);
   }

   // Close connection
   mysqli_close($link);


}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
   <div class="input-group">
      <label>Username</label>
      <input type="text" name="username" >
    </div>
    <div class="input-group">
      <label>Title</label>
      <input type="text" name="titles" >
    </div>
    <div class="input-group">
      <label>Description</label>
      <input type="text area" name="description" rows="5"cols="75">
    </div>
    <div class="input-group">
      <label>Topics</label>
      <input type="text" name="topics">
    </div>
    <div class="input-group">
      <button type="save" class="btn" name="reg_user">SAVE</button>
    </div>
     </form>
</div>


</body>
</html>
