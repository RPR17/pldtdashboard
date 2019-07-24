<?php
//error_reporting(0);
error_reporting(E_ALL);
if(strtoupper($_SERVER['REQUEST_METHOD']) === 'POST'){
	if ($_POST['btn'] === "581a91238a786c9ad97b7211acfada753a1fdb9f") {
	//echo "successs!!!";
		if ($_POST['ccode'] == "" || $_POST['mob'] == "" || $_POST['item'] == "") {
				?>
				<script language="JavaScript">
					alert("Required fields are empty!");
					window.location.href = "../pages/";
				</script>
				<?php
			}
			else{
				date_default_timezone_set('Asia/Manila');
				require '../includes/config_db.php';
				require 'functions.php';
				$date_created = date('Y-m-d H:i:s');

				$items[] = array();

				$number = $_POST['ccode'].$_POST['mob'];
				$item_label = $_POST['item'];

				$items = getItems($item_label);

				if ($items !== false) {
					$telco = $items['telco'];
					$code = $items['code'];
					$cost = intval($items['cost']);
					$shipping = intval($items['shipping']);

					$mc = $cost + $shipping;
					$toSTR = number_format($mc, 2);
					$mc_gross = strval($toSTR);

					$run_insert = insertTransaction($number, $item_label, $mc_gross, $date_created);
					
					if ($run_insert !== false) {
						//run pldt
						$topUp = curlTopUp($code,$number,$telco,$run_insert);
						if ($topUp !== false) {
							echo '
								<script language="JavaScript">
									alert("Successful TopUp.");
									window.location.href = "../pages/";
								</script>
							';
						}
					}
					else{
						echo "failed";
					}
				}

			}
	}	
}
?>