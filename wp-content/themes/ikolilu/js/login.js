// JavaScript Document
$(document).ready(function() {
    $("#btn-login").click(function(e) {
    	e.preventDefault();
        login();
    });
});

function login(){ 

  var email = $("#login_email");
  var emailCheck = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i;
  var testEmail = emailCheck.test(email.val());
  var pass = $("#login_password");

  var flag = false;

  //Check
  if (email.val() === "" && pass.val() === "") {
        email.addClass("error");
        pass.addClass("error");
        email.focus();
        $('#emtpyloginerrormge').fadeIn('slow').delay(3000).fadeOut('slow');
        flag = false;
        return false;
  }
  //Check
  if (email.val() === "") {
        email.addClass("error");
        email.notify("*Enter your email", "error");
        email.focus();
        flag = false;
        return false;
  } else {
        if(!testEmail){
            email.addClass("error");
            email.focus();
            email.notify("*Provide a valid email", "error");
            flag = false;
            return false;
        }else{
          email.removeClass("error").addClass("success");
        }
  }
  //Check     
  if (pass.val() === "") {
        pass.addClass("error");
        pass.notify("*Enter your password", "error");
        pass.focus();
        flag = false;
        return false;
  } else {
    pass.removeClass("error").addClass("success");
  }
    $('#myLoginModal').modal().fadeOut('fast');
    $('#modal').css('display','block');
    $('#fade').css('display','block');
    $('#login-txt').fadeIn('slow');
    $('#login-img').fadeIn('slow');

    var response = new Array();
    var fd = new FormData();
    fd.append('user_email', email.val());
    fd.append('user_pass', pass.val());
    var URL = '/ikolilu/ikoliluonlineapp/v1.2/api/process_.php/Login/';
    var RES = $.ajax({ 
        type: 'POST',
        url: URL, 
        data: fd, 
        processData: false,
        contentType: false,
        cache: false, 
        success: function (data) {
            response = data;
            if(response.success === true){
            	$(function() {
            			$('#login-txt').fadeOut(2000, function() {
                			$('#app-txt').fadeIn(1000);
                            document.location.href = "http://localhost/ikolilu/ikoliluonlineapp/v1.2/main/";
                        });
                    }
                );
            }else{
            	if (response.error === '-1') {
	                setTimeout(function(){
      	            	closeModal();
      		            $('#login-img').fadeOut('slow');
      		            $('#login-txt').fadeOut('slow');
      	            	pass.addClass("error");
      				        pass.notify(response.reason, "error");
      				        pass.focus();
      				    }, 1000);
              }else if(response.error === '-2') {
                setTimeout(function(){
                  closeModal();
                  $('#login-img').fadeOut('slow');
                  $('#login-txt').fadeOut('slow');
                  email.addClass("error");
                  email.notify(response.reason, "error");
                  email.focus();
                }, 1000);
              }
            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            setTimeout(function(){
              closeModal();
              $('#login-img').hide();
              $('#login-txt').hide();
              $('#login-error').fadeIn('slow').html('*Unexpexted Error while Loggin in. Please try again.').delay(5000).fadeOut('slow');
            }, 1000); 
        },
        dataType:'json'
    });

    function closeModal() {
        $('#modal').css('display','none');
        $('#fade').css('display','none');
    }    
}