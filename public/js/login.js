$(document).ready(function() {
    
    
   const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');

    // Function to enforce character limit
    function enforceMaxLength(input, maxLength) {
        if (input.value.length > maxLength) {
            input.value = input.value.substring(0, maxLength); // Truncate the input
            // alert(`Maximum length is ${maxLength} characters.`); // Optional alert
        }
    }

    // Event listeners for email and password
    emailInput.addEventListener('input', function () {
        enforceMaxLength(emailInput, 25);
    });

    passwordInput.addEventListener('input', function () {
        enforceMaxLength(passwordInput, 25);
    });



    $(document).on("keypress","#email",function(event){
         // Define allowed characters (letters, numbers, @, .)
            var allowedChars = /^[a-zA-Z0-9@.]*$/;

            // Get the current input value
            var inputValue = event.target.value;

            // Filter the value to only include allowed characters
            var filteredValue = inputValue.split('').filter(function(char) {
                return allowedChars.test(char);
            }).join('');
            // console.log(filteredValue);
            // Update the input field with the filtered value
            event.target.value = filteredValue;
    })
    

    // Form  validation
    $.validate({
        modules: 'file,sanitize',
        validateOnBlur : false,
        form: '.login_form',
        inputParentClassOnError: 'has-danger',        
        errorMessageClass: 'alert-danger',
        onError : function($form) {
          return false;
        },
        onSuccess: function($form) {
            $('.submit_button').attr('disabled','disabled');
            login();
           
            return false;
        }
    });  
    
    function encryptData(data) {
        // Data to encrypt
        // var data = $("#password").val();

        // Define key (must be 16 bytes for AES-128)
        var key = CryptoJS.enc.Utf8.parse('adUvN85GyRzlWvBx');

        // Define IV (Initialization Vector), must be 16 bytes
        var iv = CryptoJS.enc.Utf8.parse('1234567890abcdef');

        // Encrypt the data using AES-128-CBC
        var encrypted = CryptoJS.AES.encrypt(data, key, {
            iv: iv,
            mode: CryptoJS.mode.CBC,
            padding: CryptoJS.pad.Pkcs7
        });

        // Convert encrypted data to Base64 format
        var encryptedData = encrypted.toString();

        console.log("Encrypted Data: " + encryptedData);

        // Send encryptedData to the server for decryption in PHP
        return encryptedData;
    }
    
    
    function sanitizeInput(input) {
        // Create a dummy div element to use browser's native escaping
        var tempDiv = document.createElement('div');
        tempDiv.textContent = input;
        return tempDiv.innerHTML;
    }
//    function isValidUsername(username) {
//     // Username pattern: TNIOM followed by a number between 5000 and 5999
//     var usernameRegex = /^TNIOM5[0-9]{3}$/;
//     return usernameRegex.test(username);
// }

function isValidEmail(email) {
    // Simple email format validation
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

   
     // submit form
    function login() { 
    var email = $('#email').val(); 
    var password = $('#password').val();
    
   
    
    // Sanitize email and password inputs
        email = sanitizeInput(email);
        password = sanitizeInput(password);
        // console.log(password);
        // Encrypt the data
        var encryptedData = encryptData(password);  
        // Log the encrypted data
        console.log("Encrypted Data:", encryptedData); 
        // if (isValidEmail(email) || isValidUsername(email)) {
        // if (isValidEmail(email)) {
          
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });      
        var data_ref = {
            email:email,
            password:encryptedData,
        };
        console.log(data_ref);

         var values = $('.login_form').serializeArray();
         $.ajax({
                url: "api/spa/login",
                type: "post",
                data: data_ref ,
                success: function (response) {
                    // $(".submit_button").removeClass("active");
                    window.location.href= 'dashboard';
                },
                error: function(response) {
                    // if (response.responseJSON && response.responseJSON.errors) {
                        printErrorMsg(response.responseJSON.errors); // Call your function if errors exist
                    // } else {
                    //     console.error("Error response:", response); // Log the entire response for debugging
                    //     // alert("An unexpected error occurred. Please try again."); // Show a generic error message to the user
                    // }

                }


        });
        // }
        // else{
        //     //   alert("Invalid email address.");
        //      $(".print-error-msg").find("ul").html('');
        //      $(".print-error-msg").css('display','block');
        //      $(".print-error-msg").find("ul").append('<li>Invalid Username or Email Address</li>');
        //      $('.submit_button').removeAttr('disabled');
        //      $(".submit_button").removeClass("active");
        //     return false; // Stop form submission if invalid
        
        // }
    }

    function printErrorMsg (msg) {
        console.log(msg);
        $(".print-error-msg").find("ul").html('');
        $(".print-error-msg").css('display','block');
        $.each( msg, function( key, value ) {
            $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
            $('.submit_button').removeAttr('disabled');
        });
        $(".submit_button").removeClass("active");
    }


});
