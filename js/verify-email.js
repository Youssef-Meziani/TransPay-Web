function verify_email(){
    return new Promise(function() {
        var code = '';
        var email = $('[name=email]').val();
        
        for (let i = 0; i < 6; i++) {
            code += Math.floor(Math.random() * 10);
        }

        $.ajax({
            type: 'POST',
            url: 'assets/send-mail.php',
            data: { email: email, code: code },
            success: function(response) {
                if (response == 'false') {
                    Swal.fire({
                        title: 'Network error!',
                        text: 'There has been an error while sending the email verification code.',
                        icon: 'error',
                        showCloseButton: true,
                        allowOutsideClick: false
                    });
                }
            },
            error: function() {
                Swal.fire({
                    title: 'Network error!',
                    text: 'There has been an error while sending the email verification code.',
                    icon: 'error',
                    showCloseButton: true,
                    allowOutsideClick: false
                });
            }
        });
        
        Swal.fire({
            title: 'Input the code sent to your email',
            input: 'text',
            confirmButtonText: 'Verify',
            showLoaderOnConfirm: true,
            allowOutsideClick: false,
            preConfirm: (input) => {
                if (code != input) {
                    Swal.showValidationMessage('Wrong verification code');
                } else {
                    $('form').unbind('submit').submit();
                }
            }
        });
    });
}