<!DOCTYPE html>
<html>
<head>
	<title>admin</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script>
		function Deleteqry(id)
		{ 
		  if(confirm("Are you sure you want to delete this product?")==true)
		           window.location="GitHub/Web-design-master/admin.php="+id;
		    return false;
		}
	</script>
</head>
<body>

<?php 
	if (isset($_GET['Productname'])) {
		require_once('./ATNconnector.php');
		$conn = new ATNconnector();
		$sql = "UPDATE `product` SET `Productname`='".$_GET['Productname']."',`Manufacturer`='".$_GET['Manufacturer']."',`Unitprice`='".(int)$_GET['Unitprice']."',`Images`='".$_GET['Images']."',`Stock`='".(int)$_GET['Stock']."',`Categoryid`='".(int)$_GET['Categoryid']."' WHERE Productid = ".$_GET['Productid'];
		$conn -> execStatement($sql);
	}
	
 ?>
 <?php 
		
		if(isset($_GET['del']))
	   {
	   	require_once('./ATNconnector.php');
	   	$conn = new ATNconnector();
	   	$id = $_GET['del'];
	    $sql ="DELETE FROM product WHERE Productid ='". (int)$id ."'";
	    $conn->execStatement($sql);
	    $message = "Product Deleted!";
		echo "<script type='text/javascript'>alert('$message');</script>";
	   }
	 ?>
	 <?php 
		require_once('./ATNconnector.php');
		if(isset($_POST['Productid']))
		{
		$ID = $_POST['Productid'];
		$Images = $_POST['Images'];
		$Manufacturer = $_POST['Manufacturer'];
		$Productname = $_POST['Productname'];
		$Stock = $_POST['Stock'];
		$Unitprice = $_POST['Unitprice'];
		$Categoryid = $_POST['Categoryid'];
		$sql = "INSERT INTO product(Productid, Productname, Manufacturer, Unitprice, Images, Stock, Categoryid) VALUES (". $ID .",'". $Productname ."','". $Manufacturer ."',". $Unitprice .", '". $Images."',   ". $Stock .", ". $Categoryid ." )";
		$sql1 ="SELECT * FROM product WHERE Productid =".$_POST['Productid'];
		$conn = new ATNconnector();
		$row = $conn -> runQuery($sql1);
			if (count($row)>0) {
			$mess = "Error, ID existed";
			echo "<script type='text/javascript'>alert('$mess'); window.history.back();</script>";	
			} else {
			$conn -> execStatement($sql);
			$message = "Product add";
			echo "<script type='text/javascript'>alert('$message');</script>";
			}						
			}
			?>

		

	<div class="header">
		<div class="nava">
			<ul>
				<li><a href="https://newapppppppppppppp.herokuapp.com/ATN.php">Trở về giao diện khách hàng</a></li>
			</ul>
			</div>
		<div class="banner">
		 		<div class="Home">
		 			<p>Giao diện dành riêng cho admin</p>
					<a href="https://newapppppppppppppp.herokuapp.com/ATN.php">ATN Shop</a>
				</div>
				<div class="Search">
					<div class="Search1">
						<form class="example" action="Search.php" method="get">
		  				<input type="text" placeholder="Search.." name="search">
		  				<button type="submit"><i class="fa fa-search"></i></button>
						</form>
					</div>
				</div>
		 	</div>
	</div>
	<div class="main">
		<div style="margin:50px; padding-left:20%">
			<b><span style="font-size:20px">Danh sách sản phẩm:</span></b>
			<br><br><br>
			<form action="">
			<table border="1" cellpadding="1" cellspacing="0"  >
				<tr>
					<th>Productid</th>
					<th>Productname</th>
					<th>Manufacturer</th>
					<th>Unitprice</th>
					<th>Images</th>
					<th>Stock</th>
					<th>Categoryid</th>
					<th >Repair</th>
					<th>Delete</th>
				</tr>
				<?php 
					require_once('./ATNconnector.php');
					$conn = new ATNconnector();
					$sql = "Select * From product";
					$rows = $conn->runQueryadmin($sql);
				 	for ($i=0; $i < count($rows) ; $i++) { 
				?>
					<tr>
						<?php for ($j=0; $j<count($rows[$i]); $j++) { ?>
							<th>
								<?php echo $rows[$i][$j]?>
							</th>
							
						<?php } ?>

							<th ><a href="https://newapppppppppppppp.herokuapp.com/Suadoi.php?id=<?php echo $rows[$i][0] ?>"><input type="button" value="Update" style=" background-color: #FF7302; text-decoration-color: #FFFFFF;" ></a> 
							</th>
							<th ><a href="admin.php?del=<?php echo $rows[$i][0] ?>"> <input type="button" value="Delete" style=" background-color: #FF7302; text-decoration-color: #FFFFFF;" onclick="return Deleteqry(<?php echo $rows[$i][0] ?>);"> </a>
							</th>
					</tr>
				<?php } ?>
			</table> <br> <br>
			<div>
				<b><span style="font-size:20px">Thêm Sản phẩm mới:</span></b>   <a href="https://newapppppppppppppp.herokuapp.com/add.php"><input type="button" value="Thêm Sản Phẩm" style=" background-color: #FF7302; text-decoration-color: #FFFFFF; width:25%; height: 30px" ></a> 
			</div>
			
		</div>



		<div style="margin:50px; padding-left:20%">
			<b><span style="font-size:20px">Danh sách khách hàng:</span></b>
			<br><br><br>
			<table border="1" cellpadding="1" cellspacing="0"  >
				<tr>
					<th>Custid</th>
					<th>Fullname</th>
					<th>Address</th>
					<th>City</th>
					<th>Country</th>
					<th>Phone</th>
					<th>Fax</th>
					<th >Postalcode</th>
					<th>Tendangnhap</th>
					<th>Password</th>
				</tr>
				<?php 
					include 'ConnectorSQL.php';
					$sql = "SELECT * From customers";
					$row = pg_query($connection, $sql);
				 	for ($i=0; $i < count($row) ; $i++) { 
				?>
					<tr>
						<?php for ($j=0; $j<count($row[$i]); $j++) { ?>
							<th>
								<?php echo $row[$i][$j]?>
							</th>
						<?php } ?>
					</tr>
				<?php } ?>
			</table>
		</div>

		<div style="margin:50px; padding-left:20%">
			<b><span style="font-size:20px">Danh sách loại sản phẩm:</span></b>
			<br><br><br>

			<table border="1" cellpadding="1" cellspacing="0"  >
				<tr>
					<th>Categoryid</th>
					<th>Categoryname</th>
					<th>Description</th>
					<th >Repair</th>
					<th>Delete</th>
				</tr>
				<?php 
					require_once('./ATNconnector.php');
					$conn = new ATNconnector();
					$sql = "Select * From category";
					$rows = $conn->runQueryadmin($sql);
				 	for ($i=0; $i < count($rows) ; $i++) { 
				?>
					<tr>
						<?php for ($j=0; $j<count($rows[$i]); $j++) { ?>
							<th>
								<?php echo $rows[$i][$j]?>
							</th>
						<?php } ?>
							<th ><a href="https://newapppppppppppppp.herokuapp.com/Suadoi.php?id=<?php echo $rows[$i][0] ?>"><input type="button" value="Update" style=" background-color: #FF7302; text-decoration-color: #FFFFFF;" ></a> 
							</th>
							<th ><a href="admin.php?del=<?php echo $rows[$i][0] ?>"> <input type="button" value="Delete" style=" background-color: #FF7302; text-decoration-color: #FFFFFF;" onclick="return Deleteqry(<?php echo $rows[$i][0] ?>);"> </a>
							</th>
					</tr>
				<?php } ?>
			</table>
			<div> <br> <br>

				
				<b><span style="font-size:20px">Thêm Loại sản phẩm mới:</span></b>   <a href="https://newapppppppppppppp.herokuapp.com/addcategory.php"><input type="button" value="Thêm Catedory" style=" background-color: #FF7302; text-decoration-color: #FFFFFF; width:25%; height: 30px" ></a> 

			</div>
			</form>
		</div>



	</div>
	

</body>
</html>
