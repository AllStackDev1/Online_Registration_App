//JS file for REQUESTING QUOTE
$(document).ready(function() {
    $("#admin-login").submit(function(e) {
        e.preventDefault();
        login();
    });
    $("#admin-register").submit(function(e) {
        e.preventDefault();
        register();
    });
});

function login() {
	var email = $("#log_email");
	var emailCheck = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i;
	var testEmail = emailCheck.test(email.val());
	var password = $("#log_password");

	if (email.val() && password.val()) {

		if(!testEmail){
			alert("Invalide email address!");
			flag = false;
			return false;
		}else{
			$.ajax({
		    
			    type: "GET",
			    url: "http://localhost/ikolilu/ikoliluonlineapp/v1.2/api/process_.php/AdminLogIn/",
			    data: "email=" + email.val() + "&password=" + password.val(),
			    
			    success: function (data) {
			    	// var json = JSON.parse(data);
			        if(data.success == true){
			        	document.location.href = "dashboard.html";
			            sessionStorage.setItem('name', data.admin_name);
			            sessionStorage.setItem('email', data.admin_email);
			        }else{
			            alert(data.reason);
			        }
			    }
			    
			});
		}
		return false;
	}else{
		alert("No Email or Password Provide!");
	}
}

function register() {
	var name = $("#reg_name");
	var email = $("#reg_email");
	var emailCheck = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i;
	var testEmail = emailCheck.test(email.val());
	var password = $("#reg_password");

	if (name.val() && email.val() && password.val()) {

		if(!testEmail){
			alert("Invalide email address!");
			flag = false;
			return false;
		}else{
			$.ajax({
		    
			    type: "POST",
			    url: "http://localhost:80/myCompany365Net/olamselfservice/api.php/AdminRegister",
			    data: "email=" + email.val() + "&password=" + password.val(),
			    cache: false,
			    
			    success: function (data) {
			        if(data == 'success'){
			            // documentdocument.location.href = "dashboard.html";
			            // sessionStorage.setItem('name', data[0].name);
			            // sessionStorage.setItem('email', data[0].email);
			        }else{
			            alert('Email or Password Incorrect!');
			        }
			    }
			    
			});
		}
		return false;
	}else{
		alert("No Email or Password Provide!");
	}
}
