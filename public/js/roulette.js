$('body').on('change', '#selectBox', (e) => {
    let box = $('#selectBox').val();
    
    $.ajax({
        url: path + '/roulette/getprice',
        data: {box : box},
        type: 'POST',
        dataType: 'text',
        success: (price) => {
            $('.roulette--nav p').text('Стоимость: ' + price + ' руб.');
        },
        error: () => {
            console.log("Произошла неизвестная ошибка");
        }
    });
});


$('body').on('click', '#runRoulette', (e) => {
    
    let box = $('#selectBox').val();

    $.ajax({
        url: path + '/roulette/play',
        data: {box : box},
        type: 'POST',
        dataType: 'json',
        beforeSend: () => {
            $('.Rpreloader').fadeIn(1100, () => {
                $('.Rpreloader').fadeOut(1100);
            });
        },
        success: (data) => {
            if (data.response === true) {
                $('#rouletteForm').slideUp(1100);

                $('.Rloader').delay(1100).animate({
                    opacity: 0,
                    zIndex: -100
                }, 500, () => {
                    $('.Rloader-lock, .roulette--nav').fadeOut(300);
                    $('.blind').fadeIn(300);
                    for (let i = 0; i < 6; i++) {
                        $('#r-item-' + i).replaceWith('<div class="item item-changed fade" data-id=' + data.games[i]['id'] +' id="r-item-' + i + '"> \
                        <img src="/src/' + data.games[i]['main_image'] + '"> \
                        <div class="roulette-gameInfo"><p>' + data.games[i]['title'] + '</p>\
                        <span>' + data.games[i]['price'] + ' руб.</span></div>\
                        </div>');
                        ;
                    };
                    
                    var counter = 0;
                    var startTimer = 0;
                    var timer = 50;

                    setTimeout(play, 300);

                    function play() {
                        if (counter == 6) {
                            $('#r-item-5').removeClass('active');
                            counter = 0;
                        }

                        if ($('#r-item-' + (counter - 1)).hasClass('active')) {
                            $('#r-item-' + (counter - 1)).removeClass('active');
                        }

                        $('#r-item-' + counter).addClass('active');

                        let game = $('#r-item-' + counter).attr('data-id');

                        counter++;
                        timer += 15;

                        console.log(data.winner);

                        if(timer >= 400 && data.winner == game) {
                            let currentBalance = $('#user--balance').text();
                            $('#user--balance').text(currentBalance - data.price);
                            $('.roulette_wrapper').before('<span class="alert success fade">Поздравляем, выпавшая игра: <b>' + data.winnerTitle + '\
                            </b><br>Ключ был отправлен на почту</span>');
                            $('.roulette_wrapper').after('<a id="playReload" href="/roulette">Игра снова</a>').fadeIn(300);
                            $('.blind').fadeOut(300);
                            return stopper;
                        }
                        
                        var stopper = setTimeout(play, startTimer + timer);
                    }

                    
                });

                

            } else {
                $('#rouletteForm').before('<span class="alert error fade">Недостаточный баланс</span>');
            }
        },
        error: () => {
            console.log("Произошла неизвестная ошибка");
        }
    });

});
