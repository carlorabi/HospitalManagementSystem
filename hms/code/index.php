
<!DOCTYPE html>
<html lang="en">
<?php require_once('check_login.php');?>
<?php include('head.php');?>
<?php include('header.php');?>
<?php include('sidebar.php');?>
<?php include('connect.php');?>

 <?php 
 include('connect.php');
  $sql = "select * from admin where id = '".$_SESSION["id"]."'";
        $result=$conn->query($sql);
        $row1=mysqli_fetch_array($result);

 ?>   


<div class="pcoded-content">
<div class="pcoded-inner-content">
<div class="main-body">
<div class="page-wrapper full-calender">
<div class="page-body">
<div class="row">
<?php
$sql_manage = "select * from manage_website"; 
$result_manage = $conn->query($sql_manage);
$row_manage = mysqli_fetch_array($result_manage);
?>

<?php if($_SESSION['user'] == 'admin'){ ?>
<div class="col-xl-3 col-md-6">
<div class="card bg-c-green update-card">
<div class="card-block">
<div class="row align-items-end">
<div class="col-8">

<h4 class="text-white">
    <?php
    $sql = "SELECT * FROM patient WHERE status='Active'";
    $qsql = mysqli_query($conn,$sql);
    echo mysqli_num_rows($qsql);
    ?>
</h4>
<h6 class="text-white m-b-0">Patient</h6>
</div>
<div class="col-4 text-right">
<canvas id="update-chart-2" height="50"></canvas>
</div>
</div>
</div>
</div>
</div>

<div class="col-xl-3 col-md-6">
<div class="card bg-c-pink update-card">
<div class="card-block">
<div class="row align-items-end">
<div class="col-8">

<h4 class="text-white">
<?php
    $sql = "SELECT * FROM doctor WHERE status='Active'";
    $qsql = mysqli_query($conn,$sql);
    echo mysqli_num_rows($qsql);
?>
</h4>
<h6 class="text-white m-b-0">Doctor</h6>
</div>
<div class="col-4 text-right">
<canvas id="update-chart-3" height="50"></canvas>
</div>
</div>
</div>
</div>
</div>

<div class="col-xl-3 col-md-6">
<div class="card bg-c-yellow update-card">
<div class="card-block">
<div class="row align-items-end">
<div class="col-8">

<h4 class="text-white">
    <?php 
          $sql = "SELECT * FROM department WHERE status='Active'";
          $qsql = mysqli_query($conn,$sql);
          echo mysqli_num_rows($qsql);
          
    ?>
</h4>
<h6 class="text-white m-b-0">Department</h6>
 </div>
<div class="col-4 text-right">
<canvas id="update-chart-1" height="50"></canvas>


</div>
</div>
</div>
</div>
</div>


<?php } ?>

</div>

<?php if($_SESSION['user'] == 'admin'){ ?>


  <div class="card">
  <div class="card-header">
        <h2>Appointments</h2>
  <!-- <h5>DOM/Jquery</h5>
  <span>Events assigned to the table can be exceptionally useful for user interaction, however you must be aware that DataTables will add and remove rows from the DOM as they are needed (i.e. when paging only the visible elements are actually available in the DOM). As such, this can lead to the odd hiccup when working with events.</span> -->
  </div>
  <div class="card-block">
  <div class="table-responsive dt-responsive">
  <table id="dom-jqry" class="table table-striped table-bordered nowrap">
  <thead>
  <tr>
      <th>Patient detail</th>
      <th>Appointment Date &  Time</th>
      <th>Department</th>
      <th>Doctor</th>
      <th>Reason</th>
      <th>Status</th>
  </tr>
  </thead>
  <tbody>
    <?php
      $sql ="SELECT * FROM appointment WHERE (status !='')";
      if(isset($_SESSION['patientid']))
      {
        $sql  = $sql . " AND patientid='$_SESSION[patientid]'";
      }
      $qsql = mysqli_query($conn,$sql);
      while($rs = mysqli_fetch_array($qsql))
      {
        $sqlpat = "SELECT * FROM patient WHERE patientid='$rs[patientid]' and status='Active'";
        $qsqlpat = mysqli_query($conn,$sqlpat);
        $rspat = mysqli_fetch_array($qsqlpat);
        
        
        $sqldept = "SELECT * FROM department WHERE departmentid='$rs[departmentid]' and status='Active'";
        $qsqldept = mysqli_query($conn,$sqldept);
        $rsdept = mysqli_fetch_array($qsqldept);
      
        $sqldoc= "SELECT * FROM doctor WHERE doctorid='$rs[doctorid]' and status='Active'";
        $qsqldoc = mysqli_query($conn,$sqldoc);
        $rsdoc = mysqli_fetch_array($qsqldoc);
          echo "<tr>
            <td>&nbsp;$rspat[patientname]<br>&nbsp;$rspat[mobileno]</td>     
         <td>&nbsp;" . date("d-M-Y",strtotime($rs['appointmentdate'])) . " &nbsp; " . date("H:i A",strtotime($rs['appointmenttime'])) . "</td> 
          <td>&nbsp;$rsdept[departmentname]</td>
           <td>&nbsp;$rsdoc[doctorname]</td>
            <td>&nbsp;$rs[app_reason]</td>
            <td>&nbsp;$rs[status]</td></tr>";
      }
      ?>
  </tbody>
  <tfoot>
  <tr>
      <th>Patient detail</th>
      <th>Appointment Date &  Time</th>
      <th>Department</th>
      <th>Doctor</th>
      <th>Reason</th>
      <th>Status</th>
  </tr>
  </tfoot>
  </table>
  </div>
  </div>
  </div>
<?php } ?>

</div>
</div>
</div>
</div>
</div>
</div>


<?php include('footer.php');?>


</script>
