<?php
include('base.php');
?>
<?php startblock('body') ?>
    <div class="jumbotron">
      <a href="">Where are you going?</a><br>
        
          <div class="col-md-3">
            <form method="post" action="routes.php" id="inputform">
                <div class="form-group">
                  <label>From:</label>

                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-paper-plane"></i>
                    </div>
                    <input type="text" class="form-control" name="from_point" required aria-required="true">
                  </div>
                  <!-- /.input group -->
                </div>
          </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>To:</label>

                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-paper-plane"></i>
                    </div>
                    <input type="text" class="form-control pull-right" name="to_point" required aria-required="true">
                  </div>
                  <button type="submit" class="btn btn-primary btn-flat pull-right">Get available routes</button>
                  <!-- /.input group -->
                </div> 
              </div><br><br><br>
              
          </form>
    </div>
  <center><img id="loading_spinner"­ src="static/img/loading.gif"></center>

  <div class="my_update_pan­el"></div>     
  </div>
</div>
</body>
<script>
  $('#loading_spinner'­).show();

  var post_data = "my_variable="+my_va­riable;
  $.ajax({
  url: 'routes.php',
  type: 'GET',
  data: post_data,
  dataType: 'html',
  success: function(data) {
  $('.my_update_panel'­).html(data);
  //Moved the hide event so it waits to run until the prior event completes //It hide the spinner immediately, without waiting, until I moved it here
  $('#loading_spinner'­).hide();
  },
  error: function() {
  alert("Something went wrong!");
  }
  });
</script>
<?php endblock() ?>