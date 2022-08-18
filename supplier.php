
<?php
session_start();
include('include/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
date_default_timezone_set('Asia/Kolkata');// change according timezone
$currentTime = date( 'd-m-Y h:i:s A', time () );


if(isset($_POST['submit']))
{
	
	$name=$_POST['companyname'];
	$loc=$_POST['location'];
	$phone=$_POST['phonenumber'];
$sql=mysqli_query($con,"insert into supplier(companyName,location,phoneNumber) values('$name','$loc','$phone')");
$_SESSION['msg']="Category Created !!";

}

if(isset($_GET['del']))
		  {
		          mysqli_query($con,"delete from supplier where id = '".$_GET['id']."'");
                  $_SESSION['delmsg']="Supplier Details deleted !!";
		  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin| Supplier</title>
	<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link type="text/css" href="css/theme.css" rel="stylesheet">
	<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
	<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
</head>
<body>
<?php include('include/header.php');?>

	<div class="wrapper">
		<div class="container">
			<div class="row">
<?php include('include/sidebar.php');?>				
			<div class="span9">
					<div class="content">

						<div class="module">
							<div class="module-head">
								<h3>Supplier Details</h3>
							</div>
							<div class="module-body">

									<?php if(isset($_POST['submit']))
{?>
									<div class="alert alert-success">
										<button type="bidco" class="close" data-dismiss="alert">×</button>
									<strong>Well done!</strong>	<?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
									</div>
<?php } ?>


									<?php if(isset($_GET['del']))
{?>
									<div class="alert alert-error">
										<button type="button" class="close" data-dismiss="alert">×</button>
									<?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?>
									</div>
<?php } ?>

									<br />

			<form class="form-horizontal row-fluid" name="Supplier" method="post">
									

<div class="control-group">
<label class="control-label" for="basicinput">Company Name</label>
<div class="controls">
<input type="text" placeholder="Enter Company Name"  name="companyname" class="span8 tip" required>
</div>
</div>


<div class="control-group">
<label class="control-label" for="basicinput">Location</label>
<div class="controls">
<input type="text" placeholder="Enter Company Location"  name="location" class="span8 tip" required>
</div>
</div>


<div class="control-group">
<label class="control-label" for="basicinput">Phone Number</label>
<div class="controls">
<input type="text" placeholder="Enter Company Phone Number"  name="phonenumber" class="span8 tip" required>
</div>
</div>


<hr>
			<p align="center">
			<button type="submit" name="submit" class="btn">Create</button>

			<button type="reset" class="btn btn-danger"><i class="fa fa-times fa-fw"></i>Reset</button> 
			 
		</p>
									</form>
							</div>
						</div>


	<div class="module">
							<div class="module-head">
								<h3>Manage Supplier Details</h3>
							</div>
							<div class="module-body table">
								<table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" width="100%">
									<thead>
										<tr>
											<th>Supplier ID</th>
											<th>Company Name</th>
											<th>Location</th>
											<th>Phone Number</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>

<?php $query=mysqli_query($con,"select * from supplier");
$cnt=1;
while($row=mysqli_fetch_array($query))
{
?>									
										<tr>
										<td><?php echo htmlentities($cnt);?></td>
											<td><?php echo htmlentities($row['companyName']);?></td>
											<td><?php echo htmlentities($row['location']);?></td>
											<td> <?php echo htmlentities($row['phoneNumber']);?></td>
											<td>
											<a href="edit-supplier.php?id=<?php echo $row['id']?>" ><i class="icon-edit"></i></a>
											<a href="supplier.php?id=<?php echo $row['id']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')"><i class="icon-remove-sign"></i></a></td>
										</tr>
										<?php $cnt=$cnt+1; } ?>
										
								</table>
							</div>
						</div>						

						
						
					</div><!--/.content-->
				</div><!--/.span9-->
			</div>
		</div><!--/.container-->
	</div><!--/.wrapper-->

<?php include('include/footer.php');?>

	<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
	<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
	<script src="scripts/datatables/jquery.dataTables.js"></script>
	<script>
		$(document).ready(function() {
			$('.datatable-1').dataTable();
			$('.dataTables_paginate').addClass("btn-group datatable-pagination");
			$('.dataTables_paginate > a').wrapInner('<span />');
			$('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
			$('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');
		} );
	</script>
</body>
<?php } ?>