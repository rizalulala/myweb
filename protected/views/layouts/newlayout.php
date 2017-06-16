<!DOCTYPE html>
<html lang="en">
<head>
<title>Widya Handicraft | Home</title>

<!-- css -->
<link href="css/ecraft3/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" href="css/ecraft3/css/style.css" type="text/css" media="all" />
<link rel="stylesheet" href="css/ecraft3/css/font-awesome.min.css" type="text/css" media="all" />
<!--// css -->
<!-- font -->
<link href="//fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<!-- //font -->
<script src="css/ecraft3/js/jquery-1.11.1.min.js"></script>
<script src="css/ecraft3/js/bootstrap.js"></script>
</head>

<body>

<?php
	include "css/ecraft3/include/header.php";
?>



<div class="content">
	<div class="container">
	<div class="col-md-4 w3ls_dresses_grid_left">
			<div class="w3ls_dresses_grid_left_grid">
				<h3>Kategori</h3>
					<div class="w3ls_dresses_grid_left_grid_sub">
						<div class="ecommerce_dres-type">
							<ul>
							
							<?php
						
				$con=mysqli_connect("localhost","root","","widya_db");
				$sql="select * from kategori";
				$query=mysqli_query($con,$sql);
                while($data=mysqli_fetch_array($query)){?>
								<li><a href="index.php?r=site/indexper&id=<?php echo $data['kategori'];?>"><?php echo $data['kategori'];?></a></li>
								<?php } ?>	
								
						</ul>
						</div>
					</div>
			</div>
		</div>
		<?php echo $content;?>
				<div class="clearfix"></div>
			</div>
		</div>
	

<?php include "css/ecraft3/include/footer.php"; ?>

	<!-- cart-js -->
	<script src="css/ecraft3/js/minicart.js"></script>
	<script>
        w3ls1.render();

        w3ls1.cart.on('w3sb1_checkout', function (evt) {
        	var items, len, i;

        	if (this.subtotal() > 0) {
        		items = this.items();

        		for (i = 0, len = items.length; i < len; i++) {
        			items[i].set('shipping', 0);
        			items[i].set('shipping2', 0);
        		}
        	}
        });
    </script>  
	<!-- //cart-js -->  
</body>
</html>