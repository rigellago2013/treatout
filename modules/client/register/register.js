var verified = false

$(document).on('submit', '#register', function(event) {

    event.preventDefault();
    const password = document.getElementById('password').value
	const confirmPassword = document.getElementById('confirmPassword').value
	
	if (!verified) {

		alert('Please Verify you are not a bot')
		return

	}

	console.log( password, confirmPassword)

    if ( password !== confirmPassword ) {

        alert('Passwords does not match')
        return
    }
    
	$.ajax({
		url: '/modules/client/register/register.php',
		method: 'POST',
		data: new FormData(this),
		contentType: false,
		processData: false,
		dataType: 'JSON',
		success: data =>  {
			if (data.response) {
				alert(data.response)
				var link = 'index.php'
				window.location.href = link
			}else{
                alert(data)
            }
		},
	})
})


  $('#confirmPassword').on('keyup click change', function(){

  	var password = $('#password').val();
    var confirm = $('#confirmPassword').val();


    if(password != confirm) {

        $('#verify').html('<br>*Passwords doesnt match please try again. <br>')
        $(':input[type="submit"]').prop('disabled', true);

    } else {

    	 $('#verify').html('<br>*Passwords match please continue. <br>')	
    	 $(':input[type="submit"]').prop('disabled', false);

    }
  
  });


function captchaCallback(){
	verified = true
	console.log('You are Verified')
}
