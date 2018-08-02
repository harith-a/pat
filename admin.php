<?php
require_once 'auth.php';

// HTML authentication
authHTML();

?>
  <!DOCTYPE html>
  <html>

  <head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar PAT 2017</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="assets/css/styles.css"> -->
    <!-- Live Search Styles -->
    <link rel="stylesheet" href="assets/css/admin.css">


  </head>

  <body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"
            aria-expanded="false">
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
            <li class="active">
              <a href="status.php">Statistik</a>
            </li>
            <li class="active">
              <a href="logout.php">Logout</a>
            </li>
          </ul>


        </div>
        <!-- /.navbar-collapse -->
      </div>
      <!-- /.container-fluid -->
    </nav>

    <div class="container">
      <!-- upload forms -->
      <div class="row">

        <div class="col-lg-6 col-sm-6 col-12">
          <h4>Upload Semua Ahli Berdaftar</h4>
          <form class="form-inline center-block well" action="" method="POST" enctype="multipart/form-data">
            <div class="input-group">
              <label id="browsebutton" class="btn btn-default input-group-addon" for="file" style="background-color:white">
                <input id="file" type="file" style="display:none;"> Browse...
              </label>
              <input id="label" type="text" class="form-control" readonly="">
            </div>
            <button type="button" id="upload" class="btn btn-primary">Upload</button>
            <span class="help-block">
              <small id="fileHelp" class="form-text text-muted">Only CSV with size less than 2MB is allowed.</small>
            </span>
          </form>
        </div>

        <div class="col-lg-6 col-sm-6 col-12">
          <h4>Upload Petugas</h4>
          <form class="form-inline center-block well" action="" method="POST" enctype="multipart/form-data">
            <div class="input-group">
              <label id="browsebutton2" class="btn btn-default input-group-addon" for="file2" style="background-color:white">
                <input id="file2" type="file" style="display:none;"> Browse...
              </label>
              <input id="label2" type="text" class="form-control" readonly="">
            </div>
            <button type="button" id="upload2" class="btn btn-primary">Upload</button>
            <span class="help-block">
              <small id="fileHelp" class="form-text text-muted">Only CSV with size less than 2MB is allowed.</small>
            </span>
          </form>
        </div>


      </div>

      <!-- modal reset confirmation -->
      <div class="row">
        <div class="col-lg-12">
          <div class="well">

            <button type="button" class="btn btn-lg btn-danger" data-toggle="modal" data-target="#resetModal">Reset Registration</button>
            <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="resetModal">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Confirm Reset?</h4>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-info" id="modal-btn-confirm">Yes</button>
                  </div>
                </div>
              </div>
            </div>


            <button type="button" class="btn btn-lg btn-danger" data-toggle="modal" data-target="#resetModal2">Delete All Items</button>
            <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="resetModal2">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Confirm Delete All Items?</h4>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-info" id="truncate-confirm">Yes</button>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    
    
    
    <!-- container -->
    </div>


    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script>
      $(document).ready(function () {

        $('#browsebutton :file').change(function (e) {
          var fileName = e.target.files[0].name;
          $("#label").attr('placeholder', fileName)
        });

        $('#browsebutton2 :file').change(function (e) {
          var fileName = e.target.files[0].name;
          $("#label2").attr('placeholder', fileName)
        });

        $('#upload').click(function () {
          var fd = new FormData();
          var files = $('#file')[0].files[0];
          fd.append('file', files);
          // check file available for upload
          if (files == null) {
            alert("No files selected.");
          } else {
            // AJAX request
            $.ajax({
              url: 'ajax/upload.php',
              type: 'post',
              data: fd,
              contentType: false,
              processData: false,
              success: function (response) {
                if (response != 0) {
                  // Show image preview
                  alert(response);
                } else {
                  alert('file not uploaded');
                }
              }
            });
          }
        });

        $('#upload2').click(function () {

          var fd = new FormData();
          var files = $('#file2')[0].files[0];
          fd.append('file', files);

          // check file available for upload
          if (files == null) {
            alert("No files selected.");
          } else {
            // AJAX request
            $.ajax({
              url: 'ajax/uploadpetugas.php',
              type: 'post',
              data: fd,
              contentType: false,
              processData: false,
              success: function (response) {
                if (response != 0) {
                  // Show image preview
                  alert(response);
                } else {
                  alert('file not uploaded');
                }
              },
              error: function (e){
                alert(e);
              }
            });
          }
        });
        
        $( "#resetModal" ).on('shown', function(){ 
          
          document.getElementById("modal-btn-confirm").focus();
        });

        $('#modal-btn-confirm').click(function () {
          // AJAX request
          $.ajax({
            url: 'ajax/reset.php',
            type: 'post',
            data: {
              "pendaftaran": "1"
            },
            contentType: false,
            processData: false,
            success: function (response) {
              if (response != 0) {
                alert(response);
              } else {
                alert("Reset failed!")
              }
            },
            error: function (xhr, error) {
              console.debug(xhr);
              console.debug(error);
            }
          });
          $("#resetModal").modal('hide');
        });


        $('#truncate-confirm').click(function () {
          // AJAX request
          $.ajax({
            url: 'ajax/truncate.php',
            type: 'post',
            data: {
              "truncate": "1"
            },
            contentType: false,
            processData: false,
            success: function (response) {
              if (response != 0) {
                alert(response);
              } else {
                alert("Reset failed!")
              }
            },
            error: function (xhr, error) {
              console.debug(xhr);
              console.debug(error);
            }
          });
          $("#resetModal2").modal('hide');
        });
          
        

      });
    </script>

  </body>

  </html>