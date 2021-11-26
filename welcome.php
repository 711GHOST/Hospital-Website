<?php 

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: multi.php");
	
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
	<style>
		table,tr,th,td
		{
			border: 2px solid black;
			border-collapse: collapse;
		}
		th
		{
			background-color: #00e1ff;
			font-family: sans-serif;
			text-align: center;
		}
		tr
		{
			background-color: #d9d6c7;
			font-family: sans-serif;
			text-align: center;
		}
		tr:hover
		{
			background-color: #00ff8c;
			color: brown;
		}
	</style>
</head>

<body>
    <?php echo "<h1>Welcome " . $_SESSION['username'] . "</h1>"; ?>
	<p><br><br></p>
	<table>
		<?php
			include 'db_conn.php';
			$appointment = $conn->query("SELECT * FROM appointment order by Slot_Time asc");
			$i=1;
			while($row = $appointment->fetch_assoc()):
		?>
			<tr>
				<th>  Index  </th>
				<th>  Name of Patient  </th>
				<th>  Phone Number </th>
				<th>  Email Address </th>
				<th>  Appointment Time </th>
				<th>  Message Given </th>
			</tr>
			<tr>
				<td> <?php echo $i++ ?> </td>
				<td> <?php echo $row['Full_Name'] ?> </td>
				<td> <?php echo $row['Phone_Number'] ?> </td>
				<td> <?php echo $row['Email'] ?> </td>
				<td> <?php echo $row['Slot_Time'] ?> </td>
				<td> <?php echo $row['Message'] ?> </td>
			</tr>
		<?php endwhile; ?>
	<table>
	<p><br><br></p>
    <a href="logout.php">Logout</a>
	
</body>
</html>