<!DOCTYPE html>
<html>

<head>
	<title>PHP Website</title>
	 <link rel="stylesheet" href="style.css">
</head>
<body>
	<header>
		<h1>To Do List</h1>
	</header>
<?php //Add task
//Check to see if there is a value stored in task
if(!empty($_POST["task"])) 
{
  $con = mysqli_connect("localhost", "root", "", "todolist"); //Establish connection to database
  $task = $_POST["task"];
  $sql = "INSERT INTO tasks (task) VALUES ('$task')"; //Insert task to table
  $con->query($sql);
  mysqli_close($con); //Close connection
}
?>

<?php //Delete task
//Check to see if there is a value stored in id
if(!empty($_POST["id"])) 
{
  $con = mysqli_connect("localhost", "root", "", "todolist"); //Establish connection to database
  $id = $_POST["id"];
  $sql = "DELETE FROM tasks WHERE id='$id'"; //Delete task from table based on unique autoincrement id
  $con->query($sql);
  mysqli_close($con); //Close connection
}
?>

<?php //View task
  $con = mysqli_connect("localhost", "root", "", "todolist");
  $sql= "SELECT * FROM tasks"; //View tasks stored in table
  $result = $con->query($sql);
  if ($result->num_rows>0) //If table not empty
  {
	  while($row = $result->fetch_assoc()) //Iterate through each element in table
	  {
	  echo "<li>".$row["task"]."</li>"; //Unordered list for each task
	  $id = $row["id"];
	  ?> 
	  <form action="/" method="post">
	  <input type="hidden" name= "id" value="<?php echo $id ?>"><input type="submit" value="Delete">
	  </form>
	  <?php //Created delete buttons for each element based on their unique id
	  }
  }
  
  mysqli_close($con); //Close connection
?>

	<form action="/" method="post">
	<input type="text" name="task">
	<input type="submit" value="Add Task">
	</form>
	
	<footer>
	</footer>
</body>



</html>