$(".loginForm").submit(function (e) {
    e.preventDefault();

    var login = $(this).find("input[name=login]").val(),
        password = $(this).find("input[name=password]").val();

    $.ajax({
        url: path + '/user/login',
        data: {login: login, password: password},
        type: 'POST',
        success: function(result) {
            $(".notifyField").html(result);
            $("#errorDisplay").fadeIn(300);
            $("#successDisplay").fadeIn(300);

            if (result == "<div id='successDisplay'>Авторизация успешна <br> Вы будете перенаправлены через 3 сек.</div>") {
                window.setTimeout(function() {
                    window.location.href = path + window.location.search.substring(1);
                }, 3000);
            }
        },
        error: function() {
            console.log('unknown server error');
        }
    });
});

$(".reset__form").submit(function (e) {
    var email = $(this).find("input[name=reset]").val();

    e.preventDefault();

    $.ajax({
        url: path + '/user/reset',
        data: {email: email},
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

$(".resetForm").submit(function (e) {
    e.preventDefault();

    var password = $(this).find("input[name=password]").val(),
        password_repeat = $(this).find("input[name=password_repeat]").val();

    $.ajax({
        url: path + '/user/auth',
        data: {password: password, password_repeat: password_repeat},
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

$("#resetPasswordBtn").click(function() {
    $(".login__reset").toggle(200);
})

// user email update

$('#main__userAccountForm').submit(function (e) {
    e.preventDefault();
    
    let mail = $('#main__userAccountForm input').val();
    
    $.ajax({
        url: path + '/user/update',
        data: {mail : mail},
        type: 'POST',
        success: function (result) {
            $('.main__userAccount .username').before(result);
        },
        error: function () {
            console.log("Произошла неизвестная ошибка");
        }
    });
});

// getbalance form 

$('.balanceForm').submit(function (e) {
    e.preventDefault();

    let sum = $('.balanceForm input[type="text"]').val(),
        method = $('.balanceForm select').val();

    $.ajax({
        url: path + '/user/getbalance',
        data: {balance : sum, method : method},
        type: 'POST',
        success: function (result) {
            $('.signupTitle').before(result);
        },
        error: function () {
            console.log("Произошла неизвестная ошибка");
        }
    });
});