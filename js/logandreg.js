/* CSS EFFECTS */

// LOGIN TABS
$(function() {
	var tab = $('.tabs h3 a');
	tab.on('click', function(event) {
		event.preventDefault();
		tab.removeClass('active');
		$(this).addClass('active');
		tab_content = $(this).attr('href');
		$('div[id$="tab-content"]').removeClass('active');
		$(tab_content).addClass('active');
	});
});

// SLIDESHOW
$(function() {
	$('#slideshow > div:gt(0)').hide();
	setInterval(function() {
		$('#slideshow > div:first')
		.fadeOut(1000)
		.next()
		.fadeIn(1000)
		.end()
		.appendTo('#slideshow');
	}, 3850);
});

// CUSTOM JQUERY FUNCTION FOR SWAPPING CLASSES
(function($) {
	'use strict';
	$.fn.swapClass = function(remove, add) {
		this.removeClass(remove).addClass(add);
		return this;
	};
}(jQuery));

// SHOW/HIDE PANEL ROUTINE (needs better methods)
// I'll optimize when time permits.
$(function() {
	$('.agree,.forgot, #toggle-terms, .log-in, .sign-up').on('click', function(event) {
		event.preventDefault();
		var terms = $('.terms'),
        recovery = $('.recovery'),
        close = $('#toggle-terms'),
        arrow = $('.tabs-content .fa');
		if ($(this).hasClass('agree') || $(this).hasClass('log-in') || ($(this).is('#toggle-terms')) && terms.hasClass('open')) {
			if (terms.hasClass('open')) {
				terms.swapClass('open', 'closed');
				close.swapClass('open', 'closed');
				arrow.swapClass('active', 'inactive');
			} else {
				if ($(this).hasClass('log-in')) {
					return;
				}
				terms.swapClass('closed', 'open').scrollTop(0);
				close.swapClass('closed', 'open');
				arrow.swapClass('inactive', 'active');
			}
		}
		else if ($(this).hasClass('forgot') || $(this).hasClass('sign-up') || $(this).is('#toggle-terms')) {
			if (recovery.hasClass('open')) {
				recovery.swapClass('open', 'closed');
				close.swapClass('open', 'closed');
				arrow.swapClass('active', 'inactive');
			} else {
				if ($(this).hasClass('sign-up')) {
					return;
				}
				recovery.swapClass('closed', 'open');
				close.swapClass('closed', 'open');
				arrow.swapClass('inactive', 'active');
			}
		}
	});
});

// DISPLAY MSSG
$(function() {
	$('.recovery .button').on('click', function(event) {
		event.preventDefault();
		$('.recovery .mssg').addClass('animate');
		setTimeout(function() {
			$('.recovery').swapClass('open', 'closed');
			$('#toggle-terms').swapClass('open', 'closed');
			$('.tabs-content .fa').swapClass('active', 'inactive');
			$('.recovery .mssg').removeClass('animate');
		}, 2500);
	});
});

// DISABLE SUBMIT FOR DEMO
$(function() {
	$('.button').on('click', function(event) {
		$(this).stop();
		event.preventDefault();
		return false;
	});
});

/* END CSS EFFECTS */






/* FORM CHECK */
function btSignUp(){
	checkErr = true;

	var userEmail = document.getElementById('signup-form')['user_email'].value;
	var userName = document.getElementById('signup-form')['user_name'].value;
	var userPassword = document.getElementById('signup-form')['password'].value;
	var userConfirmPassword = document.getElementById('signup-form')['confirmpassword'].value;

	var errEmail = document.getElementById('reg_err_email');
	var errName = document.getElementById('reg_err_name');
	var errPassword = document.getElementById('reg_err_pass');
	var errConfirmPassword = document.getElementById('reg_err_cpass');

	errEmail.innerText = "";
	errName.innerText = "";
	errPassword.innerText = "";
	errConfirmPassword.innerText = "";



	//Validation user email
	const validateEmail = (userEmail) => {
		return userEmail.match(
		  /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
		);
	};
	//Validation user name
	const validateName = (userName) => {
		return userName.match(
			/^[a-zA-Z\-]+$/
		);
	};
	  


	//Check validation email
	if (validateEmail(userEmail) != null){
		errEmail.innerText = "";
	} else {errEmail.innerText = "Email is not valid"; checkErr = false};

	//Check validation user name
	if (validateName(userName) == null){
		errName.innerText = "User name is not valid";
		checkErr = false
	} else if (userName.length < 6){errName.innerText = "User name must have 6 characters"; checkErr = false};
	
	if (userPassword == null){
		errPassword.innerText = "Enter your password";
		checkErr = false
	} else if (userPassword.length < 10){
		errPassword.innerText = "Password must have 10 characters";
		checkErr = false
	}

	//Check validation password and re-password
	if (userConfirmPassword == null){
		errConfirmPassword.innerText = "Enter your re-password";
		checkErr = false
	} else if (userConfirmPassword.length < 10){
		errConfirmPassword.innerText = "Password must have 10 characters";
		checkErr = false
	} else if (userConfirmPassword != userPassword){
		errConfirmPassword.innerText = "Password does not match";
		checkErr = false
	}

	if (checkErr == true){
		document.getElementById("regSubmit").setAttribute("type", "submit");
	}
}
	

function btLogin(){
	checkErr = true;

	var userEmail = document.getElementById('login-form')['user_email'].value;
	var userPassword = document.getElementById('login-form')['password'].value;
	var rememberMe = document.getElementById('remember_me');

	var errEmail = document.getElementById('log_err_email');
	var errPassword = document.getElementById('log_err_pass');

	errEmail.innerText = "";
	errPassword.innerText = "";


	//Validation user email
	const validateEmail = (userEmail) => {
		return userEmail.match(
		  /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
		);
	};	



	//Check validation email
	if (validateEmail(userEmail) == null){
		errEmail.innerText = "Email is not valid";
		checkErr = false;
	}

	if (userPassword == null || userPassword == ""){
		errPassword.innerText = "Enter your password";
		checkErr = false;
	};

	if(checkErr == true){
		document.getElementById("logSubmit").setAttribute("type", "submit");
	};


	/*
	//Remember me with JQuery
	$('.login-form').on('submit', function() {
		if ($('#remember_me').is(':checked')) {
            // save username and password
            localStorage.userEmail = $('#user_email').val();
            localStorage.password = $('#password').val();
            localStorage.checkBoxValidation = $('#remember_me').val();
        } else {
            localStorage.userEmail = '';
            localStorage.password = '';
            localStorage.checkBoxValidation = '';
        }
	});
	*/

	//Remember me with Javascript
	var formSubmitted = document.getElementById("login-form").addEventListener("submit", setLocalstorage());
	function setLocalstorage(){
		var userEmail = document.getElementById('user_email').value;
		var userPassword = document.getElementById('password').value;
		var rememberMe = document.getElementById('remember_me');
	
			if (localStorage.checkBoxValidation != null && localStorage.userEmail != null && rememberMe.checked == true){
				localStorage.userEmail = userEmail;
				localStorage.password = userPassword;
				localStorage.checkBoxValidation = 'on';
			} else {
				localStorage.userEmail = '';
				localStorage.password = '';
				localStorage.checkBoxValidation = '';
			}
	}
}

function getLocalstorage(){
	//remember me
	if(localStorage.userEmail != null && localStorage.checkBoxValidation == "on"){
		document.getElementById('user_email').value = localStorage.userEmail;
		document.getElementById('password').value = localStorage.password;
		document.getElementById('remember_me').checked = true;
	} else {
		document.getElementById('user_email').value = '';
		document.getElementById('password').value = '';
		document.getElementById('remember_me').checked = false;
	}
}



