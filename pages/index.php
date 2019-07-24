<?php session_start(); ?>
<?php
if (!isset($_SESSION['log_in'])) {
	//session_destroy();
	header('Location: ../login.php');
	exit();
  }
  else{
  	$c0UnT = time();

  	if ($c0UnT > $_SESSION['exp_logged_time']) {
  		session_destroy();
  		?>
  		<script language="JavaScript">
			alert("Your session has expired.");
			window.location.href = "http://localhost/pldt_dash/index.php";
		</script>';
	<?php	
  	}
  	/*else{
  		header('Location: index.php');
  	}
  	header('Location: index.php');
  	die();*/
  }
?>

<?php
require_once '../includes/header.php';

require '../includes/nav_side.php';
?>

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

  <!-- Main Content -->
  <div id="content">
  	<?php include '../includes/nav_top.php'; ?>
  	<!-- Begin Page Content -->
    <div class="container-fluid">
    	<?php
    	if (isset($_GET['m'])){
    		$exps = $_GET['m'];
    	if ($exps === 'success') { 
			//$html = '';
			//echo $html;
		?>
		<script>
			var timeleft = 10;
			var downloadTimer = setInterval(function(){
			  document.getElementById("alert_count").classList.remove("ahide");
			  document.getElementById("countdown").innerHTML = timeleft + " seconds remaining";
			  timeleft -= 1;
			  if(timeleft <= 0){
			    clearInterval(downloadTimer);
			    document.getElementById("countdown").innerHTML = "Finished";
			    document.getElementById("alert_count").classList.add("ahide");
			  }
			}, 1000);
		</script>
		<?php
		}
		else if ($exps === 'failed'){
		?>

		<script>
			var timeleft = 10;
			var downloadTimer = setInterval(function(){
			  document.getElementById("ac").classList.remove("ahide");
			  document.getElementById("cd").innerHTML = timeleft + " seconds remaining";
			  timeleft -= 1;
			  if(timeleft <= 0){
			    clearInterval(downloadTimer);
			    document.getElementById("cd").innerHTML = "Finished";
			    document.getElementById("ac").classList.add("ahide");
			  }
			}, 1000);
		</script>

		<?php
		}

		}
  		?>
    	<div class="alert alert-info ahide " role="alert" id="alert_count">
		  Success TopUp! <span style="float:right;"><p id="countdown"></p></span>
		</div>
		<div class="alert alert-warning ahide " role="alert" id="ac">
		  Failed TopUp! <span style="float:right;"><p id="cd"></p></span>
		</div>


    	<div class="d-sm-flex align-items-center justify-content-between mb-4">
           <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
         </div>
    	<?php include '../includes/badge.php'; ?>
  		
  		<?php include 'list_tbl.php'; ?>
  	</div>
    <!-- /.container-fluid -->
  
  	<!-- Footer -->
	<footer class="sticky-footer bg-white">
	<div class="container my-auto">
	  <div class="copyright text-center my-auto">
	    <span>Copyright &copy; <?php echo date('Y'); ?></span>
	  </div>
	</div>
	</footer>
	<!-- End of Footer -->

	<!-- Modal -->
	<div class="modal fade" id="manual" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Manual TopUp</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form action="../core/sendTopUp.php" method="POST" id="mform">
	        	<label><strong>Mobile Number:</strong></label>
	        	<div class="form-row">
	        		<div class="form-group col-md-4 col-sm-12">
	        			<?php include 'ccode_list.php'; ?>
	        		</div>
					<div class="form-group col-md-8 col-sm-12">
				    	<input type="text" class="form-control" id="mob" name="mob" placeholder="9XXXXXXXXX">
					</div>	        		
	        	</div>
	        	<div class="form-row">
	        		<div class="form-group col-md-4 col-sm-12">
	        			<label>Wallet</label>
	        			<select name="wallet_item" id="WBtn" class="form-control btnload">
	        				<option disabled selected >Please Select Load Wallet</option>
							<option value="smartTNT">Smart and TNT Wallet</option>
	        				<option value="sun">Sun Cellular Wallet</option>
	        				<option value="freeBEE">Free Bee Wallet</option>
	        			</select>
	        		</div>
	        		<div class="form-group col-md-8 col-sm-12">
	        			<label>Load</label>
	        			<select name="item" id="ILoad" class="form-control">
	        				<option disabled selected value="">Please Select load Product</option>
	        			</select>
	        		</div>

	        	</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <!--<a href="javascript:void(0);" class="btn btn-primary">Save changes</a>-->
	        <input type="hidden" name="btn" id="btn_m">
	        <input type="submit" name="m_btn" class="btn btn-primary" /><!--onclick="test_swal();"-->
	      </div>
	      </form>
	    </div>
	  </div>
	</div>

  </div>
  <!-- End of Main Content -->
</div>
<!-- End of Content Wrapper -->
<?php include 'logout.php'; ?>

<?php
require_once '../includes/footer.php';
?>