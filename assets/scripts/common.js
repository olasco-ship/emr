$(document).ready(function(e) {

	// sidebar navigation
	$('#main-menu').metisMenu();

	// sidebar nav scrolling
	$('#left-sidebar .sidebar-scroll').slimScroll({
		height: '95%',
		wheelStep: 5,
		touchScrollStep: 50,
		color: '#cecece'
	});

	// toggle fullwidth layout
	$('.btn-toggle-fullwidth').on('click', function() {
		if(!$('body').hasClass('layout-fullwidth')) {
			$('body').addClass('layout-fullwidth');
			$(this).find(".fa").toggleClass('fa-angle-left fa-angle-right');

			$(this).animate({
				left: "+=28px"
			}, 800);

		} else {
			$('body').removeClass('layout-fullwidth');
			$(this).find(".fa").toggleClass('fa-angle-left fa-angle-right');

			$(this).animate({
				left: "-=28px"
			}, 800);
		}
	});

	// off-canvas menu toggle
	$('.btn-toggle-offcanvas').on('click', function() {
		$('body').toggleClass('offcanvas-active');
	});

	$('#main-content').on('click', function() {
		$('body').removeClass('offcanvas-active');
	});

	// adding effect dropdown menu
	$('.dropdown').on('show.bs.dropdown', function() {
		$(this).find('.dropdown-menu').first().stop(true, true).animate({
			top: '100%'
		}, 200);
	});

	$('.dropdown').on('hide.bs.dropdown', function() {
		$(this).find('.dropdown-menu').first().stop(true, true).animate({
			top: '80%'
		}, 200);
	});

	// navbar search form
	$('.navbar-form.search-form input[type="text"]')
	.on('focus', function() {
		$(this).animate({
			width: '+=50px'
		}, 300);
	})
	.on('focusout', function() {
		$(this).animate({
			width: '-=50px'
		}, 300);
	});

	// Bootstrap tooltip init
	if($('[data-toggle="tooltip"]').length > 0) {
		$('[data-toggle="tooltip"]').tooltip();
	}

	if($('[data-toggle="popover"]').length > 0) {
		$('[data-toggle="popover"]').popover();
	}

	$(window).on('load', function() {
		// for shorter main content
		if($('#main-content').height() < $('#left-sidebar').height()) {
			$('#main-content').css('min-height', $('#left-sidebar').innerHeight() - $('footer').innerHeight());
		}
	});

	$(window).on('load resize', function() {
		if($(window).innerWidth() < 360) {
			$('.navbar-brand img.logo').attr('src', 'theme/assets/img/logo-minimal.png');
		} else {
			$('.navbar-brand img.logo').attr('src', 'theme/assets/img/logo.png');
		}
	});


	//Mohit Js Work
	// window.ParsleyValidator.addValidator('ward_number', 
	// 	function(value) {
	// 		var response = false;
	// 	    $.ajax({
	// 			url: 'wards.php',
	// 			data : {ward_name : value},
	// 			type: "GET",
	// 			dataType: 'json',
	// 			async: false,
	// 			success : function(data){
	// 				if(data == 'success'){
	// 					response = false;
	// 				}else{
	// 					response = true;
	// 				}
					
	// 			},
	// 			error : function(error){
	// 				response = false;
	// 			}
	// 		});
	// 		alert(response);
	// 		return response;
	//   }, 32).addMessage('en', 'ward_number', 'The ward number already exists.');

	
	
	
	
	
	
	
	
	
	
	// $("#ward_number").keyup(function(e){
	// 	e.preventDefault();
	// 	$(".btnSubmit").attr("disabled", true);
	// 	$.ajax({
	// 		url: 'wards.php',
	// 		data : {ward_name : $(this).val(), update : $("#update_id").val()},
	// 		type: "GET",
	// 		dataType: 'json',
	// 		async: false,
	// 		success : function(data){
	// 			if(data == 'success'){
	// 				$(".wardError").hide();
	// 				$(".btnSubmit").attr("disabled", false);
	// 			}else{
	// 				response = true;
	// 				$(".wardError").show();
	// 				$(".btnSubmit").attr("disabled", true);
	// 			}
				
	// 		},
	// 		error : function(error){
	// 			response = false;
	// 		}
	// 	});
	// });
	$("#wardForm").parsley({ trigger: 'change'});

	// Search Ward according to location
	$(".bed_location_id").change(function(){
		var urls = $(".urlWard").val();
		//'../revenue/beds.php',
		$.ajax({
			url: urls ,
			data : {ward_id : $(this).val()},
			type: "GET",
			success : function(data){
				$(".ward_id").empty();
					$(".ward_id").html(data);
				
			},
			error : function(error){
				alert("Error in connection");
			}
		});
	});

	//Ward show according to location and change room no.
	$(".ward_change").change(function(){
		//alert($(".bed_location_id").val());
		var typeLog = $(".typeLogin").val();
		$.ajax({
			url: typeLog ,
			data : {location_id : $(".bed_location_id").val() ,ward_id_change_room : $(this).val()},
			type: "GET",
			success : function(data){
				$(".room_no").empty();
					$(".room_no").html(data);
				
			},
			error : function(error){
				alert("Error in connection");
			}
		});
	});

	// Room number according to bed jquery
	$(".room_no").change(function(){
		//alert($(this).children("option:selected").html());
		var typeLog = $(".typeLogin").val();
		var patId = $("#pat_hide_id").val();
		$.ajax({
			url: typeLog ,
			data : {bed_location_id : $(".bed_location_id").val() ,bed_ward_id_change_room : $(".ward_change").val(), room_no_id : $(this).children("option:selected").html(), patientId: patId, room_no_main_id : $(this).children("option:selected").val() },
			type: "GET",
			success : function(data){
				$(".bed_no").empty();
					$(".bed_no").html(data);
				
			},
			error : function(error){
				alert("Error in connection");
			}
		});
	});

	//Bed Number Check

});

// toggle function
$.fn.clickToggle = function( f1, f2 ) {
	return this.each( function() {
		var clicked = false;
		$(this).bind('click', function() {
			if(clicked) {
				clicked = false;
				return f2.apply(this, arguments);
			}

			clicked = true;
			return f1.apply(this, arguments);
		});
	});

};
function editIpdService(id, name ,charges){
	window.scrollTo(0, 0);
	$("#service_name").val(name);
	$("#ipd_id").val(id);
	$("#daily_charges").val(charges);
}

function editLocation(id, name){
	window.scrollTo(0, 0);
	$(".location_name").val(name);
	$("#location_id").val(id);
}

function deleteLocation(id){
	//var a = confirm("Are your sure to delete");
	if(confirm("Are your sure to delete") == true){
		window.location = 'location.php?id='+id;
		// $.ajax({
		// 	url: 'location.php?id='+id,
		// 	data : {id : id},
		// 	type: "GET",
		// 	success : function(data){
		// 		var par = JSON.parse(data);
		// 		if(par.status){
		// 			$("#locationId"+id).fadeOut();
		// 		}else{
		// 			alert("Error In delete");
		// 		}
		// 	},
		// 	error : function(error){
				
		// 	}
		// })
		//return true;
		
	}else{
		return false;
	}
}

function editWard(id, location_id, ward_number, gender){
	window.scrollTo(0, 0);
	$("#update_id").val(true);
	$("#ward_id").val(id);
	$("#ward_number").val(ward_number);
	if(gender == 'male'){
		$(".m").attr('checked', "checked");
		$(".m").val(gender);
	}else if(gender == "female"){
		$(".f").attr('checked', "checked");
		$(".f").val(gender);
	}else{
		$(".o").attr('checked', "checked");
		$(".o").val(gender);
	}
	
	$(".location_id option[value='"+location_id+"']").attr("selected", "selected");;
}

function deleteWard(id){
	if(confirm("Are your sure to delete") == true){
		window.location = 'wards.php?id='+id;
	}else{
		return false;
	}
}

function editBed(id, bed_location_id, ward_id, room_number, bed_no_to, bed_no_from){
	//$("#update_id").val(true);
	window.scrollTo(0, 0);
	$("#bed_id").val(id);
	
	$(".bed_location_id option[value='"+bed_location_id+"']").attr("selected", "selected");
	$.ajax({
		url: 'beds.php',
		data : {ward_id_edit : bed_location_id, ward_id_selected: ward_id, bed_id : id},
		type: "GET",
		success : function(data){
			$(".ward_id").empty();
			$(".ward_id").html(data);
		},
		error : function(error){
			alert("Error in connection");
		}
	});
	//$(".ward_id option[value='"+ward_id+"']").attr("selected", "selected");
	$("#room_number").val(room_number);	
	$("#bed_no_to").val(bed_no_to);	
	$("#bed_no_from").val(bed_no_from);	
}

function deleteBed(id){
	if(confirm("Are your sure to delete") == true){
		window.location = 'beds.php?id='+id;
	}else{
		return false;
	}
}

function deleteDrug(id){
	if(confirm("Are your sure to delete") == true){
		window.location = 'review_drug?id='+id;
	}else{
		return false;
	}
}


function initSparkline() {
	$(".sparkline").each(function() {
		var $this = $(this);
		$this.sparkline('html', $this.data());
    });
    
    // block-header bar chart js
    $('.bh_visitors').sparkline('html', {
        type: 'bar',
        height: '42px',
        barColor: '#a27ce6',
        barWidth: 5,
    });
    $('.bh_visits').sparkline('html', {
        type: 'bar',
        height: '42px',
        barColor: '#3eacff',
        barWidth: 5,
    });
    $('.bh_chats').sparkline('html', {
        type: 'bar',
        height: '42px',
        barColor: '#50d38a',
        barWidth: 5,
	});
	



	
}