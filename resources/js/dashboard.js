$(document).ready(function() {


    $('#logsTable').DataTable( {
        "ajax": base_url + 'get-logs',
        language: { 
            infoEmpty: "No results to show",
            emptyTable: "No results to show",
            zeroRecords: "No results to show"
        },
        "columns": [
            { "data": "id", "defaultContent": "" },
            { "data": "action", "defaultContent": "" },
            { "data": "admin", "defaultContent": "Custom Package" },
            { "data": "date_time", "defaultContent": "" },
        ],
        'paging'      : true,
        'lengthChange': false,
        'searching'   : true,
        'ordering'    : false,
        'info'        : true,
        'autoWidth'   : false
    });

    $('.print-res').on('click', function() {
        $("#myChart").get(0).toBlob(function(blob) {
            saveAs(blob, "reservations_chart.jpg");
        });
    });

    $('.print-sales').on('click', function() {
        $("#sales-chart").get(0).toBlob(function(blob) {
            saveAs(blob, "sales_chart.jpg");
        });
    });

    window.setInterval(function(){
        $.ajax({
            url: base_url + 'get-notifications',
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.length > 0) {
                    $("#resBadge").html('NEW ' + response.length);
                    $("#resBadge").removeClass('hide');
                } else {
                    $("#resBadge").html('');
                    $("#resBadge").addClass('hide');
                }
            },
            failure: function(response) {
                console.log(response); 
            }
        });
    }, 5000);

    $("#btnSaveAbout").on('click', function() {
        if ($("#about_text").val().length < 1 || $("#about_contact").val().length < 1 || $("#about_address").val().length < 1) {
            $('.error-about').removeClass('hide');
        } else {
            $('.error-about').addClass('hide');

            $.ajax({
                url: base_url + 'save-about',
                method: 'POST',
                dataType: 'json',
                data: {
                    contact_no: $("#about_contact").val(),
                    address: $("#about_address").val(),
                    display: $("#about_text").val()
                },
                success: function(response) {
                    if (response == 1) {
                        location.reload();
                    } else {
                        alert('An error occured, ' + response.responseText);
                    }
                },
                failure: function(response) {
                    alert('An error occured, ' + response.responseText);
                }
            });
        }
    }); 

    $("#btnSaveTerm").on('click', function() {
        if ($("#term").val().length < 1) {
            $("#term").css('border-color', 'red');
            $('.error-div').removeClass('hide');
        } else {
            $("#term").css('border-color', '#ccc');
            $('.error-div').addClass('hide');

            $.ajax({
                url: base_url + 'save-term',
                method: 'POST',
                dataType: 'json',
                data: {
                    term: $("#term").val()
                },
                success: function(response) {
                    if (response == 1) {
                        location.reload();
                    } else {
                        alert('An error occured, ' + response.responseText);
                    }
                },
                failure: function(response) {
                    alert('An error occured, ' + response.responseText);
                }
            });
        }
    }); 

    $(".term-item").on('click', function() {
        $.get({
            url: base_url + 'get-term/' + $(this).data('id'),
            success: function (response) {
                $('#update_term').val(response.term);
                $("#hidden_term_id").val(response.id);
                $("#editTerm").modal('show');
            },
            dataType: 'json'
        })
    }); 

    $("#btnUpdateTerm").on('click', function() {
        if ($("#update_term").val().length < 1) {
            $("#update_term").css('border-color', 'red');
            $('.error-div').removeClass('hide');
        } else {
            $("#update_term").css('border-color', '#ccc');
            $('.error-div').addClass('hide');

            $.ajax({
                url: base_url + 'update-term/' + $("#hidden_term_id").val(),
                method: 'POST',
                dataType: 'json',
                data: {
                    term: $("#update_term").val()
                },
                success: function(response) {
                    if (response == 1) {
                        location.reload();
                    } else {
                        alert('An error occured, ' + response.responseText);
                    }
                },
                failure: function(response) {
                    alert('An error occured, ' + response.responseText);
                }
            });
        }
    }); 

    $("#btnDeleteTerm").on('click', function() {
        $.ajax({
            url: base_url + 'delete-term/' + $("#hidden_term_id").val(),
            method: 'POST',
            success: function(response) {
                if (response == 1) {
                    location.reload();
                } else {
                    alert('An error occured, ' + response.responseText);
                }
            },
            failure: function(response) {
                alert('An error occured, ' + response.responseText);
            }
        });
    });

    $("#venue_image").on('change', function() {
        readURL(this, $("#venueImagePreview"));
        $("#preview-box").removeClass('hide');
    });

    var venue_error = 0;
    function validateVenue(v) {
        if (v.val().length < 1) {
            v.css('border-color', '#e74c3c');
            venue_error += 1;
        } else {
            v.css('border-color', '#ccc');
        }
    }    

    $("#btnCreateVenue").on('click', function() {

        var inputs = [$("#venue_name"), $("#venue_description")];

        var file_data = $('#venue_image').prop('files')[0];
        var form_data = new FormData();
        form_data.append('file', file_data);

        venue_error = 0;
        for (var i = 0; i < inputs.length; i++) {
            validateVenue(inputs[i]);
        }

        if (typeof file_data == 'undefined') {
            venue_error = 1;
            $("#venue_image").css('border-color', '#e74c3c');
        } else {
            venue_error = 0;
            $("#venue_image").css('border-color', '#ccc');
        }

        if (venue_error != 0) {
            $('.error-div').text('Please complete all required fields');
            $('.error-div').removeClass('hide');
            $('html, body').animate({
                scrollTop: $(".error-div").offset().top - 70
            }, 500);
        } else {
            if (typeof file_data != 'undefined') {
                var form_data = new FormData();
                form_data.append('file', file_data);    

                $("#btnCreateVenue").attr('disabled', 'disabled');

                $.ajax ({
                    url: base_url + 'venues/do_upload',
                    dataType: 'text',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    type: 'post',
                    success: function (response) {
                        if (response == 1) {
                            $.ajax({
                                url: base_url + 'venues/store',
                                method: 'POST',
                                dataType: 'json',
                                data: {
                                    name: $("#venue_name").val(),
                                    description: $("#venue_description").val(),
                                },
                                success: function(response) {
                                    if (response == 1) {
                                        location.href = '/venues';
                                    }                           
                                },
                                failure: function(response) {
                                    alert('An unexpected error occured, ' + response.statusText);
                                    $("#btnCreateVenue").attr('disabled', false);
                                }
                            });
                        } else {
                            alert('An unexpected error occured, ' + response);
                            $("#btnCreateVenue").attr('disabled', false);
                        }
                    },
                    error: function (response) {
                        alert('An unexpected error occured, ' + response.statusText);
                        $("#btnCreateVenue").attr('disabled', false);
                    }
                });
            }
        }
    });

    $('.showVenueInfo').on('click', function() {
        $.ajax({
            url: base_url + 'venues/get-single/' + $(this).data('id'),
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                $("#update_venue_name").val(response.name);
                $("#update_venue_desc").val(response.description);
                $("#update_venue_preview").attr('src', base_url + response.image.current_path);

                $("#updateVenue").modal('show');
            },
            failure: function(response) {
                alert('An unexpected error occured', response.responseText);
            }
        });
    }); 

    var venue_error_update = 0;
    function validateVenueUpdate(v) {
        if (v.val().length < 1) {
            v.css('border-color', '#e74c3c');
            venue_error_update += 1;
        } else {
            v.css('border-color', '#ccc');
        }
    }

    $("#update_venue_image").on('change', function() {
        readURL(this, $("#update_venue_preview"));
    });

    $("#btnUpdateVenue").on('click', function() {

        var file_data = $('#update_venue_image').prop('files')[0];
        var form_data = new FormData();
        form_data.append('file', file_data);

        var inputs = [$("#update_venue_name"), $("#update_venue_desc")];

        venue_error_update = 0;
        for (var i = 0; i < inputs.length; i++) {
            validateVenueUpdate(inputs[i]);
        }

        if (venue_error_update != 0) {
            $('.error-div').text('Please complete all required fields');
            $('.error-div').removeClass('hide');
            $('html, body').animate({
                scrollTop: $(".error-div").offset().top - 70
            }, 500);
        } else {

            $("#btnUpdateVenue").attr('disabled', 'disabled');

            if (typeof file_data != 'undefined') {
                var form_data = new FormData();
                form_data.append('file', file_data);    

                $.ajax ({
                    url: base_url + 'venues/do_upload',
                    dataType: 'text',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    type: 'post',
                    success: function (response) {
                        if (response == 1) {
                            updateVenueData();
                        } else {
                            alert('An unexpected error occured, ' + response);
                            $("#btnUpdateVenue").attr('disabled', false);
                        }
                    },
                    failure: function (response) {
                        alert('An unexpected error occured, ' + response.responseText);
                        $("#btnUpdateVenue").attr('disabled', false);
                    }
                });
            } else {
                updateVenueData();
            }
        }
    });

    function updateVenueData() {
        $.ajax ({
            url: base_url + 'venues/update/' + $(".showVenueInfo").data('id'),
            method: 'POST',
            dataType: 'json',
            data: {
                name: $("#update_venue_name").val(),
                description: $("#update_venue_desc").val()
            },
            success: function (response) {
                if (response == true) {
                    location.reload();
                } else {
                    alert('An unexpected error occured, ' + response);
                    $("#btnUpdateVenue").attr('disabled', false);
                }
            },
            failure: function (response) {
                alert('An unexpected error occured, ' + response.responseText);
                $("#btnUpdateVenue").attr('disabled', false);
            }
        });
    }

    $(".deleteVenue").on('click', function() {

        $(".deleteVenue").attr('disabled', 'disabled');

        $.ajax({
            url: base_url + 'venues/delete/' + $(this).data('id'),
            method: 'POST',
            success: function(response) {
                if (response == 1) {
                    location.reload();
                }
            },
            failure: function(response) {
                alert('An unexpected error occured', response.responseText);
                $(".deleteVenue").attr('disabled', false);
            }
        });
    });

    $('.date').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd',
    });

    $("#salesEndDateText").attr('disabled', 'disabled');

    $("#salesStartDateText").on('change', function() {
        $("#salesEndDate").data('datepicker').setStartDate(new Date($(this).val()));
        $("#salesEndDateText").attr('disabled', false);
    });

    $("#resEndDateText").attr('disabled', 'disabled');
    $("#resStartDateText").on('change', function() {
        $("#resEndDate").data('datepicker').setStartDate(new Date($(this).val()));
        $("#resEndDateText").attr('disabled', false);
    });

    $("#btnGenerateSalesReport").on('click', function() {
        var link = '';
        var startDate = $("#salesStartDateText").val(),
            endDate = $("#salesEndDateText").val(),
            year = $("#salesYear").val(),
            month = $("#reportMonth").val();

        if (startDate == '' || endDate == '') {

            if (month == 0) {
                link = base_url + 'sales-report/' + year;
            } else {
                link = base_url + 'sales-report/' + year + '/' + month;
            }
        } else {
            link = base_url + 'sales-report/' + currentYear + '/0/' + startDate + '/' + endDate;
        }

        window.open(link, '_blank');
    });

    $("#itemsReport").on('click', function() {
        window.open(base_url + 'items-report', '_blank');
    }); 

    $("#btnGenerateResReport").on('click', function() {
        var link = '';
        var startDate = $("#resStartDateText").val(),
            endDate = $("#resEndDateText").val(),
            year = $("#resYear").val(),
            month = $("#resMonth").val(),
            resStatus = $("#resStatus").val();

        if (startDate == '' || endDate == '') {

            if (month == 0) {
                link = base_url + 'reservation-report/' + year + '/' + resStatus;
            } else {
                link = base_url + 'reservation-report/' + year + '/' + resStatus + '/' + month;
            }
        } else {
            link = base_url + 'reservation-report/' + currentYear + '/' + resStatus + '/0/' + startDate + '/' + endDate;
        }
        window.open(link, '_blank');
    });

    $("#salesMonth").on('change', function() {
        $('#salesTable').DataTable( {
            "ajax": base_url + 'get-sales/' + currentYear + '/' + $(this).val(),
            language: { 
                infoEmpty: "No sales data available",
                emptyTable: "No sales data available",
                zeroRecords: "No sales data available"
            },
            destroy: true,
            "columns": [
                { "data": "date_of_event" },
                { "data": "reservation_code" },
                { "data": "customer_name" },
                { "data": "package_name" },
                { "data": "total_amount" },
            ],
            'paging'      : true,
            'lengthChange': false,
            'searching'   : true,
            'ordering'    : false,
            'info'        : true,
            'autoWidth'   : false,    
        });
    });

    $('#btnSaveFoodCategory').on('click', function() {
        if ($("#food_category_name").val().length < 1) {
            $('.food-category-error').removeClass('hide');
        } else {
            $.ajax({
                url: base_url + 'foods/category/store',
                method: 'POST',
                dataType: 'json',
                data: {
                    food_category: $("#food_category_name").val()
                },
                success: function(response) {
                    if (response == 1) {
                        location.reload();
                    } else {
                        alert(response);
                    }
                },
                failure: function(response) {
                    console.log(response); return;
                }
            });
        }
    });

    $('.deleteFoodCategory').on('click', function() {
        $.ajax({
            url: base_url + 'delete/food-category/' + $(this).data('id'),
            method: 'POST',
            success: function(response) {
                if (response == 1) {
                    location.reload();
                } else {
                    console.log(response); return;
                }
            },
            failure: function(response) {
                console.log(response); return;
            }
        });
    });

	if (typeof home != 'undefined' && home == 1) {
		initializeChart();
		salesChart();
	}

	function initializeChart() {
		var months = {
			1: 'January',
			2: 'February',
			3: 'March',
			4: 'April',
			5: 'May',
			6: 'June',
			7: 'July',
			8: 'August',
			9: 'September',
			10: 'October',
			11: 'November',
			12: 'December'
		};

		var d = new Date();
		var currentYear = d.getFullYear();
		var currMonth = d.getMonth() + 1;

		$.get(base_url + 'get-reservations-number/' + currentYear + '/' + currMonth, function( data ) {
			var response = JSON.parse(data);
			var data = {
                labels: [],
                datasets: [{
                    label: "Number of reservations",
                    labels: [],
                    backgroundColor: "#3e95cd",
                    data: []
                }]
            };

            for (var i = 0; i < response.length; i++) {
                data.labels.push(months[response[i].month]);
                data.datasets[0].data.push(response[i].res_count);
            }

	  		var ctx = document.getElementById("myChart");
			var myChart = new Chart(ctx, {
			    type: 'bar',
			    data: data,
			    options: {
			    	barThickness: 1,
			        scales: {

			            yAxes: [{
			                ticks: {
			                    beginAtZero: true,
                                callback: function (value) { if (Number.isInteger(value)) { return value; } },
                                stepSize: 5,
                                suggestedMin: 0,
                                suggestedMax: 50
			                },
			            }],
			        },
			        title: {
				    	display: true,
				    	text: 'Total number of reservations per month'
				    }
			    }
			});
		});
	}

	function salesChart() {
		var months = {
			1: 'January',
			2: 'February',
			3: 'March',
			4: 'April',
			5: 'May',
			6: 'June',
			7: 'July',
			8: 'August',
			9: 'September',
			10: 'October',
			11: 'November',
			12: 'December'
		};

	    var d = new Date();
	    var currentYear = d.getFullYear();
	    var currMonth = d.getMonth() + 1;

		$.get(base_url + 'get-sales-count/' + currentYear + '/' + currMonth, function( data ) {
			var response = JSON.parse(data);
			var data = {
                labels: [],
                datasets: [{
                    label: "Catering's Monthly Income",
                    data: [],
                    borderColor: "#3e95cd",
        			fill: false	
                }]
            };

            for (var i = 0; i < response.length; i++) {
                data.labels.push(months[response[i].month]);
                data.datasets[0].data.push(response[i].total);
            }

	  		var ctx = document.getElementById("sales-chart");
			var myChart = new Chart(ctx, {
			    type: 'line',
			    data: data,
			    options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                callback: function (value) { if (Number.isInteger(value)) { return value; } },
                                stepSize: 10000,
                                suggestedMin: 0,
                                suggestedMax: 100000
                            },
                        }],
                    },
			    	title: {
				    	display: true,
				    	text: 'Company\'s monthly earnings on past events'
				    }
			    }
			});
		});
	}

    $("#btnCancelReservation").on('click', function() {

        if ($("#cancelReason").val().length < 1) {
            $('.cancelReasonError').removeClass('hide');
        } else {
            $.ajax({
                url: base_url + 'reservations/cancel/' + $(this).data('id'),
                method: 'POST',
                dataType: 'json',
                data: {
                    cancel_reason: $("#cancelReason").val(),
                    cancelled_by: 'System Administrator'
                },
                success: function(response) {
                    if (response == 1) {
                        location.reload();
                    } else {
                        alert('An error has occured.');
                    }
                },
                failure: function(response) {
                    console.log(response); return;
                }
            });
        }
    });

	$('#pendingReservations').DataTable( {
        "ajax": base_url + 'reservations/pending',
        language: { 
        	infoEmpty: "No pending reservations",
            emptyTable: "No pending reservations",
            zeroRecords: "No pending reservations"
		},
        "columnDefs": [
            { className: "text-left", "targets": [ 0 ] }
        ],
        "columns": [
            { "data": "customer_name", "defaultContent": "" },
            { "data": "customer_contact", "defaultContent": "" },
            { "data": "name", "defaultContent": "Custom Package" },
            { "data": "date_of_event", "defaultContent": "" },
            { "data": "status", "defaultContent": "" },
            { "data": "info_button", "defaultContent": "" },
        ],
        'paging'      : true,
      	'lengthChange': false,
      	'searching'   : true,
      	'ordering'    : false,
      	'info'        : true,
      	'autoWidth'   : false
    });

    $('#confirmedReservations').DataTable( {
        "ajax": base_url + 'reservations/confirmed',
        language: { 
        	infoEmpty: "No confirmed reservations",
            emptyTable: "No confirmed reservations",
            zeroRecords: "No confirmed reservations"
		},
        "columnDefs": [
            { className: "text-left", "targets": [ 0 ] }
        ],
        "columns": [
            { "data": "customer_name", "defaultContent": "" },
            { "data": "customer_contact", "defaultContent": "" },
            { "data": "name", "defaultContent": "Custom Package" },
            { "data": "date_of_event", "defaultContent": "" },
            { "data": "status", "defaultContent": "" },
            { "data": "info_button", "defaultContent": "" },
        ],
        'paging'      : true,
      	'lengthChange': false,
      	'searching'   : true,
      	'ordering'    : false,
      	'info'        : true,
      	'autoWidth'   : false
    });

    $('#rejectedReservations').DataTable( {
        "ajax": base_url + 'reservations/rejected',
        language: { 
        	infoEmpty: "No rejected reservations",
            emptyTable: "No rejected reservations",
            zeroRecords: "No rejected reservations"
		},
        "columnDefs": [
            { className: "text-left", "targets": [ 0 ] }
        ],
        "columns": [
            { "data": "customer_name", "defaultContent": "" },
            { "data": "customer_contact", "defaultContent": "" },
            { "data": "name", "defaultContent": "" },
            { "data": "date_of_event", "defaultContent": "" },
            { "data": "status", "defaultContent": "" },
            { "data": "info_button", "defaultContent": "" },
        ],
        'paging'      : true,
      	'lengthChange': false,
      	'searching'   : true,
      	'ordering'    : false,
      	'info'        : true,
      	'autoWidth'   : false
    });

	$('#packagesTable').removeAttr('width').DataTable( {
        "ajax": base_url + 'get-packages',
        language: { 
        	infoEmpty: "No packages",
            emptyTable: "No packages",
            zeroRecords: "No packages"
		},
        "columns": [
            { "data": "event_name" },  
            { "data": "name" },
            { "data": "price" },
            { "data": "pax" },
            { "data": "staff_needed" },
            { "data": "info_button" },
        ],
        columnDefs: [
            { width: 200, targets: 0 },
            { width: 350, targets: 1 },
        ],
        fixedColumns: true,
        'paging'      : true,
      	'lengthChange': false,
      	'searching'   : true,
      	'ordering'    : false,
      	'info'        : true,
      	'autoWidth'   : false,
    });

    $('#itemsTable').removeAttr('width').DataTable( {
        "ajax": base_url + 'get-items',
        language: { 
        	infoEmpty: "No items",
            emptyTable: "No items",
            zeroRecords: "No items"
		},
		columnDefs: [
            { width: 200, targets: 4 }
        ],
        fixedColumns: true,
        "columns": [
            { "data": "category" },
            { "data": "name" },
            { "data": "quantity" },
            { "data": "price" },
            { "data": "info_button" },
        ],
        'paging'      : true,
      	'lengthChange': false,
      	'searching'   : true,
      	'ordering'    : false,
      	'info'        : true,
      	'autoWidth'   : false
    });

    $('#themesTable').removeAttr('width').DataTable( {
        "ajax": base_url + 'dashboard/get-themes',
        language: { 
        	infoEmpty: "No themes",
            emptyTable: "No themes",
            zeroRecords: "No themes"
		},
		columnDefs: [
            { width: 300, targets: 0 },
            { width: 300, targets: 1 },
            { width: 250, targets: 2 },
        ],
        fixedColumns: true,
        "columns": [
            { "data": "name" },
            { "data": "description" },
            { "data": "info_button" },
        ],
        'paging'      : true,
      	'lengthChange': false,
      	'searching'   : true,
      	'ordering'    : false,
      	'info'        : true,
      	'autoWidth'   : false
    });

    $('#foodTable').removeAttr('width').DataTable( {
        "ajax": base_url + 'dashboard/get-foods',
        language: { 
        	infoEmpty: "No foods",
            emptyTable: "No foods",
            zeroRecords: "No foods"
		},
		columnDefs: [
			{ width: 200, targets: 0 },
            { width: 250, targets: 1 },
            { width: 100, targets: 2 },
            { width: 200, targets: 3 },
        ],
        fixedColumns: true,
        "columns": [
            { "data": "category" },
            { "data": "name" },
            { "data": "price" },
            { "data": "info_button" },
        ],
        'paging'      : true,
      	'lengthChange': false,
      	'searching'   : true,
      	'ordering'    : false,
      	'info'        : true,
      	'autoWidth'   : false
    });

    var myMonths = {
		1: 'January',
		2: 'February',
		3: 'March',
		4: 'April',
		5: 'May',
		6: 'June',
		7: 'July',
		8: 'August',
		9: 'September',
		10: 'October',
		11: 'November',
		12: 'December'
	};

    var d = new Date();
    var currentYear = d.getFullYear();
    var currMonth = d.getMonth() + 1;

    $('#salesTable').DataTable( {
        "ajax": base_url + 'get-sales/' + currentYear,
        language: { 
        	infoEmpty: "No sales data available",
            emptyTable: "No sales data available",
            zeroRecords: "No sales data available"
		},
        "columns": [
        	{ "data": "date_of_event" },
            { "data": "reservation_code" },
            { "data": "customer_name" },
            { "data": "package_name" },
            { "data": "total_amount" },
        ],
        'paging'      : true,
      	'lengthChange': false,
      	'searching'   : true,
      	'ordering'    : false,
      	'info'        : true,
      	'autoWidth'   : false,    
    });

    $('.deleteCategory').on('click', function() {
    	$.ajax({
    		url: base_url + 'delete/category/' + $(this).data('id'),
    		method: 'POST',
    		success: function(response) {
    			if (response == 1) {
    				location.reload();
    			} else {
    				console.log(response); return;
    			}
    		},
    		failure: function(response) {
    			console.log(response); return;
    		}
    	});
    });



	var price = 0;
    var theme_price = 0;

    if (typeof page != 'undefined' && page == 'createpackage') {
        var old_theme_price = $("#theme_id").find(":selected")[0].dataset.price;

        reComputePrice(old_theme_price, 'add');    
    }
    
    $("#theme_id").on('change', function() {

        theme_price = $(this).find(":selected")[0].dataset.price;

        if (old_theme_price == 0) {
            reComputePrice(theme_price, 'add'); 
            old_theme_price = theme_price;
            e.preventDefault();
        } else {
            reComputePrice(old_theme_price, 'deduct');  
            reComputePrice(theme_price, 'add'); 
            old_theme_price = theme_price
            e.preventDefault();
        }
    });

	$("#file").on('change', function() {
		var file_data = $('#file').prop('files')[0];
        var form_data = new FormData();
        form_data.append('file', file_data);

		$.ajax ({
			url: base_url + 'events/upload',
			dataType: 'text',
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,
			type: 'post',
			success: function (response) {
				var parsed = $.parseJSON(response);
				if (parsed.error == 0) {
					$("#image-preview").attr('src', base_url + 'uploads/' + parsed.image_name);
					$(".preview-box").removeClass('hide');
					$(".error-box").addClass('hide');
					$(".btnsave").removeClass('hide');
				} else {
					$(".error-box").html(parsed.error_message).css('color', 'red');
					$(".error-box").removeClass('hide');
					$(".preview-box").addClass('hide');
					$(".btnsave").addClass('hide');
				}
			},
			error: function (response) {
				console.log(response);
			}
		});
	});

	$("#btnSaveCategory").on('click', function() {
		if ($("#category_name").val().length < 1) {
			$('.category-error').removeClass('hide');
		} else {
			$.ajax({
				url: base_url + 'category/create',
				method: 'POST',
				dataType: 'json',
				data: {
					name: $("#category_name").val()
				},
				success: function(response) {
					if (response == 1) {
						location.reload();
					} else {
						console.log(response); return;
					}
				},
				failure: function(response) {
					console.log(response); return;
				}
			});
		}
	});

	$("#past_image").on('change', function() {
		var file_data = $('#past_image').prop('files')[0];
        var form_data = new FormData();
        form_data.append('file', file_data);

		$.ajax ({
			url: base_url + 'past-events/upload',
			dataType: 'text',
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,
			type: 'post',
			success: function (response) {
				var parsed = $.parseJSON(response);
				if (parsed.error == 0) {
					$("#past-event-preview").attr('src', base_url + 'uploads/' + parsed.image_name);
					$(".preview-box").removeClass('hide');
					$(".error-box").addClass('hide');
				} else {
					$(".error-box").html(parsed.error_message).css('color', 'red');
					$(".error-box").removeClass('hide');
					$(".preview-box").addClass('hide');
				}
			},
			error: function (response) {
				console.log(response);
			}
		});
	});

	$("#past_image_update").on('change', function() {
		var file_data = $('#past_image_update').prop('files')[0];
        var form_data = new FormData();
        form_data.append('file', file_data);

		$.ajax ({
			url: base_url + 'past-events/update-upload',
			dataType: 'text',
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,
			type: 'post',
			success: function (response) {
				var parsed = $.parseJSON(response);
				if (parsed.error == 0) {
					$("#past-event-preview-update").attr('src', base_url + 'uploads/' + parsed.image_name);
					$(".past-error-box").addClass('hide');
					$(".past-preview-box").removeClass('hide');
				} else {
					$(".past-error-box").html(parsed.error_message).css('color', 'red');
					$(".past-error-box").removeClass('hide');
					$(".past-preview-box").addClass('hide');
				}
			},
			error: function (response) {
				console.log(response);
			}
		});
	});

	var past_error = 0;

	$("#btnUpdatePastEvent").on('click', function() {
		var title = $("#past_title"),
			additional_desc = $("#past_additional"),
			description = $("#past_description");

		var inputs = [title, additional_desc, description];

		past_error = 0;

		for (var i = 0; i < inputs.length; i++) {
			validatePastEvent(inputs[i]);
		}

		if (past_error != 0) {
			$('.past-error').text('Please complete all required fields');
			$('.past-error').removeClass('hide');
			$('html, body').animate({
		        scrollTop: $(".past-error").offset().top - 70
		    }, 500);
		} else {
			$.ajax({
				url: base_url + 'past-events/update/' + $(this).data('id'),
				method: 'POST',
				dataType: 'json',
				data: {
					title: title.val(),
					additional_desc: additional_desc.val(),
					description: description.val()
				},
				success: function(response) {
					if (response == 1) {
						location.reload();
					} else {
						alert('An error was encountered while saving your changes. Please try again');
					}
				},
				failure: function(response) {
					console.log(response); return;
				}
			});
		}

	});

	function validatePastEvent(v) {
		if (v.val().length < 1) {
			v.css('border-color', '#e74c3c');
			past_error += 1;
		} else {
			v.css('border-color', '#ccc');
		}
	}

	$(document).on('click', '.packageMoreInfo', function(e) {
		location.href = base_url + 'packages/' + e.currentTarget.dataset.id;
	});

	$("#package_image").on('change', function() {
        readURL(this, $("#pack-image-preview"));
        $("#pack-image-preview").removeClass('hide');
	});

    $("#item_image").on('change', function() {
        readURL(this, $("#item_preview"));
    });

    $("#update_item_image").on('change', function() {
        readURL(this, $("#update_item_preview"));
    });

    var item_error = 0;
    function validateItem(v) {
        if (v.val().length < 1) {
            v.css('border-color', '#e74c3c');
            item_error += 1;
        } else {
            v.css('border-color', '#ccc');
        }
    }

	$("#btnSaveItem").on('click', function() {

        var file_data = $('#item_image').prop('files')[0];
        var form_data = new FormData();
        form_data.append('file', file_data);

        var inputs = [$("#item_name"), $("#item_category"), $("#quantity"), $("#item_price")];

        item_error = 0;
        for (var i = 0; i < inputs.length; i++) {
            validateItem(inputs[i]);
        }

        if (item_error != 0) {
            $('.error-div').text('Please complete all required fields');
            $('.error-div').removeClass('hide');
            $('html, body').animate({
                scrollTop: $(".error-div").offset().top - 70
            }, 500);
        } else {

            $("#btnSaveItem").attr('disabled', 'disabled');

            var form_data = new FormData();
            form_data.append('file', file_data);    

            $.ajax ({
                url: base_url + 'items/upload',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function (response) {
                    if (response == 1) {
                        $.ajax ({
                            url: base_url + 'items/store',
                            dataType: 'json',
                            method: 'POST',
                            data: {
                                item_name: $("#item_name").val(),
                                category_id: $("#item_category").val(),
                                quantity: $("#quantity").val(),
                                price: $("#item_price").val()
                            },
                            success: function (response) {
                                if (response == true) {
                                    location.href = base_url + 'items';
                                } else {
                                    alert('An unexpected error occured, ' + response);
                                    $("#btnSaveItem").attr('disabled', false);
                                }
                            },
                            error: function (response) {
                                alert('An unexpected error occured, ' + response);
                                $("#btnSaveItem").attr('disabled', false);
                            }
                        });
                    } else {
                        alert('An unexpected error occured, ' + response);
                        $("#btnSaveItem").attr('disabled', false);
                    }
                },
                failure: function (response) {
                    alert('An unexpected error occured, ' + response);
                    $("#btnSaveItem").attr('disabled', false);
                }
            });
        }
	});

	$(document).on('click', '.updateItemBtn', function(e) {
		$.ajax ({
			url: base_url + 'items/' + e.currentTarget.dataset.id,
			method: 'GET',
			success: function (response) {
				var parsed = $.parseJSON(response);

				$("#itemId").val(parsed.id);
				$("#update_item_category").val(parsed.category_id);
				$("#update_item_name").val(parsed.name);
				$("#update_quantity").val(parsed.quantity);
				$("#update_item_price").val(parsed.price);
                $("#update_item_preview")[0].src = base_url + parsed.image.current_path;

				$("#updateItem").modal('show');
			},
			error: function (response) {
				alert('An error occured while saving your property, Please Try again');
			}
		});
	});

    var item_error_update = 0;
    function validateItemEdit(v) {
        if (v.val().length < 1) {
            v.css('border-color', '#e74c3c');
            item_error_update += 1;
        } else {
            v.css('border-color', '#ccc');
        }
    }

	$("#btnUpdateItem").on('click', function() {

        var file_data = $('#update_item_image').prop('files')[0];
        var form_data = new FormData();
        form_data.append('file', file_data);

        var inputs = [$("#update_item_category"), $("#update_item_name"), $("#update_quantity"), $("#update_item_price")];

        item_error_update = 0;
        for (var i = 0; i < inputs.length; i++) {
            validateItemEdit(inputs[i]);
        }

        if (item_error_update != 0) {
            $('.error-div').text('Please complete all required fields');
            $('.error-div').removeClass('hide');
            $('html, body').animate({
                scrollTop: $(".error-div").offset().top - 70
            }, 500);
        } else {

            $("#btnUpdateItem").attr('disabled', 'disabled');

            if (typeof file_data != 'undefined') {
                var form_data = new FormData();
                form_data.append('file', file_data);    

                $.ajax ({
                    url: base_url + 'items/upload',
                    dataType: 'text',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    type: 'post',
                    success: function (response) {
                        if (response == 1) {
                            updateItemData();
                        } else {
                            alert('An unexpected error occured, ' + response);
                            $("#btnUpdateItem").attr('disabled', false);
                        }
                    },
                    error: function (response) {
                        alert('An unexpected error occured, ' + response);
                        $("#btnUpdateItem").attr('disabled', false);
                    }
                });
            } else {
                updateItemData();
            }
        }
	});

    function updateItemData() {
        $.ajax ({
            url: base_url + 'items/update/' + $("#itemId").val(),
            method: 'POST',
            dataType: 'json',
            data: {
                category_id: $("#update_item_category").val(),
                item_name: $("#update_item_name").val(),
                quantity: $("#update_quantity").val(),
                price: $("#update_item_price").val()
            },
            success: function (response) {
                if (response == true) {
                    location.reload();
                } else {
                    alert('An unexpected error occured, ' + response);
                    $("#btnUpdateItem").attr('disabled', false);
                }
            },
            error: function (response) {
                alert('An unexpected error occured, ' + response);
                $("#btnUpdateItem").attr('disabled', false);
            }
        });
    }

	function getListOfItems(category_id) {
		$.ajax({
			url: base_url + 'packages/get-items-by-cat/' + category_id,
			method: 'GET',
			success: function(response) {
				var parsed = $.parseJSON(response);
				var html = '';
				$.each(parsed, function(index, value) {
					html += "<option value="+value.id+" data-name='" +value.item_name+"' data-maxqty="+value.quantity+">" +value.item_name+"</option>";
				});

				$("#items_list").html(html);
			},
			failure: function(response) {
				console.log(response);
			}
		});
	}

	$("#edit_package_item_categories").on('change', function() {
		$.ajax({
			url: base_url + 'packages/get-items-by-cat/' + $(this).val() + '/' + $("#hidden_package_id").val(),
			method: 'GET',
			success: function(response) {
				var parsed = $.parseJSON(response);
				var html = '';
				$.each(parsed, function(index, value) {
					html += "<option value="+value.id+" data-name='" +value.item_name+"' data-maxqty="+value.quantity+">" +value.item_name+"</option>";
				});

				$("#edit_items_list").html(html);
			},
			failure: function(response) {
				console.log(response);
			}
		});
	});

	// packages
	$("#btnAddItemToPackage").on('click', function() {
		if ($("#item_quantity").val().length == 0) {
			alert('Please specify the quantity.');
			$("#item_quantity").focus();
			return;
		} else {
			if ($("#item_quantity").val() > $("#items_list").find(':selected').data('maxqty')) {
				alert('Maximum quantity for this item is ' + $("#items_list").find(':selected').data('maxqty'));
				$("#item_quantity").focus();
				return;
			}
		}

		var item_name = $("#items_list").find(':selected').data('name');
		var category = $("#items_list").find(':selected').data('category');
        category = category.replace('_', ' ');

		var maxqty = $("#items_list").find(':selected').data('maxqty');
		var amount = $("#items_list").find(':selected').data('amount');
		var subtotal = amount * $("#item_quantity").val();

		reComputePrice(amount * $("#item_quantity").val(), 'add');

		$("#itemsContainer").append(createItem(item_name, $("#items_list").val(), $("#item_quantity").val(), maxqty, category, amount, subtotal));
		$("#items_list option[value='"+$("#items_list").val()+"']").remove();
		$("#item_quantity").val('');
		$("#item_quantity").focus();

	});

	function reComputePrice(amount, command) {

		switch(command) {
			case 'add': 
				price = parseInt(price) + parseInt(amount);
				break;
			case 'deduct':
				price = price - amount;
				break;
		}

		$("#packagePrice").text(formatPera(price));
	}

	function reComputePriceEdit(amount, command) {

		switch(command) {
			case 'add': 
				priceEdit = parseInt(priceEdit) + parseInt(amount);
				break;
			case 'deduct':
				priceEdit = parseInt(priceEdit) - parseInt(amount);
				break;
		}

		$("#packagePriceEdit").text(formatPera(priceEdit));
	}

    function formatPera(num) {
        var p = num.toFixed(2).split(".");
        return "PHP " + p[0].split("").reverse().reduce(function(acc, num, i, orig) {
            return  num + (i && !(i % 3) ? "," : "") + acc;
        }, "") + "." + p[1];
    }

	var createItem = function(item_name, item_id, quantity, maxqty, category, amount, subtotal) {
		var item_group = '<div class="row itemWithQty" style="margin-bottom:5px; margin-top:5px;">';
			item_group += '<div class="col-sm-12 col-md-7">';
				item_group += '<input type="text" data-id="'+item_id+'" data-amount="'+amount+'" data-subtotal="'+subtotal+'"  data-category="'+category+'" class="form-control" value="' + item_name + '" readonly/>';
			item_group += '</div>';
			item_group += '<div class="col-md-3">';
				item_group += '<input type="number" class="form-control itemQty" value="' + quantity + '" readonly/>';
			item_group += '</div>';
			item_group += '<div class="col-md-1">';
				item_group += '<button class="btn btn-danger removeItemBtn" data-maxqty="'+maxqty+'" data-category="'+category+'" data-value="'+item_id+'" data-name="'+item_name+'" data-amount="'+amount+'" data-quantity="'+quantity+'"><i class="fa fa-minus-square" aria-hidden="true"></i></button>';
			item_group += '</div>';									
		item_group += '</div>';

		return item_group;
	}

	var createEditItem = function(item_name, item_id, quantity, maxqty, category, amount, subtotal) {
		var item_group = '<div class="row itemWithQty" style="margin-bottom:5px; margin-top:5px;">';
			item_group += '<div class="col-sm-12 col-md-7">';
				item_group += '<input type="text" data-id="'+item_id+'" data-amount="'+amount+'" data-subtotal="'+subtotal+'" data-category="'+category+'" class="form-control" value="' + item_name + '" readonly/>';
			item_group += '</div>';
			item_group += '<div class="col-md-3">';
				item_group += '<input type="number" class="form-control itemQty" value="' + quantity + '" readonly/>';
			item_group += '</div>';
			item_group += '<div class="col-md-1">';
				item_group += '<button class="btn btn-danger editRemoveItemBtn" data-subtotal="'+subtotal+'" data-category="'+category+'" data-maxqty="'+maxqty+'" data-value="'+item_id+'" data-name="'+item_name+'" data-amount="'+amount+'" data-quantity="'+quantity+'"><i class="fa fa-minus-square" aria-hidden="true"></i></button>';
			item_group += '</div>';									
		item_group += '</div>';

		return item_group;
	}

	function isEmpty(obj) {
	    for(var key in obj) {
	        if(obj.hasOwnProperty(key))
	            return false;
	    }
	    return true;
	}

	var package_error = 0;

	$("#btnSavePackage").on('click', function() {

        var file_data = $('#package_image').prop('files')[0];
        var form_data = new FormData();
        form_data.append('file', file_data);

		var items = {};
		var items_panel = $("#itemsContainer");
		var item_entry = items_panel.find('.itemWithQty');

        var foods = {};
        var foods_panel = $("#foodsContainer");
        var food_entry = foods_panel.find('.foodWithQty');

		var error = 0;

		var event_id = $("#event_id"),
			package_name = $("#package_name"),
			package_pax = $("#package_pax"),
			package_staffs = $("#package_staffs"),
			description = $("#description"),
			packagePrice = $("#packagePrice");

		var inputs = [package_name, package_pax, package_staffs, description, $("#package_image")];

		package_error = 0;
		for (var i = 0; i < inputs.length; i++) {
			validateInput(inputs[i]);
		}

		if (package_error != 0) {
			$('.error-div').text('Please complete all required fields');
			$('.error-div').removeClass('hide');
			$('html, body').animate({
		        scrollTop: $(".error-div").offset().top - 70
		    }, 500);
		} else {
			$('.error-div').addClass('hide');

			item_entry.each(function(index) {
				items[index] = {
					id: $(this).find("input[type=text]").data('id'),
					name: $(this).find("input[type=text]").val(),
					quantity: $(this).find("input[type=number]").val(),
					category: $(this).find("input[type=text]").data('category'),
					subtotal: $(this).find("input[type=text]").data('subtotal'),
					amount: $(this).find("input[type=text]").data('amount'),
				}
			});

            food_entry.each(function(index) {
                foods[index] = {
                    id: $(this).find("input[type=text]").data('id'),
                    name: $(this).find("input[type=text]").val(),
                    quantity: $(this).find("input[type=number]").val(),
                    subtotal: $(this).find("input[type=text]").data('subtotal'),
                    amount: $(this).find("input[type=text]").data('amount'),
                }
            });

			if (isEmpty(items)) {
				$('.error-div').text('Please add at least 1 item in your package');
				$('.error-div').removeClass('hide');
				$('html, body').animate({
			        scrollTop: $(".error-div").offset().top - 70
			    }, 500);
			    error = 1;
			} else {
				error = 0;
			}

			if (error == 0 && package_error == 0) {

				$("#btnSavePackage").attr('disabled', 'disabled');
				
                $.ajax ({
                    url: base_url + 'packages/upload',
                    dataType: 'text',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    type: 'post',
                    success: function (response) {
                        if (response == 1) {
                            $.ajax ({
                                url: base_url + 'packages/store',
                                method: 'POST',
                                dataType: 'json',
                                data: {
                                    event_id: $("#event_id").val(),
                                    package_name: $("#package_name").val(),
                                    pax: $("#package_pax").val(),
                                    staff_needed: $("#package_staffs").val(),
                                    description: $("#description").val(),
                                    price: price,
                                    items: JSON.stringify(items),
                                    foods: JSON.stringify(foods),
                                    theme_id: $("#theme_id").val()
                                },
                                success: function (response) {
                                    if (response == true) {
                                        location.href = base_url + 'packages';
                                    } else {
                                        alert('An error occured while saving your property, Please Try again'); 
                                    }
                                },
                                error: function (response) {
                                    alert('An error occured while saving your property, Please Try again');
                                }
                            });
                        } else {
                            alert('An unexpected error occured, ' + response);
                            $("#btnSavePackage").attr('disabled', false);
                        }
                    },
                    error: function (response) {
                        alert('An unexpected error occured, ' + response);
                        $("#btnSavePackage").attr('disabled', false);
                    }
                });
			}
			
		}
	});

	function validateInput(v) {
		if (v.val().length < 1) {
			v.css('border-color', '#e74c3c');
			package_error += 1;
		} else {
			v.css('border-color', '#ccc');
		}
	}


	$("#btnAddItemToPackageEdit").on('click', function() {
		if ($("#edit_item_quantity").val().length == 0) {
			alert('Please specify the quantity.');
			$("#edit_item_quantity").focus();
			return;
		} else {
			if ($("#edit_item_quantity").val() > $("#edit_items_list").find(':selected').data('maxqty')) {
				alert('Maximum quantity for this item is ' + $("#edit_items_list").find(':selected').data('maxqty'));
				$("#edit_item_quantity").focus();
				return;
			}
		}
		var item_name = $("#edit_items_list").find(':selected').data('name');
		var category = $("#edit_items_list").find(':selected').data('category');

        category = category.replace('_', ' ');

		var maxqty = $("#edit_items_list").find(':selected').data('maxqty');
		var amount = $("#edit_items_list").find(':selected').data('amount');
		var subtotal = amount * $("#edit_item_quantity").val();

		reComputePriceEdit(amount * $("#edit_item_quantity").val(), 'add');
		$(".updateItems").append(createEditItem(item_name, $("#edit_items_list").val(), $("#edit_item_quantity").val(), maxqty, category, amount, subtotal));
		$("#edit_items_list option[value='"+$("#edit_items_list").val()+"']").remove();
		$("#edit_item_quantity").val('');
		$("#edit_item_quantity").focus();
	});

	$(document).on('click', '.removeItemBtn', function() {
		var value = $(this).data('value'),
			maxqty = $(this).data('maxqty'),
			name = $(this).data('name');
			category = $(this).data('category');
            category = category.replace(' ', '_');
			amount = $(this).data('amount');
			quantity = $(this).data('quantity');

		$(".group-" +category).append('<option value="'+value+'" data-name="'+name+'" data-category="'+category+'" data-maxqty="'+maxqty+'" data-amount="'+amount+'" data-quantity="'+quantity+'">'+name+'</option>');
		$(this).parents('div').eq(1).remove();
		reComputePrice(amount * quantity, 'deduct');
	});

	$(document).on('click', '.editRemoveItemBtn', function(e) {
		var value = e.currentTarget.dataset.value,
			maxqty = e.currentTarget.dataset.maxqty,
			name = e.currentTarget.dataset.name;
			category = e.currentTarget.dataset.category;
			amount = e.currentTarget.dataset.amount;
			quantity = e.currentTarget.dataset.quantity;
			subtotal = e.currentTarget.dataset.subtotal;

        category = category.replace(' ', '_');

		$(".edit-group-" +category).append('<option value="'+value+'" data-name="'+name+'" data-category="'+category+'" data-maxqty="'+maxqty+'" data-amount="'+amount+'" data-quantity="'+quantity+'">'+name+'</option>');
		$(this).parents('div').eq(1).remove();
		reComputePriceEdit(subtotal, 'deduct');
	});

	var update_package_error = 0;
	$("#btnUpdatePackage").on('click', function() {

		var items = {};
		var items_panel = $(".updateItems");
		var item_entry = items_panel.find('.itemWithQty');

        var foods = {};
        var food_panel = $(".updateFoods");
        var food_entry = food_panel.find('.foodWithQty');

		var edit_item_error = 0;

		var event_id = $("#event_id"),
			package_name = $("#editPackageName"),
			package_pax = $("#editPax"),
			package_staffs = $("#editStaffs"),
			description = $("#editDescription"),
			packagePrice = $("#packagePriceEdit");

		var inputs = [package_name, package_pax, package_staffs, description];

		update_package_error = 0;
		for (var i = 0; i < inputs.length; i++) {
			validateUpdateInput(inputs[i]);
		}

		if (update_package_error != 0) {
			$('.edit-error-div').text('Please complete all required fields');
			$('.edit-error-div').removeClass('hide');
			$('html, body').animate({
		        scrollTop: $(".edit-error-div").offset().top - 70
		    }, 500);
		} else {

			item_entry.each(function(index) {
				items[index] = {
					id: $(this).find("input[type=text]").data('id'),
					name: $(this).find("input[type=text]").val(),
					quantity: $(this).find("input[type=number]").val(),
					category: $(this).find("input[type=text]").data('category'),
					subtotal: $(this).find("input[type=text]").data('subtotal'),
					amount: $(this).find("input[type=text]").data('amount'),
				}
			});

            food_entry.each(function(index) {
                foods[index] = {
                    id: $(this).find("input[type=text]").data('id'),
                    name: $(this).find("input[type=text]").val(),
                    quantity: $(this).find("input[type=number]").val(),
                    subtotal: $(this).find("input[type=text]").data('subtotal'),
                    amount: $(this).find("input[type=text]").data('amount'),
                }
            });

			if (isEmpty(items)) {
				$('.edit-error-div').text('Please add at least 1 item in your package');
				$('.edit-error-div').removeClass('hide');
				$('html, body').animate({
			        scrollTop: $(".edit-error-div").offset().top - 70
			    }, 500);
			    edit_item_error = 1;
			} else {
				edit_item_error = 0;
			}

			if (edit_item_error == 0 && update_package_error == 0) {

				$("#btnUpdatePackage").attr('disabled', 'disabled');

                var id = $("#hidden_package_id").val();
                var file_data = $('#update_package_image').prop('files')[0];

                if (typeof file_data != 'undefined') {
                    var form_data = new FormData();
                    form_data.append('file', file_data);    

                    $.ajax ({
                        url: base_url + 'packages/upload',
                        dataType: 'text',
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form_data,
                        type: 'post',
                        success: function (response) {
                            if (response == 1) {
                                updatePackageData(id, package_name, package_pax, package_staffs, description, packagePrice, items, foods);
                            } else {
                                $('.error-box').html(response);
                            }
                        },
                        error: function (response) {
                            console.log(response);
                        }
                    });
                } else {
                    updatePackageData(id, package_name, package_pax, package_staffs, description, packagePrice, items, foods);
                }
			}

		}
	});	

    function updatePackageData(id, package_name, package_pax, package_staffs, description, packagePrice, items, foods) {
        $.ajax ({
            url: base_url + 'packages/update/' + id,
            method: 'POST',
            dataType: 'json',
            data: {
                name: package_name.val(),
                pax: package_pax.val(),
                staff_needed: package_staffs.val(),
                description: description.val(),
                price: priceEdit,
                items: JSON.stringify(items),
                foods: JSON.stringify(foods),
                theme_id: $("#update_theme_id").val()
            },
            success: function (response) {
                if (response == true) {
                    location.reload();
                } else {
                    alert('An error occured while saving your property, Please Try again'); 
                }
            },
            error: function (response) {
                alert('An error occured while saving your property, Please Try again');
            }
        });
    }

    $("#update_package_image").on('change', function() {
        readURL(this, $("#edit-pack-image-preview"));
    });

	function validateUpdateInput(v) {
		if (v.val().length < 1) {
			v.css('border-color', '#e74c3c');
			update_package_error += 1;
		} else {
			v.css('border-color', '#ccc');
		}
	}

	$('.btnConfirmReservation').on('click', function() {
		updateResStatus($(this).data('id'), 'confirmed');
	});

	$('.btnShowCancelReason').on('click', function() {
		$("#rejectModal").modal('show');
	});

	$('.btnRejectReservation').on('click', function() {
		updateResStatus($(this).data('id'), 'rejected');
	});

	function updateResStatus(id, status) {
		$("#updateModalLoading").modal('show');
		$.ajax({
			url: base_url + 'reservations/status/' + id,
			method: 'POST',
			dataType: 'json',
			data: {
				status: status,
				reject_reason: (status == 'rejected') ? $("#reject_cancel_reason").val() : ''
			},
			success: function(response) {
				if (response.error == 1) {
					$("#res_id").val(id);
					$("#same_ids").val(response.data.join(', '));
					$("#updateModalLoading").modal('toggle');
					$("#sameDateModal").modal('show');
				} else {
					location.reload();
				}
			}, 
			failure: function(response) {
				alert(response);
			}
		});
	}

	$("#btnFinalConfirmation").on('click', function() {
		var ids = $("#same_ids").val(),
			cancel_reason = $("#cancel_reason").val(),
			res_id = $("#res_id").val();

		$("#updateModalLoading").modal('show');
		$.ajax({
			url: base_url + 'reservations/massreject',
			method: 'POST',
			dataType: 'json',
			data: {
				res_id: res_id,
				ids: ids,
				cancel_reason: cancel_reason
			},
			success: function(response) {
				if (response == 1) {
					location.reload();
				} else {
					alert('An error occured');
				}
			},
			failure: function(response) {
				console.log(response); return;
			}
		});
	});

	$("#btnDeployItems").on('click', function() {
		$.ajax({
			url: base_url + 'reservations/deploy-items',
			method: 'POST',
			dataType: 'json',
			data: {
				reservation_id: $(this).data('id'),
				date_of_event : $("#hidden_date_of_event").val()
			},
			success: function(response) {
				if (response == 1) {
					location.reload();
				} else {
					alert('Error!!');
				}
			}
		})
	});

	$("#btnMarkComplete").on('click', function() {
		$.ajax({
			url: base_url + 'reservations/complete',
			method: 'POST',
			dataType: 'json',
			data: {
				reservation_id: $(this).data('id'),
				date : $("#hidden_date_of_event").val()
			},
			success: function(response) {
				if (response == 1) {
					location.reload();
				} else {
					alert('Error!!');
				}
			}
		})
	});	

	$(document).on('click', '.btnDeletePackage', function(e) {
		if (confirm('Are you sure you want to delete this package? ')) {
			$.ajax({
				url: base_url + 'packages/delete/' + e.currentTarget.dataset.id,
				method: 'POST',
				success: function(response) {
					if (response == 1) {
						location.reload();
					} else {
						alert('an error occured');
					}
				},
				failure: function(response) {
					console.log(response);
				}
			});
		}
	});

	$(document).on('click', '.btnDeleteItem', function(e) {
		if (confirm('Are you sure you want to delete this item? ')) {
			$.ajax({
				url: base_url + 'items/delete/' + e.currentTarget.dataset.id,
				method: 'POST',
				dataType: 'json',
				success: function(response) {
					if (response.success == 0) {
						alert(response.error_message);
					} else {
						location.reload();
					}
				},
				failure: function(response) {
					console.log(response);
				}
			});
		}
	});

	$('.set-featured').on('click', function() {
		$.ajax({
			url: base_url + 'past-events/update-featured',
			method: 'POST',
			dataType: 'json',
			data: {
				id: $(this).data('id'),
				is_featured: 1
			},
			success: function(response) {
				if(response.success == 1) {
					location.reload();
				} else {
					$('.error-past-events h5').text(response.error_message);
					$('.error-past-events').removeClass('hide');
				}
			},
			failure: function(response) {
				console.log(response);
			}
		});
	});
	
	$('.remove-featured').on('click', function() {
		$.ajax({
			url: base_url + 'past-events/update-featured',
			method: 'POST',
			dataType: 'json',
			data: {
				id: $(this).data('id'),
				is_featured: 0
			},
			success: function(response) {
				if(response.success == 1) {
					location.reload();
				}
			},
			failure: function(response) {
				console.log(response);
			}
		});
	});

	$("#theme_image").on('change', function() {
        $('.theme-error-box').addClass('hide');
        $('.preview-box').removeClass('hide');
		readURL(this, $("#my_preview"));
	});	      

    $("#update_theme_image").on('change', function() {
        $('.theme-error-box').addClass('hide');
        $('.preview-box').removeClass('hide');
        readURL(this, $("#update_my_preview"));
    });      


    var theme_error = 0;
    function validateTheme(v) {
        if (v.val().length < 1) {
            v.css('border-color', '#e74c3c');
            theme_error += 1;
        } else {
            v.css('border-color', '#ccc');
        }
    }

	$("#btnSaveTheme").on('click', function() {
		var file_data = $('#theme_image').prop('files')[0];
        var form_data = new FormData();
        form_data.append('file', file_data);

        var inputs = [$("#theme_name"), $("#theme_desc"), $("#theme_price")];

        theme_error = 0;
        for (var i = 0; i < inputs.length; i++) {
            validateTheme(inputs[i]);
        }

        if (theme_error != 0) {
            $('.error-div').text('Please complete all required fields');
            $('.error-div').removeClass('hide');
            $('html, body').animate({
                scrollTop: $(".error-div").offset().top - 70
            }, 500);
        } else { 
            $.ajax ({
                url: base_url + 'themes/upload',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function (response) {
                    if (response == 1) {
                        $.ajax({
                            url: base_url + 'themes/store',
                            method: 'POST',
                            dataType: 'json',
                            data: {
                                theme_name: $("#theme_name").val(),
                                theme_desc: $("#theme_desc").val(),
                                theme_price: $("#theme_price").val()
                            },
                            success: function(response) {
                                if (response == 1) {
                                    location.href = base_url + 'themes';
                                }                           
                            },
                            failure: function(response) {
                                console.log(response); return;
                            }
                        });
                    } else {
                        alert('An unexpected error occured: ' + response);
                    }
                },
                error: function (response) {
                    console.log(response);
                }
            });
        }
	});

    var update_theme_error = 0;
    function validateThemeUpdate(v) {
        if (v.val().length < 1) {
            v.css('border-color', '#e74c3c');
            update_theme_error += 1;
        } else {
            v.css('border-color', '#ccc');
        }
    }

    $("#btnUpdateTheme").on('click', function() {
        var id = $(this).data('id');
        var file_data = $('#update_theme_image').prop('files')[0];

        var inputs = [$("#update_theme_name"), $("#update_theme_desc"), $("#update_theme_price")];

        update_theme_error = 0;
        for (var i = 0; i < inputs.length; i++) {
            validateThemeUpdate(inputs[i]);
        }

        if (update_theme_error != 0) {
            $('.error-div').text('Please complete all required fields');
            $('.error-div').removeClass('hide');
            $('html, body').animate({
                scrollTop: $(".error-div").offset().top - 70
            }, 500);
        } else {    
            if (typeof file_data != 'undefined') {

                var form_data = new FormData();
                form_data.append('file', file_data);    

                $.ajax ({
                    url: base_url + 'themes/upload',
                    dataType: 'text',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    type: 'post',
                    success: function (response) {
                        if (response == 1) {
                            updateThemeData(id);
                        } else {
                            alert('An unexpected error occured: ' + response);
                        }
                    },
                    error: function (response) {
                        console.log(response);
                    }
                });
            } else {
                updateThemeData(id);
            }
        }
    });

    function updateThemeData(id) {
        $.ajax({
            url: base_url + 'themes/update/' + id,
            method: 'POST',
            dataType: 'json',
            data: {
                theme_name: $("#update_theme_name").val(),
                description: $("#update_theme_desc").val(),
                price: $("#update_theme_price").val(),
            },
            success: function(response) {
                if (response == 1) {
                    location.reload();
                }                           
            },
            failure: function(response) {
                console.log(response); return;
            }
        });
    }

	$("#food_image").on('change', function() {
        $('.food-error-box').addClass('hide');
        $('.preview-box').removeClass('hide');
		readURL(this, $("#food_preview"));
	});

	$("#update_food_image").on('change', function() {
        $('.food-error-box').addClass('hide');
        $('.preview-box').removeClass('hide');
		readURL(this, $("#update_food_preview"));
	});

    var food_error = 0;
    function validateFood(v) {
        if (v.val().length < 1) {
            v.css('border-color', '#e74c3c');
            food_error += 1;
        } else {
            v.css('border-color', '#ccc');
        }
    }

	$("#btnCreateFood").on('click', function() {

        var inputs = [$("#food_category"), $("#food_name"), $("#food_desc"), $("#food_price")];
        var file_data = $('#food_image').prop('files')[0];
        var form_data = new FormData();
        form_data.append('file', file_data);

        food_error = 0;
        for (var i = 0; i < inputs.length; i++) {
            validateFood(inputs[i]);
        }

        if (food_error != 0) {
            $('.error-div').text('Please complete all required fields');
            $('.error-div').removeClass('hide');
            $('html, body').animate({
                scrollTop: $(".error-div").offset().top - 70
            }, 500);
        } else {

            $("#btnCreateFood").attr('disabled', 'disabled');
            $.ajax ({
                url: base_url + 'foods/upload',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function (response) {
                    if (response == 1) {
                        $.ajax({
                            url: base_url + 'foods/store',
                            method: 'POST',
                            dataType: 'json',
                            data: {
                                category: $("#food_category").val(),
                                name: $("#food_name").val(),
                                description: $("#food_desc").val(),
                                price: $("#food_price").val()
                            },
                            success: function(response) {
                                if (response == 1) {
                                    location.href = '/foods';
                                }                           
                            },
                            failure: function(response) {
                                alert('An unexpected error occured: ' + response);
                                $("#btnCreateFood").attr('disabled', false);
                            }
                        });
                    } else {
                        alert('An unexpected error occured: ' + response);
                        $("#btnCreateFood").attr('disabled', false);
                    }
                },
                error: function (response) {
                    alert('An unexpected error occured: ' + response);
                    $("#btnCreateFood").attr('disabled', false);
                }
            });
        }
	});

    var food_error_update = 0;
    function validateFoodUpdate(v) {
        if (v.val().length < 1) {
            v.css('border-color', '#e74c3c');
            food_error_update += 1;
        } else {
            v.css('border-color', '#ccc');
        }
    }

	$("#btnUpdateFood").on('click', function() {

		var id = $(this).data('id');
		var file_data = $('#update_food_image').prop('files')[0];

        var inputs = [$("#update_food_name"), $("#update_food_desc"), $("#update_food_price")];

        food_error_update = 0;
        for (var i = 0; i < inputs.length; i++) {
            validateFoodUpdate(inputs[i]);
        }

        if (food_error_update != 0) {
            $('.error-div').text('Please complete all required fields');
            $('.error-div').removeClass('hide');
            $('html, body').animate({
                scrollTop: $(".error-div").offset().top - 70
            }, 500);
        } else {
            if (typeof file_data != 'undefined') {
                var form_data = new FormData();
                form_data.append('file', file_data);    

                $("#btnUpdateFood").attr('disabled', 'disabled');

                $.ajax ({
                    url: base_url + 'foods/upload',
                    dataType: 'text',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    type: 'post',
                    success: function (response) {
                        if (response == 1) {
                            updateFoodsData(id);
                        } else {
                            alert('An unexpected error occured, ' + response);
                        }
                    },
                    error: function (response) {
                        alert('An unexpected error occured, ' + response);
                        $("#btnUpdateFood").attr('disabled', false);
                    }
                });
            } else {
                updateFoodsData(id);
            }
        }		
	});

    function updateFoodsData(id) {
        $.ajax({
            url: base_url + 'foods/update/' + id,
            method: 'POST',
            dataType: 'json',
            data: {
                name: $("#update_food_name").val(),
                description: $("#update_food_desc").val(),
                price: $("#update_food_price").val(),
            },
            success: function(response) {
                if (response == 1) {
                    location.reload();
                }                           
            },
            failure: function(response) {
                alert('An unexpected error occured, ' + response);
            }
        });
    }

	$(document).on('click', '.updateFoodBtn', function(e) {
		location.href = base_url + 'foods/' + e.currentTarget.dataset.id;
	});

	$(document).on('click', '.btnInactiveFood', function(e) {

        if (confirm('Are you sure you want to remove this food? ')) {
            // $("#preloader").modal('show');
            // sa totoo lang delete tlaga to
            $.ajax({
                url: base_url + 'foods/status/' + e.currentTarget.dataset.id,
                method: 'POST',
                dataType: 'json',
                success: function(response) {
                    if (response.success == 0) {
                        alert(response.error_message);
                    } else {
                        location.reload();
                    }               
                },
                failure: function(response) {
                    alert('An unexpected error occured, ' + response.responseText);
                    $("#preloader").modal('hide');
                }
            });
        }
	});
	
	$(document).on('click', '.btnActiveFood', function(e) {
		$.ajax({
			url: base_url + 'foods/status/' + e.currentTarget.dataset.id,
			method: 'POST',
			data: {
				is_available: Number(1)
			},
			success: function(response) {
				if (response == 1) {
					location.reload();
				}							
			},
			failure: function(response) {
				console.log(response); return;
			}
		});
	});

	$(document).on('click', '.updateThemeBtn', function(e) {
		location.href = base_url + 'themes/' + e.currentTarget.dataset.id;
	});

    $(document).on('click', '.btnInactiveTheme', function(e) {
        $.ajax({
            url: base_url + 'themes/status/' + e.currentTarget.dataset.id,
            method: 'POST',
            data: {
                is_available: Number(0)
            },
            success: function(response) {
                if (response == 1) {
                    location.reload();
                }                           
            },
            failure: function(response) {
                console.log(response); return;
            }
        });
    });
    
    $(document).on('click', '.btnActiveTheme', function(e) {
        $.ajax({
            url: base_url + 'themes/status/' + e.currentTarget.dataset.id,
            method: 'POST',
            data: {
                is_available: Number(1)
            },
            success: function(response) {
                if (response == 1) {
                    location.reload();
                }                           
            },
            failure: function(response) {
                console.log(response); return;
            }
        });
    });

	$("#update_event_file").on('change', function() {
		readURL(this, $("#update-event-preview"));
	});

	$("#event_image").on('change', function() {
		readURL(this, $("#eventImagePreview"));
        $('.preview-box').removeClass('hide');
	});

	$("#btnCreateEvent").on('click', function() {

		var id = $(this).data('id');
		var file_data = $('#event_image').prop('files')[0];

		if (typeof file_data != 'undefined') {
			var form_data = new FormData();
        	form_data.append('file', file_data);	

            $("#btnCreateEvent").attr('disabled', 'disabled');

        	$.ajax ({
				url: base_url + 'events/upload',
				dataType: 'text',
				cache: false,
				contentType: false,
				processData: false,
				data: form_data,
				type: 'post',
				success: function (response) {
					if (response == 1) {
						$.ajax({
							url: base_url + 'events/store',
							method: 'POST',
							dataType: 'json',
							data: {
								name: $("#event_name").val(),
								description: $("#event_description").val(),
							},
							success: function(response) {
								if (response == 1) {
									location.href = '/events';
								}							
							},
							failure: function(response) {
                                $("#errorPhoto").html(response);
                                $("#errorPhotoModal").modal('show');
                                $("#btnCreateEvent").attr('disabled', false);
							}
						});
					} else {
                        $("#errorPhoto").html(response);
                        $("#errorPhotoModal").modal('show');
                        $("#btnCreateEvent").attr('disabled', false);
					}
				},
				error: function (response) {
					$("#errorPhoto").html(response);
                    $("#errorPhotoModal").modal('show');
                    $("#btnCreateEvent").attr('disabled', false);
				}
			});
		}
	});

	$("#btnUpdateEvent").on('click', function() {

		var id = $(this).data('id');
		var file_data = $('#update_event_file').prop('files')[0];

		if (typeof file_data != 'undefined') {
			var form_data = new FormData();
        	form_data.append('file', file_data);	

        	$.ajax ({
				url: base_url + 'events/upload',
				dataType: 'text',
				cache: false,
				contentType: false,
				processData: false,
				data: form_data,
				type: 'post',
				success: function (response) {
					if (response == 1) {
						updateEventsData(id);
					} else {
						$('.error-box').html(response);
					}
				},
				error: function (response) {
					console.log(response);
				}
			});
		} else {
			updateEventsData(id);
		}
	});

	$('.deleteEvent').on('click', function() {
		$.ajax({
			url: base_url + 'delete-events/' + $(this).data('id'),
			method: 'POST',
			dataType: 'json',
			data: {
				is_deleted: 1
			},
			success: function(response) {
				if (response == 1) {
					location.reload();
				} else {
					console.log(response); return;
				}
			},
			failure: function(response) {
				console.log(response); return;
			}
		});
	});

	$('.activateEvent').on('click', function() {
		$.ajax({
			url: base_url + 'delete-events/' + $(this).data('id'),
			method: 'POST',
			dataType: 'json',
			data: {
				is_deleted: 0
			},
			success: function(response) {
				if (response == 1) {
					location.reload();
				} else {
					console.log(response); return;
				}
			},
			failure: function(response) {
				console.log(response); return;
			}
		});
	});

	function updateEventsData(id) {
		$.ajax({
			url: base_url + 'events/update/' + id,
			method: 'POST',
			dataType: 'json',
			data: {
				name: $("#update_event_name").val(),
				description: $("#update_event_description").val(),
			},
			success: function(response) {
				if (response == 1) {
					location.href = '/events';
				}							
			},
			failure: function(response) {
				console.log(response); return;
			}
		});
	}

	function readURL(input, preview) {

		if (input.files && input.files[0]) {
	    	var reader = new FileReader();

		    reader.onload = function(e) {
		    	preview.attr('src', e.target.result);
		    }

		    reader.readAsDataURL(input.files[0]);
	  	}
	}       

    // 
    $("#btnAddFoodToPackage").on('click', function() {
        if ($("#food_quantity").val().length == 0) {
            alert('Please specify the quantity.');
            $("#food_quantity").focus();
            return;
        }

        var item_name = $("#food_list").find(':selected').data('name');
        var amount = $("#food_list").find(':selected').data('amount');
        var subtotal = amount * $("#food_quantity").val();

        reComputePrice(amount * $("#food_quantity").val(), 'add');

        $("#foodsContainer").append(createFoodItem(item_name, $("#food_list").val(), $("#food_quantity").val(), amount, subtotal));
        $("#food_list option[value='"+$("#food_list").val()+"']").remove();
        $("#food_quantity").val('');
        $("#food_quantity").focus();

    });    

    var createFoodItem = function(food_name, food_id, quantity, amount, subtotal) {
        var food_group = '<div class="row foodWithQty" style="margin-bottom:5px; margin-top:5px;">';
            food_group += '<div class="col-sm-12 col-md-7">';
                food_group += '<input type="text" data-id="'+food_id+'" data-amount="'+amount+'" data-subtotal="'+subtotal+'"  class="form-control" value="' + food_name + '" readonly/>';
            food_group += '</div>';
            food_group += '<div class="col-md-3">';
                food_group += '<input type="number" class="form-control foodQty" value="' + quantity + '" readonly/>';
            food_group += '</div>';
            food_group += '<div class="col-md-1">';
                food_group += '<button class="btn btn-danger removeFoodBtn" data-value="'+food_id+'" data-name="'+food_name+'" data-amount="'+amount+'" data-quantity="'+quantity+'"><i class="fa fa-minus-square" aria-hidden="true"></i></button>';
            food_group += '</div>';                                 
        food_group += '</div>';

        return food_group;
    }     

    var createEditFood = function(item_name, item_id, quantity, amount, subtotal) {
        var item_group = '<div class="row foodWithQty" style="margin-bottom:5px; margin-top:5px;">';
            item_group += '<div class="col-sm-12 col-md-7">';
                item_group += '<input type="text" data-id="'+item_id+'" data-amount="'+amount+'" data-subtotal="'+subtotal+'" class="form-control" value="' + item_name + '" readonly/>';
            item_group += '</div>';
            item_group += '<div class="col-md-3">';
                item_group += '<input type="number" class="form-control itemQty" value="' + quantity + '" readonly/>';
            item_group += '</div>';
            item_group += '<div class="col-md-1">';
                item_group += '<button class="btn btn-danger editRemoveFoodBtn" data-subtotal="'+subtotal+'" data-value="'+item_id+'" data-name="'+item_name+'" data-amount="'+amount+'" data-quantity="'+quantity+'"><i class="fa fa-minus-square" aria-hidden="true"></i></button>';
            item_group += '</div>';                                 
        item_group += '</div>';

        return item_group;
    }

    $("#btnAddFoodToPackageEdit").on('click', function() {
        if ($("#edit_food_quantity").val().length == 0) {
            alert('Please specify the quantity.');
            $("#edit_food_quantity").focus();
            return;
        }

        var item_name = $("#edit_food_list").find(':selected').data('name');
        var category = $("#edit_food_list").find(':selected').data('category');
        var amount = $("#edit_food_list").find(':selected').data('amount');
        var subtotal = amount * $("#edit_food_quantity").val();

        reComputePriceEdit(amount * $("#edit_food_quantity").val(), 'add');

        $(".updateFoods").append(createEditFood(item_name, $("#edit_food_list").val(), $("#edit_food_quantity").val(), amount, subtotal));
        $("#edit_food_list option[value='"+$("#edit_food_list").val()+"']").remove();
        $("#edit_food_quantity").val('');
        $("#edit_food_quantity").focus();
    });

    $(document).on('click', '.removeFoodBtn', function() {
        var value = $(this).data('value'),
            name = $(this).data('name');
            amount = $(this).data('amount');
            quantity = $(this).data('quantity');

        $("#food_list").append('<option value="'+value+'" data-name="'+name+'" data-maxqty="'+maxqty+'" data-amount="'+amount+'" data-quantity="'+quantity+'">'+name+'</option>');
        $(this).parents('div').eq(1).remove();
        reComputePrice(amount * quantity, 'deduct');
    });

    $(document).on('click', '.editRemoveFoodBtn', function(e) {
        var value = e.currentTarget.dataset.value,
            maxqty = e.currentTarget.dataset.maxqty,
            name = e.currentTarget.dataset.name;
            amount = e.currentTarget.dataset.amount;
            quantity = e.currentTarget.dataset.quantity;
            subtotal = e.currentTarget.dataset.subtotal;

        $("#edit_food_list").append('<option value="'+value+'" data-name="'+name+'" data-maxqty="'+maxqty+'" data-amount="'+amount+'" data-quantity="'+quantity+'">'+name+'</option>');
        $(this).parents('div').eq(1).remove();
        reComputePriceEdit(subtotal, 'deduct');
    });

});