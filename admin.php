<?php
require_once 'auth.php';

// HTML authentication
authHTML();

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar PAT 2017</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="assets/css/styles.css"> -->
     <!-- Live Search Styles -->
    <link rel="stylesheet" href="css/fontello.css">
    <link rel="stylesheet" href="css/animation.css">

    <!--[if IE 7]>
    <link rel="stylesheet" href="css/fontello-ie7.css">
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="css/ajaxlivesearch.css">

</head>

<body>

<!-- NAVBAR -->
  <nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/">Perhimpunan Ahli Teras 2017</a>

    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

      <ul class="nav navbar-nav navbar-right">
        <li class="active"><a href="status.php">Statistik</a></li>
        <li class="active"><a href="logout.php">Logout</a></li>
      </ul>
      
      
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

  <div class="container">
          <div class="row">
            <div class="col-lg-12">
               <form class="well" action="" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="file">Select a file to upload</label>
                    <input type="file" id="file" aria-describedby="fileHelp">
                    <small id="fileHelp" class="form-text text-muted">Only CSV with size less than 2MB is allowed.</small>
                  </div>
                  <!-- <div class="form-group">
                    <label for="file">Select a file to upload</label>
                    <input type="file" name="file" id='file' class="btn btn-success">
                    <p class="help-block">Only CSV with size less than 2MB is allowed.</p>
                  </div> -->
                  <input type="button" class="btn btn-lg btn-primary" value="Upload" id="upload">
                </form>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="well">
                <div type="button" class="btn btn-lg btn-danger" id="reset">Reset Registration</div> 
              </div>
            </div>
          </div>
  </div> 




<script src="assets/js/jquery.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){
  $('#upload').click(function(){

    var fd = new FormData();
    var files = $('#file')[0].files[0];
    fd.append('file',files);

    // AJAX request
    $.ajax({
      url: 'ajax/upload.php',
      type: 'post',
      data: fd,
      contentType: false,
      processData: false,
      success: function(response){
        if(response != 0){
          // Show image preview
          alert(response);
        }else{
          alert('file not uploaded');
        }
      }
    });

  });

$('#reset').click(function(){
  // AJAX request
  $.ajax({
    url: 'ajax/reset.php',
    type: 'post',
    data: { "reset": "1"},
    contentType: false,
    processData: false,
    success: function(response){
      if (response != 0) {
          alert(response);
      } else {
        alert("Reset failed!")
      }
    },
    error: function(xhr, error){
        console.debug(xhr); console.debug(error);
    }
  });
});

});
</script>

</body>
</html>