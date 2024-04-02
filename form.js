
// $(document).ready(function() {
//     $('.email_id').keyup(function(e) {
//      var email = $('.email_id').val();
//       console.log(email)
//      $.ajax({
//         type : "POST",
//         url: "form.php",
//         data: {
//             'check_Emailbtn': 1,
//             "email": email,
//         },
//         success: function (response) {
//             console.log(response)
//            $('.email_error').text(response)
//         }
//      });
// });


//   } )


$(document).ready(function() {
    var emailExists = false;
    var typingTimer;
    var doneTypingInterval = 500;  // Time in milliseconds

    $('.email_id').keyup(function() {
        clearTimeout(typingTimer);
        var email = $(this).val();
        typingTimer = setTimeout(function() {
            checkEmailExists(email);
        }, doneTypingInterval);
    });

    function checkEmailExists(email) {
        $.ajax({
            type: "POST",
            url: "form.php",
            data: {
                'check_Emailbtn': 1,
                "email": email,
            },
            success: function(response) {
                $('.email_error').text(response)
                if (response.trim() === "email is already exists") {
                    emailExists = true;
                } else {
                    emailExists = false;
                }
            }
        });
    }

    $('form').submit(function(e) {
        if (emailExists) {
            e.preventDefault();
            
        }
    });
});


  




 


  