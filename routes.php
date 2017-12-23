<?php
  $fromPoint=$_POST['from_point'];
  $toPoint=$_POST['to_point'];
?>
<?php
include('base.php');
?>
<?php startblock('body') ?>
  <div class="jumbotron">
    <div class="list-group">
      <?php
        $sql="SELECT * FROM routes where toPoint='$toPoint' and fromPoint='$fromPoint'";
        $result = mysqli_query($db,$sql);
        $count=mysqli_num_rows($result);
        if($count>0){
          while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
        ?>

      <a href="viewroute.php?id=<?php echo $row['routeID'];?>" class="list-group-item active">
        <h4 class="list-group-item-heading"><span class="fa fa-paper-plane"></span> From <?php echo $row['fromPoint'];?> to <?php echo $row['toPoint'];?><span class="fa fa-bus pull-right"> <?php echo $row['company'];?></span></h4>
        <p class="list-group-item-text"><span class="fa fa-clock-o"></span> Departure Time <?php echo date('g:i a', strtotime($row['departureTime']));?></p>
      </a>
      <?php
       }
     }else{
      ?>
      <p>No routes available at the moment</p>
      <?php
       }
      ?>
    </div>
    
  </div>
<?php endblock() ?>