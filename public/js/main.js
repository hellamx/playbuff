$('body').on('click', '.add-to-cart', function (e) {
    e.preventDefault();
    var id = $(this).data('id'),
        qty = $('.quantity input').val() ? $('.quantity input').val() : 1;
        platform = $('.platformSelect select').val();

        $.ajax({
            url: path + '/cart/add',
            data: {id: id, qty: qty, platform: platform},
            type: 'GET',
            success: function (result) {
                if(window.innerWidth >= 1080) {
                    showCart(result);
                } else {
                    showCart(result);
                    window.location.replace(path + "/cart");
                }
            },
            error: function () {
                alert('Ошибка');
            }
        });
});

$("body").on("click", "#btnDeleteFromCart", function(e) {
    e.preventDefault();

    var id = $(this).data("id"),
        platform = $(this).data("platform");

    $.ajax({
        url: path + '/cart/delete',
        data: {id: id, platform: platform},
        type: 'GET',
        success: function (result) {
            
            var uri = window.location.pathname;
            
            if (uri != "/cart") {
                showCart(result);
            }
        
        },
        error: function() {
            alert('Ошибка');
        }
    });

});

$("body").on("click", ".btnDeleteFromCartPage", function (event) {

    $(event.currentTarget).closest('.main__cart-wrapper').remove();
    let count = $(".main__cart-wrapper");

    if (count.length < 1) {
        $("#getPromocode").remove();
        $(".offerData").remove();
        $("#btnGetOrder").remove();
        $("#payMethodForm").remove();
        $(".signup__alert").remove();
        $(".main__cart--title").after('<h3>Корзина пуста</h3>');
    }
});

$("#cartModal").on("click", "#btnCartClean", function () {
    $.ajax({
        url: path + '/cart/wipe',
        type: 'GET',
        success: function(result) {
            showCart(result);
        },
        error: function() {
            alert('Ошибка');
        }
    });
});

$("#cartModal").on("click", "#btnCartHide", () => {
    $(".modalCart--wrapper").hide(200);
    $("#cartModal").html('<a href="/cart/show" onclick="displayCart(); return false;" id="btnShowCartModal"><span>Корзина товаров</span><img src="/icons/cart.svg" alt="Корзина товаров"></a>');
});

$("#cartModal").on("click", "#modal--error", () => {
    $(".modal--error").hide(200);
    $("#cartModal").html('<a href="/cart/show" onclick="displayCart(); return false;" id="btnShowCartModal"><span>Корзина товаров</span><img src="/icons/cart.svg" alt="Корзина товаров"></a>');
});

function showCart(cart) {
    $("#cartModal").html(cart);

    var current = $("#cartModal .cart-qty").text();
    if(current) {
        $("#cartCounter").html("(" + current + ")");
    }
}

function displayCart() {
    $.ajax({
        url: path + '/cart/show',
        type: 'GET',
        success: function(result) {
            showCart(result);
        },
        error: function() {
            alert('Ошибка');
        }
    });
}

// search

var products = new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.whitespace,
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    remote: {
        wildcard: "%QUERY",
        url: path + "/search/results?query=%QUERY"
    }
});

products.initialize();

$("#typeahead").typeahead({
    highlight: true
}, {
    name: "products",
    display: "title",
    limit: 5,
    source: products
});

$("#typeahead").bind("typeahead:select", function(ev, suggestion) {
    window.location = path + "/search/?s=" + encodeURIComponent(suggestion.title);
});

// filters

$("body").on("change", ".filters", function(e) {
    let filter = $("select[name=priceSort]").val(),
        category = $("select[name=category]").val(),
        price = $("input[name=price]").val();
    
    var dataString = filter + "&category=" + category + "&price=" + price;

    $.ajax({
        url: location.href,
        data: { filter: filter, category: category, price: price },
        type: 'GET',
        beforeSend: function() {
            $('.preloader').fadeIn(300, () => {
                $('.main__games--wrapper, .main__games--pagination').hide();
            });
        },
        success: function(result) {
            $(".preloader").fadeOut('slow', () => {
                $('.main__games--wrapper').html(result).fadeIn();

                let newUrl = location.pathname + (location.search ? "?" : "?") + "filter=" + dataString;
                newUrl = newUrl.replace("?&", "?");
                console.log(newUrl);
                history.pushState({}, '', newUrl);
            });
        },
        error: function() {
            console.log("Произошла неизвестная ошибка");
        }
    });
})