// JavaScript Document
$(document).ready(function() {
  $("#registrationform").submit(function(e) {
    e.preventDefault();
    submitForm();
    });
});
   

function submitForm(){ 
  
  var sz_schoolid = $("#schoolid");
  var reg_code = $("#reg_code");
  var user_name = $("#user_name");
  var user_email = $("#user_email");
  var user_emailCheck = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i;
  var testuser_email = user_emailCheck.test(user_email.val());
  var user_pass = $("#user_pass");
  var user_cpass = $("#user_cpass");

  var flag = false;
  //Check
  if (sz_schoolid.val() === "" && reg_code.val() === "" && user_name.val() === "" && user_email.val() === "" && user_pass.val() === "" && user_cpass.val() === "") {
    $('.form-control').css('border','1px solid red');
    $('#emptyformerrormge').fadeIn('slow').delay(5000).fadeOut('slow');
    flag = false;
    return false;
  }
  //Check
  if (sz_schoolid.val() === "") {
        sz_schoolid.addClass("error");
        sz_schoolid.focus();
        sz_schoolid.notify("*Please Choose a School", "error");
        flag = false;
        return false;
  } else {
      sz_schoolid.removeClass("error").addClass("success");
  }
  //Check
  if (reg_code.val() === "") {
        reg_code.addClass("error");
        reg_code.focus();
        reg_code.notify("*code cannot be empty", "error");
        flag = false;
        return false;
  } else {
      reg_code.removeClass("error").addClass("success");
  }
  //Check
  if (user_name.val() === "") {
      user_name.addClass("error");
      user_name.focus();
  	  user_name.notify("*Please enter your full name", "error");
      flag = false;
      return false;
  } else {
        if (user_name.val().length < 6) {
            user_name.addClass("error");
            user_name.focus();
            user_name.notify("*Please enter your full name", "error");
            flag = false;
            return false;
        } else {
            user_name.removeClass("error").addClass("success");
        }
  }
  //Check
  if (user_email.val() === "") {
        user_email.addClass("error");
        user_email.focus();
        user_email.notify("*Provide an email", "error");
        flag = false;
        return false;
  } else {
        if(!testuser_email){
            user_email.focus();
            user_email.notify("*Provide a valid email", "error");
            flag = false;
            return false;
        }else{
          user_email.removeClass("error").addClass("success");
        }
  }
  //Check     
  if (user_pass.val() === "") {
        user_pass.addClass("error");
        user_pass.focus();
        user_pass.notify("*Enter a password", "error");
        flag = false;
        return false;
  } else {
    if (user_pass.val().length < 8 || user_pass.val().length > 15) {
        user_pass.addClass("error");
        user_pass.focus();
        user_pass.notify("*Password must be 8 - 15 characters", "error");
        flag = false;
        return false;
    } else {
      user_pass.removeClass("error").addClass("success");
    }
    
  }
  //Check
  if (user_cpass.val() === "") {
        user_cpass.addClass("error");
        user_cpass.focus();
        user_cpass.notify("*You need to confirm your password", "error");
        flag = false;
        return false;
  } else if (user_pass.val() !== user_cpass.val()) {
        user_pass.removeClass("success");
        user_pass.addClass("error");
        user_cpass.addClass("error");
        user_pass.focus();
        user_cpass.focus();
        user_pass.notify("*Password do not match", "error");
        user_cpass.notify("*Password do not match", "error");
        flag = false;
        return false;
  } else {
      user_cpass.removeClass("error").addClass("success");
  }

    $('#myRegistrationModal').modal('hide');
    $('#modal').css('display','block');
    $('#fade').css('display','block');
    user_email.attr('style', 'border: none;');
    reg_code.attr('style', 'border: none;');
    $('#verify-txt').show(); 
    $('#loader').show();  

    var response = new Array();
    var fd = new FormData();
    fd.append('sz_schoolid', sz_schoolid.val());
    fd.append('reg_code', reg_code.val());
    var URL = '/ikoliluonlineapp/v1.2/api/process_.php/CheckRegCodeValid/';
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
                setTimeout(function(){
                    $('#verify-txt').hide();
                    $('#warning-img').hide();
                    $('#error-txt').hide();
                    $('#loader').show();
                    $('#submit-txt').show();
                }, 1000);
                setTimeout(function(){
                   RegCodeValid();  
                }, 1000);
            }else{
                setTimeout(function(){
                    $('#loader').hide();
                    $('#verify-txt').hide();
                    closeModal();
                    $('#myRegistrationModal').modal('show');
                }, 1000);
                setTimeout(function(){
                  reg_code.removeClass('success');
                  reg_code.focus();
                  reg_code.attr('style', 'border: 2px solid #D8000C;');
                  reg_code.notify("*Registration code is not valid", "error");
                  flag = false;
                  return false;
                }, 2000);
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

    function RegCodeValid() {
        var response = new Array();
        var formData = new FormData();
         formData.append('sz_schoolid', sz_schoolid.val());
         formData.append('reg_code', reg_code.val());
         formData.append('user_name', user_name.val());
         formData.append('user_email', user_email.val());
         formData.append('user_pass', user_pass.val());
        $.ajax({
            type: 'POST',
            url:  '/ikoliluonlineapp/api/process_.php/Registration',
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            success: function (data) {
                response = data;
                if(response.success === true){
                  $('#registrationform')[0].reset();
                    setTimeout(function(){
                        $('#loader').hide();
                        $('#verify-txt').hide();
                        $('#warning-img').hide();
                        $('#error-txt').hide();
                        $('#submit-txt').hide();
                        closeModal();
                        $('#myNotify').modal('show');
                    }, 1000);
                }else{
                  if (response.error_no === '-2') {
                    setTimeout(function(){
                      $('#loader').hide();
                      $('#submit-txt').hide();
                      closeModal();
                       $('#myRegistrationModal').modal('show');
                    }, 1000);
                    setTimeout(function(){
                      user_email.removeClass('success');
                      user_email.focus();
                      user_email.attr('style', 'border: 2px solid #D8000C;');
                      user_email.notify("*"+response.reason, "error");
                      flag = false;
                      return false;
                    }, 2000);
                  } else {
                    setTimeout(function(){
                        $('#loader').hide();
                        $('#submit-txt').hide();
                        $('#warning-img').show();
                        $('#error-txt').show();
                    }, 2000);
                    setTimeout(function(){
                        $('#warning-img').fadeOut('slow');
                        $('#error-txt').fadeOut('slow');
                        closeModal();
                        $('#unexpected').fadeIn('slow').delay(8000).fadeOut('slow');
                        $('#myRegistrationModal').modal('show');
                    }, 4000);
                }
              }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                setTimeout(function(){
                  closeModal();
                  $('#login-img').hide();
                  $('#login-txt').hide();
                  $('#login-error').fadeIn('slow').delay(2000).fadeOut('slow');
                }, 1000); 
            },
            dataType:'json'
        });
    }

    function closeModal() {
        $('#modal').css('display','none');
        $('#fade').css('display','none');
    }
}