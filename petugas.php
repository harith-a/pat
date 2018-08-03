<?php
file_exists(__DIR__ . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'Handler.php') ? require_once __DIR__ . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'Handler.php' : die('There is no such a file: Handler.php');
file_exists(__DIR__ . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'Config.php') ? require_once __DIR__ . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'Config.php' : die('There is no such a file: Config.php');

use AjaxLiveSearch\core\Config;
use AjaxLiveSearch\core\Handler;

if (session_id() == '') {
    session_start();
}

    Handler::getJavascriptAntiBot();
    $token = Handler::getToken();
    $time = time();
    $maxInputLength = Config::getConfig('maxInputLength');
?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Daftar Petugas PAT 2018</title>
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/styles.css">
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
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"
                        aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Perhimpunan Ahli Teras 2018</a>

                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                    <ul class="nav navbar-nav navbar-right">
                        <li class="active">
                            <a href="status.php">Statistik</a>
                        </li>
                        <li class="active">
                            <a href="admin.php">Admin</a>
                        </li>
                    </ul>


                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
        </nav>
        <div class="container"></div>
        <div class="col-md-12">
            <div class="page-header">
                <h1 class="text-center">Pendaftaran Petugas</h1>
            </div>
        </div>

        <div class="col-md-6 col-md-offset-3 col-centered hidden" id="wrapper">
            <div style="clear: both;">
                <input type="text" class='mySearch' id="ls_query_2" placeholder="Sila Taip Nama atau No Kad Pengenalan">
            </div>
        </div>

        <div class="col-md-8 col-md-offset-2">
            <div class="table-responsive">
                <table class="table">
                    <tbody>
                        <tr>
                            <td class="active">Nama </td>
                            <td id="myTable1"></td>
                        </tr>
                        <tr>
                            <td class="active">No Kad Pengenalan</td>
                            <td id="myTable2"></td>
                        </tr>
                        
                        <tr>
                            <td class="active">Daftar </td>
                            <td id="myTable7"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-4 col-md-offset-4">
            <div class="centerme">
                <button class="btn btn-default hidden" type="button" id="daftar" onclick="buttonD()">Daftar</button>
            </div>
        </div>
        </div>


        <div id="myModal" class="modal" tabindex="-1" onkeypress="check(event)">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <h4 id="modalText">Pendaftaran Berjaya</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Placed at the end of the document so the pages load faster -->
        <script src="js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <!-- Live Search Script -->
        <script type="text/javascript" src="js/ajaxlivesearch.js"></script>
        <script>
            jQuery(document).ready(function () {

                $("#wrapper").removeClass("hidden");
                $("#wrapper2").removeClass("hidden");
                $("#wrapper").show();

                jQuery(".mySearch").ajaxlivesearch({
                    loaded_at: <?php echo $time; ?>,
                    page_range_default: 10,
                    cache: true,
                    token: <?php echo "'" . $token . "'"; ?>,
                    maxInput: <?php echo $maxInputLength; ?>,
                    onResultClick: function (e, data) {

                        showTables(data);
                        jQuery('#panel-berjaya').hide();
                        jQuery('#panel-gagal').hide();

                    },
                    onResultEnter: function (e, data) {

                        showTables(data);
                        jQuery('#panel-berjaya').hide();
                        jQuery('#panel-gagal').hide();

                    },
                    onAjaxComplete: function (e, data) {

                    }
                });


                document.getElementById("ls_query_2").focus();


                jQuery('#panel-berjaya').hide();
                jQuery('#panel-gagal').hide();

            })

            function showTables(data) {

                jQuery('#daftar').hide();

                selectedOne = jQuery(data.selected).find('td').eq('1').text(); //Name
                selectedTwo = jQuery(data.selected).find('td').eq('2').text(); //IC

                
                selectedSev = jQuery(data.selected).find('td').eq('3').text(); //Register

                // set the input value
                jQuery('#myTable1').text(selectedOne);
                jQuery('#myTable2').text(selectedTwo);
                

                //Status Daftar
                if (selectedSev == 1) {
                    jQuery('#myTable7').text("Sudah");
                    jQuery('#myTable7').css({
                        "background-color": "#79f289"
                    });

                    document.getElementById("ls_query_2").focus();
                } else {
                    jQuery('#myTable7').text("Belum");
                    jQuery('#myTable7').css({
                        "background-color": "#ffc793"
                    });
                    $("#daftar").removeClass("hidden");
                    jQuery('#daftar').show();
                    document.getElementById("daftar").focus();
                }



                // hide the result & empty search bar        	
                jQuery(".mySearch").trigger('ajaxlivesearch:hide_result');
                jQuery('.mySearch').val("");


            }


            function buttonD() {           

                $.post("ajax/submitpetugas.php", {
                    IC: selectedTwo,
                    Register: 1
                }, function (data) {

                    if (data == "Berjaya") {

                        jQuery('#myModal').modal();
                        jQuery('#myTable7').text("Sudah");
                        jQuery('#myTable7').css({
                            "background-color": "#79f289"
                        });

                        selectedSev = 1;

                        $("#daftar").addClass("hidden");
                    } 
                    else {
                        jQuery('#myModal').modal();
                        jQuery('#modalText').text("Pendaftaran Gagal. Sila hubungi urusetia.");
                        jQuery('#modalText').css({
                            "background-color": "#ffc793"
                        });
                    }
                });
            }

            function check(e) {
                if (e.key === "Enter") {
                    $('#myModal').modal('toggle');
                    document.getElementById("ls_query_2").focus();
                }
            }

            $('#myModal').on('show.bs.modal', function () {
                $('.container').addClass('blur');
            })

            $('#myModal').on('hide.bs.modal', function () {
                $('.container').removeClass('blur');
            })
        </script>
    </body>

    </html>