// JavaScript Document
$(document).ready(function() {
var URL = 'http://localhost/ikolilu/ikoliluonlineapp/v1.2/api/process_.php/SchoolWithOpenApplication/';
var RES = $.ajax({ 
	        type: 'GET',
	        url: URL,
	        success: function (data) {
	           for (var key in data) {
        			if (data.hasOwnProperty(key)) { 
        				$('#schoolid').append($('<option></option>').attr('value', data[key]['sz_schoolid']).text(data[key]['sz_schoolname']));
        			}
				}
	        },
	        error: function(XMLHttpRequest, textStatus, errorThrown) {
	            console.log(XMLHttpRequest);
	        },
	        dataType:'json'
	    });
});