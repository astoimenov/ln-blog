$(function() {
    $('.sub-nav-select select').change(function(){
    	var url = $(this).find('option:selected').data('url');
    	if(url!=0){
        	location.href = url;
        }
        
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
	if($(".fancybox").length){
		$(".fancybox").fancybox({
	        openEffect  : 'none',
	        closeEffect : 'none',
	        padding     : 5
	    });
	}

	$(".panel-heading").click(function() {
		$(".panel-heading").parent().removeClass("selected");       
		$(this).parent().addClass("selected");
    });


    $(document).delegate('.ajax-action', 'click', function(e){
    	e.preventDefault();
     	var id = $(this).data('id');
     	var confirm_text = $(this).data('confirm');
    	var url = $(this).attr('href');
    	var _this = $(this);
    	
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
				   			console.log(data.result);
				   			if(data.result){
					   			if(delete_closest){
						   			_this.closest(delete_closest).hide('slow');
						   		}else{
						   			_this.hide('slow');
						   		}
						   	}
						},
						error: function(XMLHttpRequest, textStatus, errorThrown){
							//alert("error:http", XMLHttpRequest);
						}
					});
				}
			}else{
				 $.ajax({
			   		url: url,
			   		type: "POST",
					dataType: ajax_type,
					data: {id: $(this).data('id')},
			   		success: function(data, textStatus, XMLHttpRequest){
			   			if(data.result){
					   		if(delete_closest){
					   			_this.closest(delete_closest).hide('slow');
					   		}else{
					   			_this.hide('slow');
					   		}
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
});

var _map = null;
var _tooltip = null;
function onReady() {
	
	var image = '/assets/img/pin.png';
	var mapOptions = {
	  zoom: 17,
	  center: new google.maps.LatLng(42.66610391658813, 23.29584814673488), 
	  mapTypeId: google.maps.MapTypeId.ROADMAP          
	}
	var _map = new google.maps.Map(document.getElementById('googlemap'), mapOptions);
	var myPos = new google.maps.LatLng(42.66610391658813, 23.29584814673488); 
	//var myMarker = new google.maps.Marker({position: myPos, map: _map, icon: image });
	var myMarker = new google.maps.Marker({position: myPos, map: _map });

	//disable zoom out
	google.maps.event.addListener(_map, 'zoom_changed', function() {
	    if (_map.getZoom() < 17) _map.setZoom(17);
	});
	
}

//show gmap
if (typeof google === 'object' && typeof google.maps === 'object') {
	$(window).ready(onReady);
}		