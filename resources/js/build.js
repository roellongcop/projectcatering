$(document).ready(function() {
	
	var custom_package_amount = 0;
	var theme_price = 0;
	var foods_total = 0;
	var items_total = 0; 
	var theme_price_added = 0;
	var old_theme_price = 0;

	$("#packagePriceBuild").text(formatPera(custom_package_amount));
	$('.price-display').text('TOTAL AMOUNT: '  + formatPera(custom_package_amount));

	$(document).on('click', '.food-click', function() {
		var id = $(this).data('id'),
			name = $(this).data('name'),
			price = $(this).data('price'),
			maxqty = $(this).data('maxqty'),
			image = $(this).data('image'),
			description = $(this).data('description');

		var foodChoices = $('.food-entry');

		if (foodChoices.length == 0) {
			$("#modalFoodImage").attr('src', image);
			$("#txtFoodID").val(id);
			$("#txtMaxQty").val(maxqty);
			$("#modalFoodName").text(name);
			$("#modalFoodDesc").text(description);
			$("#modalFoodPrice").text('PHP ' + price.toFixed(2));
			$("#txtFoodPrice").val(price);

			$("#txtFoodQty").val('');
			$("#txtFoodQty").focus();

			$(".foodQtyError").addClass('hide');

			$("#foodModal").modal('open');
		} else {
			for (var x = 0; x < foodChoices.length; x++) {
				if (id == foodChoices[x].dataset.id) {
					// alert('Item is already in the list');
					$("#buildError").text('Food is already in the list');
					$("#buildErrorModal").modal('open');
					return;
				} else {
					$("#modalFoodImage").attr('src', image);
					$("#txtFoodID").val(id);
					$("#txtMaxQty").val(maxqty);
					$("#modalFoodName").text(name);
					$("#modalFoodPrice").text('PHP ' + price.toFixed(2));
					$("#txtFoodPrice").val(price);

					$("#txtFoodQty").val('');
					$("#txtFoodQty").focus();

					$(".foodQtyError").addClass('hide');

					$("#foodModal").modal('open');
				}
			}
		}
		
	});

	$("#btnAddFood").on('click', function() {
		var id = $("#txtFoodID").val(),
			name = $("#modalFoodName").text(),
			price = $("#txtFoodPrice").val(),
			quantity = $("#txtFoodQty").val(),
			image = $("#modalFoodImage")[0].src,
			description = $("#modalFoodDesc").text();

			$("#food-error").addClass('hide');

		if (quantity == '') {
			$(".foodQtyError").removeClass('hide');
			$("#txtFoodQty").focus();
		} else {
			var subtotal = price * quantity;
			$('.build-food-table').append(createFoodEntry(id, name, price, quantity, subtotal, image, description));
			reComputePrice(subtotal, 'add');

			foods_total = parseInt(foods_total);

			foods_total += subtotal;

			$("#totalFoods").text(formatPera(foods_total));

			$("#foodModal").modal('close');
		}
		
	});

	$(document).on('click', '.btnRemoveFoodBuild', function(e) {
		var id = $(this).data('id'),
			name = $(this).data('name'),
			price = $(this).data('price'),
			quantity = $(this).data('quantity'),
			subtotal = $(this).data('subtotal');
			
		reComputePrice(subtotal, 'deduct');

		foods_total = parseInt(foods_total);
		foods_total -= subtotal;

		$("#totalFoods").text(formatPera(foods_total));

		$(this).parents('div')[2].remove();
	});

	function formatPera(num) {
	    var p = num.toFixed(2).split(".");
	    return "PHP " + p[0].split("").reverse().reduce(function(acc, num, i, orig) {
	        return  num + (i && !(i % 3) ? "," : "") + acc;
	    }, "") + "." + p[1];
	}

	function createFoodEntry(id, name, price, quantity, subtotal, image, desc) {
		var html = '';

			html += '<div class="food-entry" data-id="'+id+'" data-name="'+name+'" data-price="'+price+'" data-quantity="'+quantity+'" data-subtotal="'+subtotal+'" data-image="'+image+'" data-description="'+desc+'">';
				html += '<div class="row">';
					html += '<div class="col s4">';
						html += '<span>' + name + '</span>';
					html += '</div>';
					html += '<div class="col s3">';
						html += '<span>' + quantity + ' tray(s) </span>';
					html += '</div>';
					html += '<div class="col s3">';
						html += '<span>' + formatPera(subtotal) + '</span>';
					html += '</div>';
					html += '<div class="col s2">';
						html += '<span style="color: red;" class="btnRemoveFoodBuild" data-id="'+id+'" data-name="'+name+'" data-price="'+price+'" data-quantity="'+quantity+'" data-subtotal="'+subtotal+'" data-image="'+image+'" data-description="'+desc+'">remove</span>';
					html += '</div>';
				html += '</div>'
			html += '</div>';

		return html;
	}

	function reComputePrice(amount, command) {

		switch(command) {
			case 'add': 
				custom_package_amount = parseInt(custom_package_amount) + parseInt(amount);
				break;
			case 'deduct':
				custom_package_amount = custom_package_amount - amount;
				break;
		}

		$("#packagePriceBuild").text(formatPera(custom_package_amount));
		$('.price-display').text('TOTAL AMOUNT: '  + formatPera(custom_package_amount));
	}

	// $('.chips').material_chip();

	$('.food-cats').on('change', function() {
		$.ajax({
			url: base_url + 'site/get-foods/' + $(this).attr('id'),
			method: 'GET',
			dataType: 'html',
			success: function(response) {
				$("#buildFoodChoices").html(response);
			},
			failure: function(response) {
				console.log(response); return;
			}
		});
	});


	$('.item-cats').on('change', function() {
		var string_id = $(this).attr('id');
		var id =  string_id.replace('item_', '');
		$.ajax({
			url: base_url + 'site/get-items/' + id,
			method: 'GET',
			dataType: 'html',
			success: function(response) {
				$("#buildItemChoices").html(response);
			},
			failure: function(response) {
				console.log(response); return;
			}
		});
	});

	$(document).on('click', '.item-click', function() {

		var itemChoices = $('.item-entry');

		var id = $(this).data('id'),
			name = $(this).data('name'),
			price = $(this).data('price'),
			maxqty = $(this).data('maxqty'),
			image = $(this).data('image');

		if (itemChoices.length == 0) {
		
			$("#modalItemImage").attr('src', image);
			$("#txtItemID").val(id);
			$("#txtItemMaxQty").val(maxqty);
			$("#modalItemName").text(name);
			$("#txtItemPrice").val(price);
			$("#modalItemPrice").text(formatPera(price));

			$("#txtItemQty").val('');
			$("#itemQtyError").addClass('hide');

			$("#itemModal").modal('open');

		} else {
			for (var x = 0; x < itemChoices.length; x++) {
				if (id == itemChoices[x].dataset.id) {
					// alert('Item is already in the list');
					$("#buildError").text('Item is already in the list');
					$("#buildErrorModal").modal('open');
					return;
				} else {
					$("#modalItemImage").attr('src', image);
					$("#txtItemID").val(id);
					$("#txtItemMaxQty").val(maxqty);
					$("#modalItemName").text(name);
					$("#txtItemPrice").val(price);
					$("#modalItemPrice").text(formatPera(price));

					$("#txtItemQty").val('');

					$("#itemModal").modal('open');
				}
			}
		}
		
	});

	function createItemEntry(id, name, price, maxqty, quantity, subtotal) {
		var html = '';

			html += '<div class="item-entry" data-id="'+id+'" data-name="'+name+'" data-price="'+price+'" data-maxqty="'+maxqty+'" data-quantity="'+quantity+'" data-subtotal="'+subtotal+'">';
				html += '<div class="row">';
					html += '<div class="col s4">';
						html += '<span>' + name + '</span>';
					html += '</div>';
					html += '<div class="col s3">';
						html += '<span>' + quantity + ' piece(s) </span>';
					html += '</div>';
					html += '<div class="col s3">';
						html += '<span>' + formatPera(subtotal) + '</span>';
					html += '</div>';
					html += '<div class="col s2">';
						html += '<span style="color: red;" class="btnRemoveItemBuild" data-id="'+id+'" data-name="'+name+'" data-price="'+price+'" data-maxqty="'+maxqty+'" data-quantity="'+quantity+'" data-subtotal="'+subtotal+'">remove</span>';
					html += '</div>';
				html += '</div>'
			html += '</div>';

		return html;


	}

	$(".custom_event_date").on('change', function() {
		$("#error-date").addClass('hide');
	});

	$("#btnAddItem").on('click', function() {
		var id = $("#txtItemID").val(),
			name = $("#modalItemName").text(),
			price = $("#txtItemPrice").val(),
			maxqty = $("#txtItemMaxQty").val(),
			quantity = $("#txtItemQty").val();

		if ($("#txtItemQty").val().length < 1 || $("#txtItemQty").val() == 0) {
			$('.itemQtyError').removeClass('hide');	
			return;
		} else {
			if (parseInt(quantity) > parseInt(maxqty)) {
				$("#buildError").text('Not enough stock');
				$("#buildErrorModal").modal('open');
			} else {

				var subtotal = price * quantity;

				$('.build-item-table').append(createItemEntry(id, name, price, maxqty, quantity, subtotal));
				reComputePrice(subtotal, 'add');

				items_total = parseInt(items_total);

				items_total += subtotal;
				$("#totalItems").text(formatPera(items_total));
				
				$("#itemModal").modal('close');
			}
			
		}

	});

	$(document).on('click', '.btnRemoveItemBuild', function(e) {
		var subtotal = $(this).data('subtotal');
		reComputePrice(subtotal, 'deduct');

		items_total -= subtotal;
		$("#totalItems").text(formatPera(items_total));

		$(this).parents('div')[2].remove();
		// $(this).parents('div').eq(0).remove();
	});

	$("#theme_desc").on('keypress', function() {
		if ($(this).val().length > 1) {
			$('#error-theme').addClass('hide');
		}
	});

	$("#btnSaveCustom").on('click', function() {
	
		var myDate = new Date($(".custom_event_date").val());
        var finalDate = myDate.getFullYear() + '-' + addZero(myDate.getMonth() + 1) + '-' + addZero(myDate.getDate());

        var theme = null;
        
        if ($("#buildSelectTheme").val() != null) {
        	theme = $("#buildSelectTheme").val();
        } else {
        	theme = 0;// to do create upload
        }

        // foods 
        var foods = {};
		var foods_panel = $(".build-food-table");
		var food_entry = foods_panel.find('.food-entry');

        food_entry.each(function(index) {
			foods[index] = {
				id: $(this)[0].dataset.id,
				name: $(this)[0].dataset.name,
				quantity: $(this)[0].dataset.quantity,
				subtotal: $(this)[0].dataset.subtotal,
				price: $(this)[0].dataset.price,
			}
		});
		foods = JSON.stringify(foods);

		// items 
		var items = {};
		var items_panel = $(".build-item-table");
		var item_entry = items_panel.find('.item-entry');

        item_entry.each(function(index) {
			items[index] = {
				id: $(this)[0].dataset.id,
				name: $(this)[0].dataset.name,
				quantity: $(this)[0].dataset.quantity,
				subtotal: $(this)[0].dataset.subtotal,
				price: $(this)[0].dataset.price,
			}
		});
		items = JSON.stringify(items);

		var totalAmount = theme_price + items_total + foods_total;
		// custom_package_amount += theme_price;
		// cusstom_package_amount +=

		// alert(totalAmount); return;
		
		saveCustomDetails(theme, foods, items, finalDate, totalAmount, items_total, foods_total, theme_price);

	});

	function saveCustomDetails(theme, foods, items, date, packageAmount, itemTotal, foodTotal, themeTotal) {
		$.ajax({
			url: base_url + 'site/save-custom',
			method: 'POST',
			dataType: 'json',
			data: {
				theme_id: theme,
				theme_desc: $("#theme_desc").val(),
				foods: foods,
				items: items,
				date: date,
				package_total: packageAmount,
				item_total: itemTotal,
				food_total: foodTotal,
				theme_total: themeTotal
			},
			success: function(response) {
				if (response == 1) {
					location.href = base_url + 'prepareData';
				}
			},
			failure: function(response) {
				console.log(response); return;
			}
		});
	}

	function addZero(n) {
	    return n < 10 ? '0'+ n: '' + n;
	}

	$(".food-cats").change(function() {
        $(".food-cats").prop('checked', false);
        $(this).prop('checked', true);
    });

    $('.parallax').parallax();

    $(".item-cats").change(function() {
        $(".item-cats").prop('checked', false);
        $(this).prop('checked', true);
    });

    $('#food-parallax').hide();
    $('#item-parallax').hide();
    $('#summary-parallax').hide();

	$('.next-food').on('click', function(e) {
		if ($('.custom_event_date').val() == '') {
			$('#error-date').removeClass('hide');
			$('.custom_event_date').focus();
			e.preventDefault();
		} else {
			$("#build-parallax img").attr('src', base_url + 'resources/img/pexels-photo-205961.jpeg');
			$('.parallax').parallax();
			$('#food-parallax').fadeIn('slow');
			$('#theme-parallax').fadeOut('fast');
		}
	});

	$('.prev-theme').on('click', function() {
		$("#build-parallax img").attr('src', base_url + 'resources/img/birthday-cake-celebration-353347.jpg');
		$('.parallax').parallax();
		$('#food-parallax').fadeOut('fast');
		$('#theme-parallax').fadeIn('slow');
	});

	$('.next-item').on('click', function(e) {
		$("#build-parallax img").attr('src', base_url + 'resources/img/buildbot.jpg');
		$('.parallax').parallax();
		$('#item-parallax').fadeIn('slow');
		$('#food-parallax').fadeOut('fast');
	});

	$('.prev-foods').on('click', function() {
		$("#build-parallax img").attr('src', base_url + 'resources/img/pexels-photo-205961.jpeg');
		$('.parallax').parallax();
		$('#item-parallax').fadeOut('fast');
		$('#food-parallax').fadeIn('slow');
	});

	$('.next-summary').on('click', function(e) {

		var items = {};
		var items_panel = $(".build-item-table");
		var item_entry = items_panel.find('.item-entry');

		if (item_entry.length < 1) {
        	$("#item-error").removeClass('hide');
			e.preventDefault();
        } else {
        	$("#build-parallax img").attr('src', base_url + 'resources/img/pexels-photo-205961.jpeg');
			$('.parallax').parallax();
			$('#item-parallax').fadeOut('fast');
			$('#summary-parallax').fadeIn('slow');
        }
		
	});

	$('.prev-items').on('click', function() {
		$("#build-parallax img").attr('src', base_url + 'resources/img/buildbot.jpg');
		$('.parallax').parallax();
		$('#item-parallax').fadeIn('slow');
		$('#summary-parallax').fadeOut('fast');
	});

	$('.btnShowTheme').on('click', function() {
		$('.theme-desc-area').addClass('hide');
    	$('.select-theme-area').removeClass('hide');
    	$('.build-theme').removeClass('hide');
    	$('.show-theme').addClass('hide');

    	$("#buildSelectTheme").prop('selectedIndex', 0);
    	$("#buildSelectTheme").material_select();
    	
    	var images = $(".build-theme")[0].children;

    	for (var i = 0; i < images.length; i++) {
            images[i].className = 'hide';
        }
	});

	$("#buildSelectTheme").on('change', function(e) {

        if ($(this).val() == 0) {
        	$('.theme-desc-area').removeClass('hide');
        	$('.select-theme-area').addClass('hide');
        	$('.build-theme').addClass('hide');
        	$('.show-theme').removeClass('hide');

        	theme_price = 0;

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

		    $("#totalTheme").text(formatPera(theme_price));
        } else {
        	$('.theme-desc-area').addClass('hide');
        	$('.select-theme-area').removeClass('hide');
        	$('.build-theme').removeClass('hide');
        	$('.show-theme').addClass('hide');

        	var images = $(".build-theme")[0].children,
	            key = 'theme_' + $(this).val();

		    theme_price = parseInt($(this)[0].options[$(this)[0].selectedIndex].dataset.price);

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

	        for (var i = 0; i < images.length; i++) {
	            if (images[i].id === key) {
	                images[i].className = '';
	            } else {
	                images[i].className = 'hide';
	            }
	        }

	        $(".build-theme-upload").addClass('hide');
	        $(".build-theme").removeClass('hide');

	        $("#buildThemeImg").val('');
	        $("#error-theme").addClass('hide');
	        $("#totalTheme").text(formatPera(theme_price));
        }


    });


});