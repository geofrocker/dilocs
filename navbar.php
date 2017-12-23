<?php

?>
<nav class="navbar navbar-inverse">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">Ideal Trips</a>
    </div>
    <div id="navbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li><a href="index.php">Home</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
         <?php
          if(!isset($_SESSION['login_user'])){

        ?>
        <li><a href="register.php">Register</a></li>
        <li><a href="login.php">Login</a></li>
        <?php
          }
          else{
        ?>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Hello Geofrey<b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li>
                    <a href="message.php"><i class="fa fa-fw fa-envelope"></i> Inbox <span class="badge">0</span></a>
                </li>
                <li>
                    <a data-toggle="modal" href="#passwordModal"><i class="fa fa-fw fa-gear"></i> Settings</a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                </li>
            </ul>
        </li>
        <?php
          }
        ?>
      </ul>
    </div><!--/.nav-collapse -->
</nav>