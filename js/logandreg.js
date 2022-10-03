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
	var userEmail = document.getElementById('reg_user_email').value;
	var userName = document.getElementById('reg_user_name').value;
	var userPassword = document.getElementById('reg_user_pass').value;
	var userConfirmPassword = document.getElementById('reg_user_cpass').value;

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
	} else {errEmail.innerText = "Email is not valid"};

	//Check validation user name
	if (validateName(userName) == null){
		errName.innerText = "User name is not valid";
	} else if (userName.length < 6){errName.innerText = "User name must have 6 characters"};
	
	if (userPassword == null){
		errPassword.innerText = "Enter your password";
	} else if (userPassword.length < 10){
		errPassword.innerText = "Password must have 10 characters";
	}

	//Check validation password and re-password
	if (userConfirmPassword == null){
		errConfirmPassword.innerText = "Enter your re-password";
	} else if (userConfirmPassword.length < 10){
		errConfirmPassword.innerText = "Password must have 10 characters";
	} else if (userConfirmPassword != userPassword){
		errConfirmPassword.innerText = "Password does not match";
	}
}
	
