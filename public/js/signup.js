$(".signupForm").submit(function (e) {
    e.preventDefault();
    
    var login = $(this).find("input[name=login]").val(),
        email = $(this).find("input[name=email]").val(),
        password = $(this).find("input[name=password]").val();

    $.ajax({
        url: path + '/user/signup',
        data: {login: login, email: email, password: password},
        type: 'POST',
        success: function (result) {
            $(".notifyField").html(result);
            $("#errorDisplay").fadeIn(300);
            $("#successDisplay").fadeIn(300);
        },
        error: function () {
            console.log('unknown server error');
        }
    });
});


$("body").on("click", "#errorDisplay", () => {
    $(this).slideUp(300);
});

$("body").on("click", "#successDisplay", () => {
    $(this).slideUp(300);
});