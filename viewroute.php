<?php require('pdoConfig.php');

$stmt = $dbo->prepare('SELECT * FROM routes WHERE routeID = :routeID');
$stmt->execute(array(':routeID' => $_GET['id']));
$row = $stmt->fetch();

//if route does not exists redirect user.
if($row['routeID'] == ''){
  header('Location: ./');
  exit;
}

?>
<?php
include('base.php');
?>
<?php startblock('body') ?>
  <div class="jumbotron">
    <em>From <span class="fa fa-paper-plane"></span> Kampala To <span class="fa fa-paper-plane"></span> Mbarara<span class="fa fa-bus pull-right"> Global Coaches</span></em>

    <hr/>
    <div>
        <h3>Departure Time</h3>
        <span class="fa fa-clock-o"></span> 7:00 PM<!-- <?php echo date('g:i a', strtotime($row['departureTime']));?> -->
        <h3>Transport fees</h3>
        <span class="fa fa-money"></span> 20000<?php echo $row['fee'];?> Ushs
    </div>
    <p>
      <a class="btn btn-lg btn-primary pull-right" data-toggle="modal" href="#bookModal">Book Ticket &raquo;</a>
    </p>
    <!-- Modal -->
    <div id="bookModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Book for a Ticket</h4>
          </div>
          <div class="modal-body">
            <form action="pesapal-iframe.php" method="post">
              <table>
                <tr>
                  <td>Amount:</td>
                  <td><input type="text" name="amount" class="form-control" value=" 50<?php echo $row['fee'];?>" readonly="readonly" />
                  (in Ugshs)
                  </td>
                </tr>
                <tr>
                  <td><input type="hidden" name="type" value="MERCHANT" class="form-control" readonly="readonly" />
                  <!-- (leave as default - MERCHANT) -->
                  </td>
                </tr>
                <tr>
                  <td>Description:</td>
                  <td><input type="text" name="description" class="form-control" value="Travelling from kampala<?php echo $row['fromPoint'];?> to Mbarara<?php echo $row['toPoint'];?>" readonly="readonly" /></td>
                </tr>
                <tr>
                  <td>Reference:</td>
                  <td><input type="text" name="reference" class="form-control" value="<?php echo uniqid();?>" readonly="readonly" />
                  <!-- (the Order ID ) -->
                  </td>
                </tr>
                <tr>
                  <td>First Name:</td>
                  <td><input type="text" name="first_name" class="form-control" value="Asiimwe" /></td>
                </tr>
                <tr>
                  <td>Last Name:</td>
                  <td><input type="text" name="last_name" class="form-control" value="Geofrey" /></td>
                </tr>
                <tr>
                  <td>Email Address:</td>
                  <td><input type="email" name="email" class="form-control" value="geofrocker2@gmail.com.com" /></td>
                </tr>
                <tr>
                  <td><input type="submit" class="btn btn-primary" value="Book Ticket" /></td>
                </tr>
              </table>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div>   
  </div>
<?php endblock() ?>