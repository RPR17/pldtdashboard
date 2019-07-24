<?php
function getItems($item){
	global $con;

	$ret[] = array();

	$stmt_getItem = $con->prepare("SELECT item_telco, item_code, item_cost, item_shipping FROM item_tbl WHERE item_label = ?");
	$stmt_getItem->bind_param("s", $item);
	$stmt_getItem->execute();
	$result = $stmt_getItem->get_result();
	
	if($result->num_rows != 0) {
		while($row = $result->fetch_assoc()) {
			$ret['telco'] = $row['item_telco'];
			$ret['code'] = $row['item_code'];
			$ret['cost'] = $row['item_cost'];
			$ret['shipping'] = $row['item_shipping'];
		}
		return $ret;
	}
	else{
		return false;
	}

}

function insertTransaction($no,$product,$cost,$date){

	global $con;

	$stmt_manual = $con->prepare("INSERT INTO manual_tbl (phone_no, purchased_item, purchased_cost, date_created) VALUES (?, ?, ?, ?)");
	$stmt_manual->bind_param("ssss", $no, $product, $cost, $date);
	$stmt_manual->execute();
	$id = $con->insert_id;
	$stmt_manual->close();
	if ($id !== 0) {
		//run curl
		return $id;
	}
	else{
		return false;
	}
}

function curlTopUp($code,$number,$telco,$id){

	global $con;
	$time = time();
	$hash = "M4nU41";
	$reqid = $time.$hash;

	switch ($telco) {
	case 'smartTNT':
		//SMARTCRGWALLET_768 SMART/TNT
		$publickey = "f0babbc9-dc9e-4a48-9145-b29ed93f314f";
		$privatekey = "452348ad-819e-48a1-b43f-d8c85c606b9b";
		$gtu = "rtejada";
		break;
	case 'sun':
		//SUNGMWALLET_769 SUN CEL
		$publickey = "1ca926c6-8235-49b0-a2fa-d8b4f184e40e";
		$privatekey = "10bd38ee-1683-4182-bd1f-24dd421d3f9c";
		$gtu = "rtejada";
		break;
	case 'freeBEE':
		//ARCHERWALLET_766 FREEBEE
		$publickey = "2cceb398-b358-402c-8d32-00f0919aed54";
		$privatekey = "fd67bd11-3e15-438c-bcdf-e4a8f7758652";
		$gtu = "71960";
		break;
	}


	/*pldtTopUp*/
	$publickey = str_replace("-", "", $publickey);
	$privatekey = str_replace("-", "", $privatekey);

	$productcode = $code;
	#$targetnumber = "09489771599";
	$targetnumber = $number;
	$dealer = $gtu;
	$stat_load[] = array(); 

	$signature = hash_hmac("sha1", $reqid.$targetnumber.$productcode.$publickey, $privatekey, FALSE);

	$data = file_get_contents('https://globaltopup.pldtglobal.com:8443/GTG/api/'.$publickey.'/'.$reqid.'/'.$productcode.'/'.$targetnumber.'/'.$signature.'/'.$dealer.'');
	
	$json_dec = json_decode($data, true);
	$stat = $stat_load['status'];
	$mess = $stat_load['message'];
	$pldt_trans = $stat_load['transactionCode'];

	$stmt_stat = $con->prepare("UPDATE manual_tbl SET status_code = ?, status_message = ?, pldt_trans_code = ? WHERE id = ? AND date_updated IS null");
	$stmt_stat->bind_param("ssss", $stat, $mess, $pldt_trans, $id);
	$stmt_stat->execute();
	$transcount = $stmt_stat->affected_rows;
	$stmt_stat->close();


	$stmtlog = $con->prepare("INSERT INTO log_tbl (content, date_created) VALUES (?, ?)");
	$stmtlog->bind_param("ss", $data, NOW());
	$stmtlog->execute();
	$stmtlog->close();
	$msg = "success";
	$msg2 = "failed";
	if($transcount !== 0 && $stat == "COMPLETE"){
		
		header('Location: ../pages/?m=$msg');
	}
	else{
		header('Location: ../pages/?m=$msg2');
	}

}
?>