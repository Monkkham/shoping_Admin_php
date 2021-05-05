<?php 
	
	session_start();

	include('server.php');

	if ($_SESSION["userid"] == "") {
		header("location: index.php");
		exit();
	}

	if ($_SESSION["status"] != "admin") {
		echo "This page for admin only!";
		exit();
	}

	$sql = "SELECT * FROM admin WHERE id = '".$_SESSION['userid']."' ";
	$query = mysqli_query($conn, $sql);
	$result = mysqli_fetch_assoc($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Admin Dashboard</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<header>
		<h1>Welcome <?php echo $result["username"]; ?>!</h1>
	</header>
	<section>
		<nav>
			<ul>
				<li><a href="dashboard.php">Dashboard</a><br></li>
				<li><a href="product_list.php">จัดการสินค้า</a><br></li>
				<li><a href="product_type.php">จัดการประเภทสินค้า</a><br></li>
				<li><a href="view_orders.php">จัดการออเดอร์</a><br></li>
				<li class="logout"><a href="logout.php">Logout</a></li>
			</ul>
		</nav>
		<div class="info">
			<a style="padding: .5rem; background: green; display: inline-block; color: #fff; text-decoration: none;" href="member_add.php">เพิ่มสมาชิก</a>

			<?php
			    $query = "SELECT * FROM users ORDER BY user_id ASC";
			    $result = mysqli_query($conn, $query);
			?>
			  	<table>
			        <tr>
			            <td>User id</td>
			            <td>Username</td>
			            <td>Password</td>
			            <td>Phone</td>
			            <td>Email</td>
			            <td>Address</td>
			            <td colspan='2'>Actions</td>
			      	</tr>
			      <?php  while ($row = mysqli_fetch_assoc($result)) { ?>
			        <tr>
			           <td><?php echo $row["user_id"]; ?></td>
			           <td><?php echo $row["username"]; ?></td>
			           <td><?php echo $row["password"]; ?></td>
			           <td><?php echo $row["phone"]; ?></td>
			           <td><?php echo $row["email"]; ?></td>
			           <td><?php echo $row["address"]; ?></td> 
			           <td><a href="member_edit.php?edit=<?php echo $row['user_id']; ?>">แก้ไข</a></td> 
			           <td><a href="member_delete.php?delete=<?php echo $row['user_id']; ?>" 
			           		  onclick="return confirm('คุณต้องการลบผู้ใช้นี้ใช่ไหม ?');" >ลบ</a></td>
			     	</tr>
			        <?php } ?>
			      </table>

			<?php mysqli_close($conn); ?>
		</div>
	</section>

	<footer>
			<p>&copy; Copyright 2020. All Right Reserved MilerShop</p>
	</footer>
</body>
</html>
