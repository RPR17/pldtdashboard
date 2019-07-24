<?php
function test($item){

	$q = "3.00";
	$w = "1000.0000";
	$e = "10.00";

	$ret[] = array();
	//$ret2 = "wrong";
	if ($item == "check") {
	$ret['a'] = $e;
	$ret['b'] = $q;
	$ret['c'] = $w;
	}
	else{
		return false;
	}

	return $ret;
}


function asd() {
$param = "check";
//$cat[] = array();
$cat = test($param);

echo $cat['a']."<br>";
echo $cat['b']."<br>";
echo $cat['c']."<br>";

$ec = floatval($cat['a']) + floatval($cat['c']);

$num =  number_format($ec, 2);

$str = strval($num);

echo $num."<br>";
echo $str."string ito";
}

/*
$exp = time();
$count = $exp + 10;

for ($i=0; time() < $count; $i++) { 
	echo $count - 1 . "<br>";
}*/
?>
<style>
	.ahide{
		display: none;
	}
</style>

<script>
var timeleft = 10;
var downloadTimer = setInterval(function(){
  document.getElementById("countdown").innerHTML = timeleft + " seconds remaining";
  timeleft -= 1;
  if(timeleft <= 0){
    clearInterval(downloadTimer);
    document.getElementById("countdown").innerHTML = "Finished";
    document.getElementById("alert_count").classList.add("ahide");
  }
}, 1000);
</script>
<div class=" " id="alert_count">
	saalhfasl
	<p id="countdown"></p>
</div>
<?php
if (condition) {
	# code...
}
else if () {
	
}


?>