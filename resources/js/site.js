$(document).ready(function() {

    $(".button-collapse").sideNav();

    $('.print-details').on('click', function() {
        $(".details-print").printThis({
            importCSS: true,            // import page CSS
            importStyle: true,         // import style tags
            header: constructHeader()
        });
    });

    $('#cancelReservation').on('click', function() {
        if ($("#cancel_reason").val().length < 1) {
            $('.irror').removeClass('hide');
        } else {
            $.ajax({
                url: base_url + 'cancel-reservation/' + $(this).data('id'),
                method: 'POST',
                dataType: 'json',
                data: {
                    cancelled_flag: 1,
                    cancel_reason: $("#cancel_reason").val()
                },
                success: function(response) {
                    if (response == 1) {
                        location.reload();
                    } else {
                        alert('An error has occured, ' + response.responseText);
                    }
                },
                failure: function(response) {
                    alert('An error has occured, ' + response.responseText);
                }
            });
        }
    });

    $('.btnMyReservation').on('click', function() {
        $.ajax({
            url: base_url + 'find-reservation',
            method: 'POST',
            dataType: 'json',
            data: {
                reservation_code: $("#reservation_code").val(),
                email: $("#reservation_email").val()
            },
            success: function(response) {
                if (response.success === false) {
                    $('.res-error').removeClass('hide');
                } else {
                    location.href = base_url + 'details/' + response.data + '/' + 1;
                }
            },
            failure: function(response) {
                alert('An error has occured, ' + response.responseText);
            }
        });
    }); 

    $('.timepicker').pickatime({
        default: 'now',
        twelvehour: true, // change to 12 hour AM/PM clock from 24 hour
        donetext: 'OK',
        autoclose: false,
    });

    $("#event_start_time").on('change', function() {
        if ($(this).val().length > 0) {
            $("#event_end_time").prop('disabled', false);
        }
    });

    var invalid_time = 0;

    $("#event_end_time").on('change', function() {

        var startDate = $("#event_start_time").val();
        var start_digit = startDate.slice(0, 5),
            start_pref = startDate.slice(5, 7);

        var endDate = $("#event_end_time").val();
        var end_digit = endDate.slice(0, 5),
            end_pref = endDate.slice(5, 7);

        var a = "11/24/2014 " + start_digit + ' ' + start_pref; 
        var b = "11/24/2014 " + end_digit + ' ' + end_pref; 

        var aDate = new Date(a).getTime();
        var bDate = new Date(b).getTime();

        invalid_time = 0;
        if (aDate > bDate) {
            $("#event_end_time").val('');
            $("#event_end_time").css('border-color', 'red');
            invalid_time = 1;
            $("#reserveErrorModal").modal('open');
        } else if (bDate > aDate) {
            $("#event_end_time").css('border-color', '#ccc');
        }
    });


    $("#selectVenue").on('change', function(e) {

        if ($(this).val() != 0) {
            $('.venue-desc-area').addClass('hide');
            $(".or").addClass('hide');
            $.ajax({
                url: base_url + 'reserve/get-venue/' + $(this).val(),
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    $('.venue-theme').removeClass('hide');
                    $("#venueDesc").text(response.description);
                    $("#venueImagePreview").attr('src', response.image.current_path);
                },
                failure: function(response) {
                    alert('An unexpected error occured, ' + response.responseText);
                }
            });
        } else {
            $(".or").removeClass('hide');
            $('.venue-theme').addClass('hide');
            $('.venue-desc-area').removeClass('hide');
        }
    });

    $('.parallax').parallax();
    $('.carousel').carousel({
        dist: 0,
        indicators: true,
        padding: 20,
    });


    function constructHeader() {
        var html = '';

        
        html += '<div class="row">';
            html += '<div class="col-md-12">';
                html += '<img src="'+base_url+'resources/img/logo.jpg" class="print-logo" />';
            html +=' </div>';
        html += '</div>';

        return html;
    }


    $(".btnBuild").on('click', function() {
        location.href = base_url + 'site/build/' + $(this).data('id');
    }); 

    $('.review-item').on('click', function() {
        $.ajax({
            url: base_url + 'site/get-item-image/' + $(this).data('id'),
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                $("#reviewImageModal").attr('src', base_url + response);

                $("#imageModal").modal('open');
            },
            failure: function(response) {
                console.log(response); return;
            }
        })
    });

    $('.food-review-item').on('click', function() {
        $.ajax({
            url: base_url + 'site/get-food-image/' + $(this).data('id'),
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                $("#reviewImageModal").attr('src', base_url + response);

                $("#imageModal").modal('open');
            },
            failure: function(response) {
                console.log(response); return;
            }
        })
    });

    

    $("#buildThemeImg").on('change', function() {
        $(".build-theme").addClass('hide');
        $(".build-theme-upload").removeClass('hide');

        readURL(this, $("#buildThemePreview"));
    }); 

    function readURL(input, preview) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                preview.attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $('select').material_select();

    $(".pastEventMore").on('click', function() {
        $.ajax({ 
            url: base_url + 'past-event/' + $(this).data('id'),
            method: 'GET',
            dataType: 'html',
            success: function(response) {
                $("#pastEventModal .modal-content").html(response);

                $("#pastEventModal").modal('open');
            },  
            failure: function(response) {
                console.log(response); return;
            }
        });
    });

    $("#showAllEvents").on('click', function() {
        location.href = base_url + 'clients/events';
    });

    $('.tooltipped').tooltip({delay: 50});

    $('#btnShowEvents').on('click', function() {
        $('html, body').animate({
            scrollTop: $("#eventsContainer").offset().top - 70
        }, 1000);

        var lis = $('#nav-mobile')[0].children;

        for (var i = 0; i < lis.length; i++) {
            if (lis[i].children[0].children[0].className == 'active-si-li') {
                lis[i].children[0].children[0].className = '';
            } 
        }
        $(this).addClass('active-si-li');
    });

    $('.backToFirst').on('click', function() {
        $(this).addClass('hide');
        $('#eventsContainer').addClass('hide');
        $('.carousel').carousel({
            dist: 0,
            indicators: true,
            padding: 20,
        });
        $('#choicesContainer').removeClass('hide');

        $('html, body').animate({
            scrollTop: $("#choicesContainer").offset().top - 70
        }, 1000);
    });

    $('.backToEvents').on('click', function() {
        $(this).addClass('hide');
        $('.carousel').carousel({
            dist: 0,
            indicators: true,
            padding: 20,
        });
        $('#eventsContainer').removeClass('hide');
        $('#packages-area').addClass('hide');
    });

    $(".view-packages-area").on('click', function() {
        
        $.ajax({
            url: base_url + 'get-packages/' + $(this).data('id'),
            method: 'GET',
            dataType: 'html',
            success: function(response) {
                $("#packages-area").replaceWith(response);
                $('#packages-area').removeClass('hide').fadeIn('slow');
                $('#eventsContainer').addClass('hide');
                $(".backToFirst").addClass('hide');
                $('.backToEvents').removeClass('hide');
            }, 
            failure: function(response) {
                console.log(response); return;
            }
        })
    });

    $('.custom-cat-box').on('click', function() {
        $.ajax({
            url: base_url + 'custom/get-item/' + $(this).data('id'),
            method: 'GET',
            dataType: 'html',
            success: function(response) {
                $("#customItemsArea").replaceWith(response);
                $("#customItemsArea").removeClass('hide');
                $("#customCategoriesArea").addClass('hide');
                $('.backToCategories').removeClass('hide');
            },
            failure: function(response) {
                console.log(response); return;
            }
        });
    });

    $('.backToCategories').on('click', function() {
        $(this).addClass('hide');
        $("#customItemsArea").addClass('hide');
        $("#customCategoriesArea").removeClass('hide');
    });

    $(document).on('click', '.view-package-info', function(e) {
        $('.btnSelectPackage').attr('data-id', e.currentTarget.dataset.id);
        getPackageById(e.currentTarget.dataset.id);
    });

    function getPackageById(id) {
        $.ajax({
            url: base_url + 'site/get-package/' + id,
            method: 'GET',
            dataType: 'html',
            success: function(response) {
                $("#packageModal .modal-content").replaceWith(response);
                getReservedDates();
                $("#packageModal").modal('open');
            },
            failure: function(response) {
                console.log(response); return;
            }
        });
    }


$("#packagesArea").hide();


$('.event-box').on('click', function() {
    $("#eventsArea").fadeOut('show');
    $("#packagesArea").fadeIn('slow');
});

$('.package').on('mouseover', function() {
    $(this).addClass('z-depth-3');
});
$('.package').on('mouseleave', function() {
    $(this).removeClass('z-depth-3');
});

$('.modal').modal({
    dismissible: true, 
});


$('.package').on('click', function() {
    $("#packageModal").modal('open');
});

$('.collapsible').collapsible();	

function getReservedDates() {

    var fullDaysArray = [];
    var currDate = new Date();
    var numberOfDaysToAdd = 30;
    currDate.setDate(currDate.getDate() + numberOfDaysToAdd); 

    var dd = currDate.getDate();
    var mm = currDate.getMonth() + 1;
    var y = currDate.getFullYear();

    thirtyDays = y + '/' + mm + '/' + dd;

    var $input = $(".event_date").pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 15, // Creates a dropdown of 15 years to control year,
        min: new Date(thirtyDays),
        // format: 'yyyy-mm-dd',
        today: 'Today',
        clear: 'Clear',
        close: 'Ok',
        closeOnSelect: true,
        onRender: function() {
            fullDaysArray.forEach( function( date ) {
                $('[data-pick=' + new Date(date[0], date[1], date[2]).getTime() + ']').addClass( 'pickadate--full' )
            })
        }
    });

    var picker = $input.pickadate('picker');

    $.ajax ({
        url: base_url + 'get-available-dates',
        method: 'GET',
        dataType: 'json',
        success: function (response) {

            for (var i = 0; i < response.length; i++) {
                var str = response[i];
                var res = str.split(",");
                picker.set('disable', [
                    [parseInt(res[0]), parseInt(res[1]), parseInt(res[2])], 
                ]);
                fullDaysArray.push([parseInt(res[0]), parseInt(res[1]), parseInt(res[2])]);
            }
            
            fullDaysArray.forEach( function( date ) {
                $('[data-pick=' + new Date(date[0], date[1], date[2]).getTime() + ']').addClass( 'pickadate--full' )
            })

        },
        error: function (response) {
            console.log(response);
        }
    });
}

function getReservedDatesForCustom() {

    var fullDaysArray = [];
    var currDate = new Date();
    var numberOfDaysToAdd = 30;
    currDate.setDate(currDate.getDate() + numberOfDaysToAdd); 

    var dd = currDate.getDate();
    var mm = currDate.getMonth() + 1;
    var y = currDate.getFullYear();

    thirtyDays = y + '/' + mm + '/' + dd;

    var $input = $(".custom_event_date").pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 15, // Creates a dropdown of 15 years to control year,
        min: new Date(thirtyDays),
        today: 'Today',
        clear: 'Clear',
        close: 'Ok',
        closeOnSelect: true, // Close upon selecting a date,
        closeOnClear: true,
        onRender: function() {
            fullDaysArray.forEach( function( date ) {
                $('[data-pick=' + new Date(date[0], date[1], date[2]).getTime() + ']').addClass( 'pickadate--full' )
            });
        }
    });

    var picker = $input.pickadate('picker');

    $.ajax ({
        url: base_url + 'get-available-dates',
        method: 'GET',
        dataType: 'json',
        success: function (response) {

            for (var i = 0; i < response.length; i++) {
                var str = response[i];
                var res = str.split(",");
                picker.set('disable', [
                    [parseInt(res[0]), parseInt(res[1]), parseInt(res[2])], 
                ]);
                fullDaysArray.push([parseInt(res[0]), parseInt(res[1]), parseInt(res[2])]);
            }
            
            fullDaysArray.forEach( function( date ) {
                $('[data-pick=' + new Date(date[0], date[1], date[2]).getTime() + ']').addClass( 'pickadate--full' )
            })

        },
        error: function (response) {
            console.log(response);
        }
    });
}

if (typeof package_details != 'undefined' && package_details == 1) {
    getReservedDates();
}

if (typeof build != 'undefined' && build == 1) {
    getReservedDatesForCustom();
}

$('.event_date').on('change', function(e) {
    getReservedDates();
    if ($(this).val() != '') {
        $('.event_date').css('border-color', '#9e9e9e');
    }
});

$('.custom_event_date').on('change', function(e) {
    getReservedDatesForCustom();
    if ($(this).val() != '') {
        $(".custom-date-error").addClass('hide');
    }  
});


function addZ(n) {
    return n < 10 ? '0'+ n: '' + n;
}

$('.btnSelectPackage').on('click', function(e) {
    if ($(".event_date").val().length > 0) {
        var myDate = new Date($(".event_date").val());
        myDate = myDate.getFullYear() + '-' + addZ(myDate.getMonth() + 1) + '-' + addZ(myDate.getDate());
        location.href = base_url + 'prepareData/' + e.currentTarget.dataset.id + '/' + myDate;
    } else {
        $(".event_date")[0].placeholder = 'Please provide your event date';
        $(".event_date").css('border-color', 'red');
        $(".event_date").focus();
    }
});

$('.modal').modal();

$('ul.tabs').tabs();

$('.dropdown-button').dropdown({
      inDuration: 300,
      outDuration: 225,
      constrainWidth: true, // Does not change width of dropdown to that of the activator
      hover: true, // Activate on hover
      gutter: 0, // Spacing from edge
      belowOrigin: true, // Displays dropdown below the button
      alignment: 'left', // Displays dropdown with edge aligned to the left of button
      stopPropagation: false // Stops event propagation
    }
);

    $(document).on('click', '.customItem', function(e) {

        $("#customItemId").val(e.currentTarget.dataset.id);
        $("#customItemName").val(e.currentTarget.dataset.name);
        $("#customItemPrice").val(e.currentTarget.dataset.price);
        $("#customMaxQty").val(e.currentTarget.dataset.maxqty);

        $("#customtxtItemQty").val("");
        $("#itemQuantityModal").modal('open');

    });

    $(".btnAddCustomItem").on('click', function(e) {

        if ($("#customtxtItemQty").val().length == 0) {
            $(this).focus();
            $('.qty-error').removeClass('hide');
            e.preventDefault();
        } else {
            if (parseInt($("#customtxtItemQty").val()) > parseInt($("#customMaxQty").val()) === true) {
                $("#itemQuantityModal").modal('close');
                $("#warningMessage").text('Sorry. This item has only a maximum of ' + $("#customMaxQty").val() + ' availability');
                $("#warningModal").modal('open');
                e.preventDefault();
            } else {
                $.ajax({
                    url: base_url + 'custom/build-items',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        item_id: $("#customItemId").val(),
                        name: $("#customItemName").val(),
                        price: $("#customItemPrice").val(),
                        quantity: $("#customtxtItemQty").val(),
                    },
                    success: function(response) {
                        if (response.success == 1) {
                            location.reload();
                        } else {
                            $("#itemQuantityModal").modal('close');
                            $("#warningMessage").text(response.msg);
                            $("#warningModal").modal('open');
                        }
                    }, 
                    failure: function(response) {
                        alert(response.msg);
                    }
                });
            }
        }
    });

    $("#btnProceedCustom").on('click', function() {
        if ($("#cart_count").val() == 0)  {
            $("#warningMessage").text('Add items to your cart first!');
            $("#warningModal").modal('open');
        } else {
            location.href = base_url + 'prepareData/';
        }
    });

    $(".btnRemoveItem").on('click', function() {
        $.ajax({
            url: base_url + 'custom/remove/' + $(this).data('id'),
            method: 'POST',
            dataType: 'json',
            success: function(response) {
                if (response.success == 1) {
                    location.reload();
                } else {
                    alert(response.msg); location.reload();
                }
            },
            failure: function(response) {
                console.log(response);
            }
        })
    });

    function validateEmail(email) {  
    
        if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email))  {  
            return (true);  
        }  
        return (false)  
    }  

    $("#email_address").on('blur', function() {
        if ($(this).val().length > 0) {
            var validate = validateEmail($(this).val());
            if (validate) {
                $("#error-email").addClass('hide');
            } else {
                $("#error-email").removeClass('hide');
            }
        }
    });

    $("#email_address").on('keyup', function() {
        if ($(this).val().length > 0) {
            $("#error-email").addClass('hide');
        }
    });

    $("#confirm_email").on('blur', function() {
        if ($(this).val().length > 0) {
            if ($(this).val() != $("#email_address").val()) {
                $("#error-confirm-email").removeClass('hide');
            } else {
                $("#error-confirm-email").addClass('hide');
            }
        }
    });

    $("#full_name").on('keyup', function() {
        if ($(this).val().length > 0) {
            $("#error-fullname").addClass('hide');
        }
    });

    $("#contact_no").on('keyup', function() {
        if ($(this).val().length > 0) {
            $("#error-contact").addClass('hide');
        }
    });

    $("#address").on('keyup', function() {
        if ($(this).val().length > 0) {
            $("#error-address").addClass('hide');
        }
    });

    $("#btnSendReservation").on('click', function() {

        $.ajax({
            url: base_url + 'check-code',
            method: 'POST',
            dataType: 'json',
            data: {
                code: $("#code").val(),
                email_address: $("#email_address").val(),
            },
            success: function(response) {
                if (response.success == false) {
                    $("#labelError").text(response.message);
                } else {
                    saveReservation();
                }
            }, 
            failure: function(response) {
                console.log(response);
            }
        });
    });

    function saveReservation() {

        var middle_name = '';

        if ($("#mname").val().length > 1) {
            middle_name = $("#mname").val();
        }

        var file_data = $('#valid_id_proof').prop('files')[0];

        if (typeof file_data != 'undefined') {
            
            var form_data = new FormData();
            form_data.append('file', file_data);    

            $.ajax ({
                url: base_url + 'reserve/upload',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function (response) {
                    if (response == 1) {
                        $.ajax({
                            url: base_url + 'reservation/process',
                            method: 'POST',
                            dataType: 'json',
                            data: {
                                code: $("#code").val(),
                                full_name: $("#lname").val() + ', ' + middle_name + ' ' + $("#fname").val(),
                                email_address: $("#email_address").val(),
                                contact_no: $("#contact_no").val(),
                                address: formatAddress(),
                                venue_id: $("#selectVenue").val(),
                                venue_desc: $("#venue_desc").val(),
                                event_time: $("#event_start_time").val() + ' TO ' + $("#event_end_time").val()
                            }, 
                            success: function(response) {
                                if (response !== false) {
                                    location.href = base_url + 'details/' + response + '/' + 0;
                                } else {
                                    alert('An unexpected error occured,' + response);
                                }
                            }, 
                            failure: function(response) {
                                alert('An unexpected error occured,' + response.responseText);
                            }
                        });
                    } else {
                        alert('An unexpected error occured,' + response.responseText);
                        location.reload();
                    }
                },
                error: function (response) {
                    console.log(response);
                }
            });
        }

        
    }

    function formatAddress() {
        var number = '',
            blk = '',
            lot = '',
            st_brgy = '',
            city = '';

        if ($("#house_number").val().length !== 0) {
            number = $("#house_number").val();
        }

        if ($("#block").val().length !== 0) {
            blk = $("#block").val();
        }

        if ($("#block").val().length !== 0) {
            lot = $("#block").val();
        }

        if ($("#st_brgy").val().length !== 0) {
            st_brgy = $("#st_brgy").val();
        }

        if ($("#city").val().length !== 0) {
            city = $("#city").val();
        }   

        var address = '';

        if (number != '') {
            address += 'House #' + number;
        } 

        if (blk != '') {
            address += ' B' + blk;
        }

        if (lot != '') {
            address += ' L' + lot;
        }

        if (st_brgy != '') {
            address += ' ' + st_brgy;
        }

        if (city != '') {
            address += ' ' + city;
        }

        return address;
    }

    $("#contact_no").on('keypress', function(e) {
        if ($(this).val().length == 11) {
            e.preventDefault();
            return false;
        }
    });

    $('.resend-code').on('click', function() {
        $("#resendCodeArea").html('Resending confirmation code..');
        $.ajax({
            url: base_url + 'send-code',
            method: 'POST',
            dataType: 'json',
            data: {
                fullname: $("#full_name").val(),
                email: $("#email_address").val()
            },
            success: function(response) {
                if (response == 1) {
                    $("#resendCodeArea").html('Code successfully sent! Please check your spam/inbox');
                } else {
                    alert('An error occured', response);
                }
            },
            failure: function(response) {
                alert('An error occured', response.responseText);
            }
        });
    });

    $("#btnReserve").on('click', function(e) {

        var errors = [];


        var file_data = $('#valid_id_proof').prop('files')[0];

        if (typeof file_data == 'undefined') {
            errors.push('image');
            $("#error-image").removeClass('hide');
        } else {
            $("#error-image").addClass('hide');
        }

        if ($("#fname").val().length < 1) {
            $("#error-fname").removeClass('hide');
            errors.push('fname');
        } else {
            $("#error-fname").addClass('hide');
        }

        if ($("#lname").val().length < 1) {
            $("#error-lname").removeClass('hide');
            errors.push('lname');
        } else {
            $("#error-lname").addClass('hide');
        }

        if ($("#contact_no").val().length < 1) {
            $("#error-contact").removeClass('hide');
            errors.push('contact');
        } else {
            $("#error-contact").addClass('hide');
        }

        if ($("#house_number").val().length < 1 && $("#block").val().length < 1 && $("#lot").val().length < 1 && $("#st_brgy").val().length < 1 && $("#city").val().length < 1) {
            $("#error-address").removeClass('hide');
            errors.push('address');
        } else {
            $("#error-address").addClass('hide');
        }

        if ($('#filled-in-box').is(":checked") == false) {
            $("#error-terms").removeClass('hide');
            errors.push('terms');
        } else {
            $("#error-terms").addClass('hide');
        }

        formatAddress();

        if ($("#email_address").val().length < 1) {
            $("#error-email").text('Email is required');
            $("#error-email").removeClass('hide');
            errors.push('email');
        } else {
            if (! validateEmail($("#email_address").val())) {
                $("#error-email").text('Invalid Email');
                $("#error-email").removeClass('hide');
                errors.push('email');
            } else {
                $("#error-email").addClass('hide');
            }
        }

        if ($("#email_address").val() != $("#confirm_email").val()) {
            $("#error-confirm-email").removeClass('hide');
            errors.push('email');
        } else {
            $("#error-confirm-email").addClass('hide');
        }

        if (invalid_time == 1) {
            errors.push('time');
        }

        if ($("#event_start_time").val().length < 1) {
            errors.push('no_time');
            $("#event_start_time").css('border-color', 'red');
            $('html, body').animate({
                scrollTop: $("#event_start_time").offset().top - 100
            }, 500);
        }

        if ($("#event_end_time").val().length < 1) {
            errors.push('no_time');
            $("#event_end_time").css('border-color', 'red');
            $('html, body').animate({
                scrollTop: $("#event_end_time").offset().top - 100
            }, 500);
        }

        if (errors.length == 0) {

            $("#preloaderModal").modal({
                dismissible: false
            });
            
            $("#preloaderModal").modal('open');

            $.ajax({
                url: base_url + 'send-code',
                method: 'POST',
                dataType: 'json',
                data: {
                    fullname: $("#full_name").val(),
                    email: $("#email_address").val()
                },
                success: function(response) {
                    if (response == 1) {

                        $("#preloaderModal").modal('close');

                        $("#codeModal").modal({
                            dismissible: false
                        });

                        $("#codeModal").modal('open');
                    } else {
                        alert('An error occured');
                    }
                },
                failure: function(response) {
                    console.log(response); return;
                }
            });

            
        } else {
            e.preventDefault();
        }

    });

});