function showTables(data) {

    jQuery('#daftar').hide();

    selectedOne = jQuery(data.selected).find('td').eq('1').text(); //Name
    selectedTwo = jQuery(data.selected).find('td').eq('3').text(); //IC
    selectedTre = jQuery(data.selected).find('td').eq('2').text(); //No Ahli
    selectedFor = jQuery(data.selected).find('td').eq('4').text(); //Jantina
    selectedFiv = jQuery(data.selected).find('td').eq('6').text(); //KAWASAN
    selectedSix = jQuery(data.selected).find('td').eq('5').text(); //Negeri
    selectedSev = jQuery(data.selected).find('td').eq('7').text(); //Register

    // set the input value
    jQuery('#myTable1').text(selectedOne);
    jQuery('#myTable2').text(selectedTwo);
    jQuery('#myTable3').text(selectedTre);
    jQuery('#myTable4').text(selectedFor);
    jQuery('#myTable5').text(selectedFiv);
    jQuery('#myTable6').text(selectedSix);

    //Status Daftar
    if (selectedSev == 1) {
        jQuery('#myTable7').text("Sudah");
        jQuery('#myTable7').css({
            "background-color": "#79f289"
        });

        document.getElementById("ls_query").focus();
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


    var nokad = $("#myTable2").text();

    $.post("ajax/submit.php", {
        IC: nokad,
        Register: 1
    }, function (data) {

        if (data == "Berjaya") {
            // jQuery('#panel-berjaya').show();
            jQuery('#myModal').modal();
            jQuery('#myTable7').text("Sudah");
            jQuery('#myTable7').css({
                "background-color": "#79f289"
            });

            selectedSev = 1;

            $("#daftar").addClass("hidden");
        } else {
            jQuery('#myModal').modal();
            jQuery('#modalText').text("Pendaftaran Gagal. Sila hubungi urusetia.");
            jQuery('#modalText').css({
                "background-color": "#ffc793"
            });
        }
    });
}
function check(e) {
    if(e.key === "Enter") {
      $('#myModal').modal('toggle');
      document.getElementById("ls_query").focus();
    }
  } 

$('#myModal').on('show.bs.modal', function () {
    $('.container').addClass('blur');
 })
 
 $('#myModal').on('hide.bs.modal', function () {
    $('.container').removeClass('blur');
 })