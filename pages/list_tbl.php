<?php
include '../includes/config_db.php';
    $mysqli = $con;
    $stmt = $mysqli->prepare("SELECT * FROM transaction_tbl ORDER BY date_created ASC");

?>

<div class="row">
<div class="col-xl-12 col-lg-12">

<h1 class="h3 mb-2 text-gray-800">Transactions</h1>

<div class="card shadow mb-4">
<p>sample</p>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
<!--<div class="card-header py-3">
<h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
</div>-->
<div class="card-body">
<div class="table-responsive">
<table id="trans_tbl" class="display" style="width:100%">
<thead>
  <tr>
      <th>UserID</th>
      <th>Mobile&nbsp;No.</th>
      <th>Reference&nbsp;No.</th>
      <th>Transaction&nbsp;No.</th>
      <th>PLDT Transaction&nbsp;No.</th>
      <th>Purchased&nbsp;Item</th>
      <th>Purchased&nbsp;Cost</th>
      <th>Payment&nbsp;Status</th>
      <th>PLDT Load&nbsp;Status</th>
      <th>PLDT Status&nbsp;Description</th>
      <th>IP</th>
      <th>Device</th>
      <th>Location</th>
      <th>Date</th>
  </tr>
</thead>
<tbody>
  <?php
    #$stmt->bind_param("s", $_POST['os0']);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows != 0) {
    while($row = $result->fetch_assoc()) {
      echo '<tr>';
      echo '<td>'.$row['user_id'].'</td>';
      echo '<td>'.$row['phone_no'].'</td>';
      echo '<td>'.$row['refid'].'</td>';
      echo '<td>'.$row['transaction_id'].'</td>';
      echo '<td>'.$row['load_trans'].'</td>';
      echo '<td>'.$row['purchased_item'].'</td>';
      echo '<td>'.$row['purchased_gross'].'</td>';
      echo '<td>'.$row['status'].'</td>';
      echo '<td>'.$row['load_status'].'</td>';
      echo '<td>'.$row['load_message'].'</td>';
      echo '<td>'.$row['user_ip'].'</td>';
      echo '<td>'.$row['device'].'</td>';
      echo '<td>'.$row['country'].'</td>';
      echo '<td>'.$row['date_created'].'</td>';
      echo '</tr>';
    }
  }
  else{
    echo '<tr><td colspan="14"><center>No Data Found</center></td></tr>';
  }
  ?>
</tbody>
<tfoot>
  <tr>
      <th>UserID</th>
      <th>Mobile&nbsp;No.</th>
      <th>Reference&nbsp;No.</th>
      <th>Transaction&nbsp;No.</th>
      <th>PLDT Transaction&nbsp;No.</th>
      <th>Purchased&nbsp;Item</th>
      <th>Purchased&nbsp;Cost</th>
      <th>Payment&nbsp;Status</th>
      <th>PLDT Load&nbsp;Status</th>
      <th>Reference&nbsp;No.</th>
      <th>IP</th>
      <th>Device</th>
      <th>Location</th>
      <th>Date</th>
  </tr>
</tfoot>
</table>
</div>
</div>
</div>

</div>
</div>