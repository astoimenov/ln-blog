$(document).ready(function() {

	$(document).delegate('.ajax-action', 'click', function(e){
    	e.preventDefault();
     	var id = $(this).data('id');
     	var confirm_text = $(this).data('confirm');
    	var url = $(this).attr('href');
    	var _this = $(this);
    	var message_title = $(this).data('title')? $(this).data('title'): '';
    	var message_text = $(this).data('message')? $(this).data('message'): '';
    	//if action is delete get closest element
    	var delete_closest = $(this).data('delete')? $(this).data('delete'): '';

    	var ajax_type = $(this).data('jstype')? $(this).data('jstype'): 'json';

    	if(id!='' && url!=''){
	    	if (confirm_text) {
				var co = confirm(confirm_text);
	    		if (co == true) {
				    $.ajax({
				   		url: url,
				   		type: "POST",
						dataType: ajax_type,
						data: {id: $(this).data('id')},
				   		success: function(data, textStatus, XMLHttpRequest){
				   			//show notification
				   			show_notification_mesage(message_title, message_text, 'success');


				   			if(delete_closest){
					   			_this.closest(delete_closest).remove();
					   		}
						},
						error: function(XMLHttpRequest, textStatus, errorThrown){
							//alert("error:http", XMLHttpRequest);
						}
					});
				} else {

				}
			}else{
				 $.ajax({
			   		url: url,
			   		type: "POST",
					dataType: ajax_type,
					data: {id: $(this).data('id')},
			   		success: function(data, textStatus, XMLHttpRequest){
			   			//show notification
				   		show_notification_mesage(message_title, message_text, 'success');

				   		if(data.status){
				   			//add new classes
				   			if(data.status=='active'){
					   			_this.removeClass('yellow');
					   			_this.find('i').removeClass('fa-lock');
					   			_this.addClass('green');
					   			_this.find('i').addClass('fa-unlock');
					   		}

					   		if(data.status=='inactive'){
					   			_this.removeClass('green');
					   			_this.find('i').removeClass('fa-unlock');
					   			_this.addClass('yellow');
					   			_this.find('i').addClass('fa-lock');
					   		}
					   		//add new status text
					   		_this.find('span').text(data.status);

				   		}

				   		if(data.featured){
				   			//add new classes
				   			if(data.featured=='featured'){
					   			_this.removeClass('purple');
					   			_this.find('i').removeClass('fa-lock');
					   			_this.addClass('green');
					   			_this.find('i').addClass('fa-unlock');
					   		}

					   		if(data.featured=='unfeatured'){
					   			_this.removeClass('green');
					   			_this.find('i').removeClass('fa-unlock');
					   			_this.addClass('purple');
					   			_this.find('i').addClass('fa-lock');
					   		}
					   		//add new status text
					   		_this.find('span').text(data.featured);

				   		}

				   		if(delete_closest){
				   			_this.closest(delete_closest).remove();
				   		}
					},
					error: function(XMLHttpRequest, textStatus, errorThrown){
						//$(document).trigger("error:http", XMLHttpRequest);
					}
				});
			}
		}

		return false;
    });

	var substringMatcher = function(strs) {

		return function findMatches(q, cb) {
			var matches, substrRegex;

			// an array that will be populated with substring matches
			matches = [];

			// regex used to determine if a string contains the substring `q`
			substrRegex = new RegExp(q, 'i');

			// iterate through the pool of strings and for any string that
			// contains the substring `q`, add it to the `matches` array
			$.each(strs, function(i, str) {
				if (substrRegex.test(str)) {
				// the typeahead jQuery plugin expects suggestions to a
				// JavaScript object, refer to typeahead docs for more info
				matches.push({ value: str,  id: i });
				}
			});

			cb(matches);
		};
	};

	if(typeof autocomplete_json != 'undefined'){
		$('.autocomplete').typeahead(
			{
			  hint: true,
			  highlight: true,
			  minLength: 2
			},
			{
			  name: 'city',
			  displayKey: 'value',
			  source: substringMatcher(autocomplete_json)
			}
		);


		$('.autocomplete').on('typeahead:selected', function (e, item) {
			$('input[name="city"]').val(item.id);
		})
		.on('change', function(e) {
          	$('input[name="city"]').val('');
    	});

	}

	if(typeof autocomplete_users != 'undefined'){

		$('#autocomplete_user').typeahead({
		  hint: true,
		  highlight: true,
		  minLength: 1
		},
		{
		  name: 'user',
		  displayKey: 'value',
		  source: substringMatcher(autocomplete_users)
		});
	}

	if($().maxlength){
		$('#maxlength_input').maxlength({
	        limitReachedClass: "label label-danger",
	        alwaysShow: true
	    });
	}

	if($().datepicker){
		//datepicker
		$('.date-picker').datepicker({
	        autoclose: true,
	        startDate: '-1y'
	   	});
	}

	//categories for blog
   	if(typeof autocomplete_obj != 'undefined'){
   		$(autocomplete_obj).select2({
   			tags: autocomplete_array
	   });
   	}

   	//keywords for blog
   	if(typeof autocomplete_obj_key != 'undefined'){
   		$(autocomplete_obj_key).select2({
   			tags: autocomplete_array_key
	   });
   	}

   	$(document).delegate('.ajax-select', 'change', function(e){

   		e.preventDefault();
		e.stopPropagation();

    	var this_ = $(this);
		var url = this_.data('url');
    	var method = this_.data('method')? this_.data('method'): 'post';
    	var data_type = this_.data('type')? this_.data('type'): 'json';
    	var where_select_obj = '.' + this_.data('where-select');
    	var data_costume = this_.data('costume')? this_.data('costume'): '';

		$(where_select_obj).find('option').remove();

    	if(url!=''){
    		$.ajax({
		   		url: url,
		   		type: method,
				dataType: data_type,
				data: {id: this_.val()},
		   		success: function(data, textStatus, XMLHttpRequest){

		   			$('.selects-box').html('');
					//insert empty option
					$(where_select_obj).append('<option value=""></option>');

					if(data.length > 0){
						data.forEach(function(entry) {
						    $(where_select_obj).append('<option data-selects='+ entry.select_array +' value="'+ entry.id +'">'+ entry.fullname +'</option>');
						});
					}

				},
				error: function(XMLHttpRequest, textStatus, errorThrown){
					//$(document).trigger("error:http", XMLHttpRequest);
				}
			});
	    }

	    return false;
    });

	$(document).delegate('.subcateg', 'change', function(e){
		var this_ = $(this);
		//if data-selects
		$('.selects-box').html('');
		var data_sel_attr = this_.find(':selected').attr('data-selects');
		var offer_id = this_.find(':selected').attr('data-offerid');
		if(data_sel_attr!=''){
			var sel_html = $.post( "/admin/offers/getOferSelectBoxes", { select: data_sel_attr, offer_id: offer_id} );
			sel_html.done(function( con ) {
			   $('.selects-box').html(con);
			});
		}
	})
	//hidden input field when select name is capacity[sel3]
	$(document).delegate('select[name="capacity[sel3]"]', 'change', function(e){

		$('input[name="othersel3').val('');
		$('input[name="othersel3').addClass('dhide');
		if($(this).val() == 'other'){
			$('input[name="othersel3').removeClass('dhide');
		}

	})

	$(document).delegate('.ajax-select-costume', 'change', function(e){

   		e.preventDefault();
		e.stopPropagation();

    	var url = $(this).data('url');
    	var method = $(this).data('method')? $(this).data('method'): 'post';
    	var data_type = $(this).data('type')? $(this).data('type'): 'json';
    	var where_select_obj = '.' + $(this).data('where-select');

		$(where_select_obj).find('option').remove();

    	if(url!=''){
    		$.ajax({
		   		url: url,
		   		type: method,
				dataType: data_type,
				data: {areaID: $('select[name="area"]').val(), cityID: $(this).val()},
		   		success: function(data, textStatus, XMLHttpRequest){
					//insert empty option
					$(where_select_obj).append('<option value=""></option>');
					if(data.length > 0){
						data.forEach(function(entry) {
							$(where_select_obj).append('<option value="'+ entry.id +'">'+ entry.fullname +'</option>');
						});
					}

				},
				error: function(XMLHttpRequest, textStatus, errorThrown){
					//$(document).trigger("error:http", XMLHttpRequest);
					//console.log(textStatus);
				}
			});
	    }

	    return false;
    });

	//dropzone
	if($().dropzone){

		var fileList = new Array;
        var i =0;
        Dropzone.options.myDropzone = {
			paramName: "image",
			maxFilesize: $('.dropzone').data('maxfilessize')? $('.dropzone').data('maxfilessize'): 2,
			maxFiles: $('.dropzone').data('maxfiles')? $('.dropzone').data('maxfiles'): 1000,
			dictDefaultMessage: '',
			init: function() {
	            this.on("addedfile", function(file) {
	                // Create the remove button
	                var removeButton = Dropzone.createElement("<button class='btn btn-sm btn-block'>Изтрий</button>");

	                // Capture the Dropzone instance as closure.
	                var _this = this;

	                // Listen to the click event
	                removeButton.addEventListener("click", function(e) {
	                  // Make sure the button click doesn't submit the form:
	                  e.preventDefault();
	                  e.stopPropagation();

	                  // Remove the file preview.
	                  _this.removeFile(file);
	                  // If you want to the delete the file on the server as well,
	                  // you can do the AJAX request here.
	               });

	                // Add the button to the file preview element.
	                file.previewElement.appendChild(removeButton);
	            });
	            this.on("success", function(file, serverFileName) {
                    fileList[i] = {"serverFileName" : serverFileName, "fileName" : file.name,"fileId" : i };
                    // append input tag for new file for sortable
                    //var fileinput = Dropzone.createElement("<input type='hidden' name='newfile' value='" + serverFileName + "'>");
                    //file.previewElement.appendChild(fileinput);
                    $(file.previewElement).attr('id', 'item-' + serverFileName);

                    i++;

                });
                this.on("removedfile", function(file) {
                    var rmvFile = "";
                    for(f=0;f<fileList.length;f++){

                        if(fileList[f].fileName == file.name)
                        {
                            rmvFile = fileList[f].serverFileName;

                        }

                    }
                    if (rmvFile){
                    	//remove image object
                        removeImage($(file.previewElement).parent('.dz-preview'), rmvFile);
                    }
                });
        	}
	    }
	}

	$("#my-dropzone").sortable({
	    items:'.dz-preview',
	    cursor: 'move',
	    opacity: 0.5,
	    containment: "parent",
	    distance: 20,
	    tolerance: 'pointer',
	   	update: function(e, ui){
	   		var data = $(this).sortable('serialize');
	   		//data += '&pageID=' + $(this).find('input[name="pageID"]').val();
	   		//console.log(data);
	   		//return false;
	        $.ajax({
	            data: data,
	            type: 'POST',
	            url: '/admin/ajax/updateimageposition'
	        });
	    }
	});

	$(".sortablegal").sortable({
	    items:'.filter',
	    cursor: 'move',
	    axis: 'y',
	    opacity: 0.5,
	    containment: "parent",
	    //distance: 20,
	    tolerance: 'pointer',
	   	update: function(e, ui){
	   		var data = $(this).sortable('serialize');
	   		var this_ = $(this);
	   		//data += '&pageID=' + $(this).find('input[name="pageID"]').val();
	   		//console.log(data);
	   		//return false;

	        $.ajax({
	            data: data,
	            dataType: 'html',
	            type: 'POST',
	            url: '/admin/restaurants/sorting/' + $(this_).data('what-table'),
		   		success: function(data, textStatus, XMLHttpRequest){
					window.location.href = data;
				}
	        });
	    }
	});

	$(".sortableslider").sortable({
	    items:'.filter',
	    cursor: 'move',
	    axis: 'y',
	    opacity: 0.5,
	    containment: "parent",
	    //distance: 20,
	    tolerance: 'pointer',
	   	update: function(e, ui){
	   		var data = $(this).sortable('serialize');
	   		var this_ = $(this);
	   		//data += '&pageID=' + $(this).find('input[name="pageID"]').val();
	   		//console.log(data);
	   		//return false;

	        $.ajax({
	            data: data,
	            dataType: 'html',
	            type: 'POST',
	            url: '/admin/sliders/sorting/' + $(this_).data('what-table'),
		   		success: function(data, textStatus, XMLHttpRequest){
					window.location.href = data;
				}
	        });
	    }
	});

	$(".sortablecategory").sortable({
	    items:'.filter',
	    cursor: 'move',
	    axis: 'y',
	    opacity: 0.5,
	    containment: "parent",
	    //distance: 20,
	    tolerance: 'pointer',
	   	update: function(e, ui){
	   		var data = $(this).sortable('serialize');
	   		var this_ = $(this);
	   		//data += '&pageID=' + $(this).find('input[name="pageID"]').val();
	   		//console.log(data);
	   		//return false;

	        $.ajax({
	            data: data,
	            dataType: 'html',
	            type: 'POST',
	            url: '/admin/categories/sorting/' + $(this_).data('what-table'),
		   		success: function(data, textStatus, XMLHttpRequest){
					window.location.href = data;
				}
	        });
	    }
	});

	$(".sortableimg").sortable({
	    items:'.filter',
	    cursor: 'move',
	    axis: 'y',
	    opacity: 0.5,
	    containment: "parent",
	    //distance: 20,
	    tolerance: 'pointer',
	   	update: function(e, ui){
	   		var data = $(this).sortable('serialize');
	   		var this_ = $(this);
	   		//data += '&pageID=' + $(this).find('input[name="pageID"]').val();
	   		//console.log(data);
	   		//return false;

	        $.ajax({
	            data: data,
	            dataType: 'html',
	            type: 'POST',
	            url: '/admin/products/sorting/' + $(this_).data('what-table'),
		   		success: function(data, textStatus, XMLHttpRequest){
					window.location.href = data;
				}
	        });
	    }
	});

	//delete image from dropzone
	$(document).delegate('.remove-img', 'click', function(e){

   		e.preventDefault();
		e.stopPropagation();
		var id = $(this).data('id');
		var url = $(this).data('url');
		var remove_el = $(this).data('remove-el')? $($(this).data('remove-el')): $(this).parent('.dz-preview');
		//remove image object
		removeImage(remove_el, id, url);

	});

	$('.langs[data-lang="bg"]').css('color','red');
    $('.hidden').hide();
    $('.langs').click(function(){
        $('.langs').css('color','');
        var lang = $(this).data('lang');
        $('.forlangs').hide();
        $(this).css('color','red');
        $('.fields_' + lang).show();
        return false;
    });

});

function show_notification_mesage(title, message, what){

	UIToastr.init();

	var what = what? what: 'success';//warning, info, error

	toastr.options = {
		"closeButton": true,
		"debug": false,
		"positionClass": "toast-top-right",
		"onclick": null,
		"showDuration": "1000",
		"hideDuration": "1000",
		"timeOut": "5000",
		"extendedTimeOut": "1000",
		"showEasing": "swing",
		"hideEasing": "linear",
		"showMethod": "fadeIn",
		"hideMethod": "fadeOut"
	}
	if(what){
		toastr[what](message, title);
	}else{
		return false;
	}

	//toastr.clear();

}

function removeImage(obj, image, url){
	$.ajax({
        url: url? url: '/admin/ajax/deleteimage',
        type: 'POST',
        data: { 'file' : image }
    });

    obj.remove();
}
