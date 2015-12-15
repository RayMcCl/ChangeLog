<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Change Log</title>
<style>
.TwoColumn1{
	width:calc(75% - 16px);
	position:absolute;
	left:0px;
	padding:8px;
	top:0px;
	overflow:hidden;
	border-right:#000000 thin solid;
}

.TwoColumn2{
	width:calc(25% - 8px);
	position:absolute;
	left:75%;
	padding:8px;
	top:0px;
	overflow:hidden;
}

textarea{
	resize:vertical;	
}
</style>
</head>
<body>
<div class="TwoColumn1">
<h1 style="text-align:center">
Change Log :
</h1>
<?
require_once 'config.php';

if(isset($_POST['submit'])){
	if(!empty($_POST['log'])){
		$log = $_POST['log'];
		$insert = $conn->prepare("INSERT INTO ChangeLog(log) VALUES (?)");
		$insert->bindParam(1, $log);
		$insert->execute();
	}
}

$sql = "SELECT * FROM ChangeLog ORDER BY date ASC";
$query = $conn->query($sql);
while($row = $query->fetch(PDO::FETCH_ASSOC))
{
	echo '<b style="text-decoration:underline">'.$row['date']."<br><br></b>";
	echo "".nl2br(strip_tags($row['log']))."<br>";
	echo "<br>";
}
?>
<form name="main" method="post">
<h3 style="text-align:center">
Log :<br></h3>
<textarea style="width:calc(100% - 8px)" id="log" name="log" cols="40" rows="10"></textarea><br>
<input type="submit" name="submit" value="Submit" style="width:100%;height:30px"/>
</form>
</div>
<div class="TwoColumn2">
<h1 style="text-align:center">
To-Do List :
</h1>
<?
require_once 'config.php';

if(isset($_POST['submit2'])){
	if(!empty($_POST['task'])){
		$task = $_POST['task'];
		$insert = $conn->prepare("INSERT INTO ToDoList(task) VALUES (?)");
		$insert->bindParam(1, $task);
		$insert->execute();
	}
}

if(isset($_POST['which_clicked'])){
	$id = intval($_POST ['which_clicked']);
	$delete = $conn->prepare("DELETE FROM `ToDoList` WHERE `ToDoList`.`id` = $id");
	$delete->execute();
}

$sql = "SELECT * FROM ToDoList ORDER BY date ASC";
$query = $conn->query($sql);
while($row = $query->fetch(PDO::FETCH_ASSOC))
{
	echo "<form name='form'".$row['id']." method='post'>";
	echo "<input type='hidden' name='which_clicked' value='".$row['id']."'>";
	echo "<input type='submit' name='submit' value='-'/> ";
	echo "".nl2br(strip_tags($row['task']))."<br>";
	echo "</form>";
}
?>
<form name="main" method="post">
<h3 style="text-align:center">
Add Task :<br></h3>
<textarea style="width:calc(100% - 8px)" id="task" name="task" cols="40" rows="10"></textarea><br>
<input type="submit" name="submit2" value="Submit" style="width:100%;height:30px"/>
</form>
</div>
</body>
</html>
