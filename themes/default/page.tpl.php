<?php 
   global $root_url, $root_dir, $page_title;
?>
<html lang="en">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head><title>PicoPanel@<?php echo gethostname() ?> - <?php echo $page_title ?></title></head>

<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.1/css/bootstrap.min.css">

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script src="js/jquery.ui.touch-punch.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.1/js/bootstrap.min.js"></script>

<script src="js/PicoPanel.js"></script>
<style>
  body { background: #dddddd }
  .panel {
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
  }
  .panel-plain {
     box-shadow: none;
  }
  
  .navbar {
     box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
  }
  
  .progress-mem-swap {
     background-color: #DFF0D8;
  }
  
  .progress-mem-used {
     background-color: #428BCA;
  }
  
  
</style>
<body>

   <div id="wrap">
      <div class="navbar navbar-default" role="navigation">
         <div class="container">
            <div class="navbar-header">
               <a class="navbar-brand" href="<?php echo $root_url ?>">Pico Panel</a>
            </div>

            <ul class="nav navbar-nav">
               <li class="<?php if($page_title=='index') echo "active" ?>"><a href="<?php echo $root_url ?>">Home</a></li>
               <li class="<?php if($page_title=='config') echo "active" ?>"><a href="<?php echo $root_url ?>?section=config"><span class="glyphicon glyphicon-cog"></span> Config</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
               <li class="<?php if($page_title=='about') echo "active" ?>"><a href="<?php echo $root_url ?>?page=about">About</a></li>
            </ul>

         </div>
      </div>



      <div class="container">
         <div class="row" id="notification-area" style="margin-left:0"></div>
         <?php echo $page_content ?>
      </div>
   </div>
</body>
