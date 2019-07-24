$(document).ready(function() {
    $('#trans_tbl').DataTable( {
        dom: 'Blfrtip',
        dom: '<"float-left"B><"float-right"f>rt<"row"<"col-sm-4"l><"col-sm-4"i><"col-sm-4"p>>',
        buttons: [
            'copy',
            //'csv',
            'excel',
            //'pdf'
            /*{
                extend: 'print',
                text: 'Print all (not just selected)',
                exportOptions: {
                    modifier: {
                        selected: null
                    }
                }
            }*/
        ],
        "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
        select: true
    } );
} );

$(document).ready(function(){
    $("select.btnload").change(function(){
        var selectedload = $(this).children("option:selected").val();
        //alert("You have selected load wallet - " + selectedCountry);
        switch (selectedload)
        {
        	case "smartTNT" :
        	$('#ILoad').children('option:not(:first)').remove();
        	$('#ILoad').append( '<option value="Smart TNT 300">SMART / TNT Load 300</option>' );
        	$('#ILoad').append( '<option value="Smart TNT 500">SMART / TNT Load 500</option>' );
        	$('#ILoad').append( '<option value="Smart TNT 1000">SMART / TNT Load 1000</option>' );
        	break;
        	case "sun" :
        	$('#ILoad').children('option:not(:first)').remove();
        	$('#ILoad').append( '<option value="Sun Cellular 300">Sun Cellular Load 300</option>' );
        	$('#ILoad').append( '<option value="Sun Cellular 500">Sun Cellular Load 500</option>' );
        	break;
        	case "freeBEE" :
        	$('#ILoad').children('option:not(:first)').remove();
        	$('#ILoad').append( '<option value="Free Bee 500 Mins Call">Free Bee 500 Minutes</option>' );
        	$('#ILoad').append( '<option value="Free Bee 1000 Mins Call">Free Bee 1000 Minutes</option>' );
        	break;
        }
    });
});

/*$(document).ready(function() {
	var e = document.getElementById("cc");
	var ccode = e.options[e.selectedIndex].value;

});*/

/*function test_swal() {
	var mno = document.getElementById("mob").value;
	var a = document.getElementById("ILoad");
	var load = a.options[a.selectedIndex].value;
	var e = document.getElementById("cc");
	var ccode = e.options[e.selectedIndex].value;
	//swal("sample");

	//swal("Are you sure you want to " + load + " to " + ccode + " - " + mno + " ?");

	swal({
	  title: "",
	  text: "Are you sure, you want to load " + load + " to " + ccode + "-" + mno + " ?",
	  icon: "warning",
	  buttons: ["Cancel", "Submit"],
	  //dangerMode: true,
	})
	.then((willSubmit) => {
	  if (willSubmit) {
	    //Submit form
	  } else {
	    //reload
	  }
	});

}*/

$(function () {
    $("#mform").submit(function (e) {
    	e.preventDefault();
	    var form = this;
	    var mno = document.getElementById("mob").value;
		var a = document.getElementById("ILoad");
		var load = a.options[a.selectedIndex].value;
		var e = document.getElementById("cc");
		var ccode = e.options[e.selectedIndex].value;


		if (mno == "" || load == "") {
			//alert("empty");
			swal("Mobile no. and / or Load are empty");
			e.preventDefault();
		}
		else{

			swal({
			  title: "",
			  text: "Are you sure, you want to load " + load + " to " + ccode + "-" + mno + " ?",
			  icon: "warning",
			  buttons: ["Cancel", "Submit"],
			  //dangerMode: true,
			})
			.then((willSubmit) => {
			  if (willSubmit) {
			    //Submit form
			    document.getElementById("btn_m").value = "581a91238a786c9ad97b7211acfada753a1fdb9f";
			    document.getElementById("mform").submit();
			  } else {
			    //reload
			    e.preventDefault();
			  }
			});
		}

    });
});