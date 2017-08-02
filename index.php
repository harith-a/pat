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
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar PAT 2017</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
     <!-- Live Search Styles -->
    <link rel="stylesheet" href="css/fontello.css">
    <link rel="stylesheet" href="css/animation.css">

    <!--[if IE 7]>
    <link rel="stylesheet" href="css/fontello-ie7.css">
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="css/ajaxlivesearch.css">

    <style>
       /*  .btn-default{
            background:#b9cd6d;
            opacity: ;
            border: 1px solid #b9cd6d;
            color: #FFFFFF;
            font-weight: bold;
       */  }
      </style>
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
      <a class="navbar-brand" href="#">Perhimpinan Ahli Teras 2017</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

      <ul class="nav navbar-nav navbar-right">
        <li class="active"><a href="status.php">Statistik</a></li>
      </ul>
      
      
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

    <div class="col-md-12">
        <div class="page-header">
            <h1 class="text-center">Pendaftaran</h1>
        </div>
    </div>
    
    <div class="col-md-6 col-md-offset-3 col-centered hidden" id="wrapper">
    	<div style="clear: both;" >
		    <input type="text" class='mySearch' id="ls_query" placeholder="Sila Taip Nama atau No Kad Pengenalan">
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
                        <td class="active">No Ahli</td>
                        <td id="myTable3"></td>
                    </tr>
                    <tr>
                        <td class="active">Jantina </td>
                        <td id="myTable4"></td>
                    </tr>
                    <tr>
                        <td class="active">Daerah </td>
                        <td id="myTable5"></td>
                    </tr>
                    <tr>
                        <td class="active">Negeri </td>
                        <td id="myTable6"></td>
                    </tr>
                    <tr>
                        <td class="active">Daftar </td>
                        <td id="myTable7"></td>
                    </tr>
                    <!-- <tr>
                        <td class="active">Badge</td>
                        <td id="myTable8"></td>
                    </tr> -->
                </tbody>
            </table>
        </div>
    </div>
    <!-- <div class="col-md-4 col-md-offset-3">
        <h4 class="text-center" id="myTable7">Status: Belum Daftar </h4>
        <h4 class="text-center" id="myTable8">Badge: Belum Terima</h4>
   </div> -->
    <div class="col-md-4 col-md-offset-4">
    <div class="centerme">
        <button class="btn btn-default hidden" type="button" id="daftar" onclick="buttonD()">Daftar</button>
    </div>
    </div>
	
    <!-- <div id="dialog-1" title="Status Pendaftaran"></div> -->



	<div class="col-md-4 col-md-offset-4">
	<p></p>
    <div class="panel panel-success" id="panel-berjaya">
      <div class="panel-heading">Pendaftaran Berjaya</div>
    </div>
    <div class="panel panel-danger" id="panel-gagal">
      <div class="panel-heading">Pendaftaran Gagal. Sila hubungi urusetia.</div>
    </div>
    </div>
        
	<!-- Placed at the end of the document so the pages load faster -->

    <!-- <script src="assets/js/jquery.min.js"></script> -->
    
    <script src="js/jquery-1.11.1.min.js"></script>
    
    <!-- jquery online -->
    <!-- <link href="css/jquery-ui.css" rel="stylesheet"> -->
    <!-- <script src="js/jquery-1.10.2.js"></script> -->
    <!-- <script src="js/jquery-ui.js"></script> -->
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
<!-- Live Search Script -->
	<script type="text/javascript" src="js/ajaxlivesearch.js"></script>

<script>

jQuery(document).ready(function(){

    $("#wrapper").removeClass("hidden");
    $("#wrapper").show();

	jQuery(".mySearch").ajaxlivesearch({
        loaded_at: <?php echo $time; ?>,
        page_range_default: 10,
        cache: true,
        token: <?php echo "'" . $token . "'"; ?>,
        maxInput: <?php echo $maxInputLength; ?>,
        onResultClick: function(e, data) {
            
        	showTables(data);
            jQuery('#panel-berjaya').hide();
            jQuery('#panel-gagal').hide();

        },
        onResultEnter: function(e, data) {

            showTables(data);
            jQuery('#panel-berjaya').hide();
            jQuery('#panel-gagal').hide();

        },
        onAjaxComplete: function(e, data) {

        }
    });
    
    
    document.getElementById("ls_query").focus();


    jQuery('#panel-berjaya').hide();
    jQuery('#panel-gagal').hide();

    // $( "#dialog-1" ).dialog({
            //    autoOpen: false,  
            // });
    // $('#dialog-1').append('Pendaftaran Berjaya!')

})




function showTables(data){

            jQuery('#daftar').hide();

            selectedOne = jQuery(data.selected).find('td').eq('1').text();	//Name
            selectedTwo = jQuery(data.selected).find('td').eq('3').text();  //IC
            selectedTre = jQuery(data.selected).find('td').eq('2').text();  //No Ahli
            selectedFor = jQuery(data.selected).find('td').eq('4').text();  //Jantina
            selectedFiv = jQuery(data.selected).find('td').eq('6').text();  //Daerah
            selectedSix = jQuery(data.selected).find('td').eq('5').text();  //Negeri
            selectedSev = jQuery(data.selected).find('td').eq('7').text();  //Register

            
            // set the input value
            jQuery('#myTable1').text(selectedOne);
            jQuery('#myTable2').text(selectedTwo);
            jQuery('#myTable3').text(selectedTre);
            jQuery('#myTable4').text(selectedFor);
            jQuery('#myTable5').text(selectedFiv);
            jQuery('#myTable6').text(selectedSix);
            
            //Status Daftar
            if(selectedSev == 1)
            	{
            		jQuery('#myTable7').text("Sudah");
                    document.getElementById("ls_query").focus();
        		}
            else
            	{
                    jQuery('#myTable7').text("Belum");
                    $("#daftar").removeClass("hidden");
                    jQuery('#daftar').show();
                    document.getElementById("daftar").focus();
                }
            
            

            // hide the result & empty search bar        	
            jQuery(".mySearch").trigger('ajaxlivesearch:hide_result');
            jQuery('.mySearch').val("");
            

}


function buttonD(){


	var nokad = $("#myTable2").text();
	
		$.post( "ajax/submit.php", { IC: nokad, Register: 1 }, function( data ) {
		  
          if (data == "Berjaya"){
              jQuery('#panel-berjaya').show();
            //   $("#dialog-1").text('Pendaftaran berjaya.')
            //   $("#dialog-1").dialog( "open" );


    		  jQuery('#myTable7').text("Sudah");

              selectedSev = 1;

              $("#daftar").addClass("hidden");
            
              document.getElementById("ls_query").focus();
            

          }
          else{
            // $('#dialog-1').text('Pendaftaran gagal, sila hubungi pembantu teknikal.')
            // $( "#dialog-1" ).dialog( "open" );
            // alert("Pendaftaran Gagal");
            jQuery('#panel-gagal').show();
            document.getElementById("ls_query").focus();
          }


		});
			
	
		
}


 


</script>

</body>

</html>
