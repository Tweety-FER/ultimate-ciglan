{
	window.onload = function() {
		$('#loginbtn').on('click', function() {
			validate(ajaxLogin);
		});

		$('#registerbtn').on('click', function() {
			validate(ajaxRegister);
		});
	}

	function validate(handler) {
		$('#error').html('');
		$('#form').validate({
		rules : {
			username: {
				minlength: 2,
				maxlength: 32
			},
			password: {
				minlength: 4
			}
		},

		messages : {
			username: {
				minlength: "Please enter at least 2 characters.",
				maxlength: "Maximum number of characters exceeded."
			},
			password: {
				minlength: "Please enter stronger password."
			}
		},

		submitHandler: handler
		});
	}

	function doAjax(path, f) {
		var username = $('#username').val();
		var password = $('#password').val();
		$.ajax({
			url: path,
			type: 'POST',
			data: {'username' : username, 'password' : password},
			dataType : 'json'
		}).done(function (msg) {
			if (msg.success) {
				f();
				window.location = "/levels.php";
			} else {
				if(msg.redirect) {
					window.location = "/levels.php";
				} else {
					$('#error').html(msg.description);
				}
			}
		});
	}

	function ajaxLogin() {
		doAjax('/login.php', function(){});
	}

	function ajaxRegister() {
		doAjax('/register.php', function() {alert('Registration successful')});
	}
}