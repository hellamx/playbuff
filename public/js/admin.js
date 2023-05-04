$('body').on('click', '.alert', (e) => {
    $(e.currentTarget).fadeOut(300);
});

$('#adminSettingsForm').submit(function (e) {
    e.preventDefault();

    let status = $('#adminSettingsForm select[name=status]').val(),
        time_cache = $('#adminSettingsForm input[name=time_cache]').val(),
        time_currency_cache = $('#adminSettingsForm input[name=time_currency_cache]').val(),
        api_key = $('#adminSettingsForm input[name=api_key]').val(),
        common = $('#adminSettingsForm input[name=common]').val(),
        rare = $('#adminSettingsForm input[name=rare]').val(),
        legend = $('#adminSettingsForm input[name=legend]').val(),
        games_perpage = $('#adminSettingsForm select[name=games_perpage]').val(),
        news_perpage = $('#adminSettingsForm select[name=news_perpage]').val();


    $.ajax({
        url: path + '/admin/settings/save',
        data: {
            status : status, 
            time_cache : time_cache,
            time_cache_currency : time_currency_cache,
            api_key : api_key,
            common : common,
            rare : rare,
            legend : legend,
            games_perpage : games_perpage,
            news_perpage : news_perpage,
            submit : true
        },
        type: 'POST',
        success: function (result) {
            $('.settings__title').parent().parent().parent().before(result);
        },
        error: function () {
            console.log("Произошла неизвестная ошибка");
        }
    });
});

$('#adminUserForm').submit(function (e) {
    e.preventDefault();

    let ban = $('#adminUserForm select[name=ban]').val(),
        login = $('#adminUserForm input[name=login]').val(),
        id = $('#adminUserForm input[name=id]').val(),
        email = $('#adminUserForm input[name=email]').val(),
        balance = $('#adminUserForm input[name=balance]').val(),
        role = $('#adminUserForm select[name=role]').val();


    $.ajax({
        url: path + '/admin/user/save',
        data: {
            id : id,
            ban : ban,
            login : login,
            email : email,
            balance : balance,
            role : role,
            submit : true
        },
        type: 'POST',
        success: function (result) {
            $('.settings__title').parent().parent().parent().before(result);
        },
        error: function () {
            console.log("Произошла неизвестная ошибка");
        }
    });
});

$('#adminCategoryForm').submit(function (e) {
    e.preventDefault();

    let id = $('#adminCategoryForm input[name=id]').val(),
        title = $('#adminCategoryForm input[name=title]').val(),
        keywords = $('#adminCategoryForm input[name=keywords]').val(),
        description = $('#adminCategoryForm input[name=description]').val(),
        alias = $('#adminCategoryForm input[name=alias]').val();

    $.ajax({
        url: path + '/admin/category/save',
        data: {
            id : id,
            title : title,
            keywords : keywords,
            description : description,
            alias : alias,
            submit : true
        },
        type: 'POST',
        success: function (result) {
            $('.settings__title').parent().parent().parent().before(result);
        },
        error: function () {
            console.log("Произошла неизвестная ошибка");
        }
    });
});