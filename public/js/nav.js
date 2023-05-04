function showCategories() {
    var x = document.getElementById("main__navbar--mobile");
    if (x.style.display === "block") {
      x.style.display = "none";
    } else {
      x.style.display = "block";
    }
  }

function hamburger_nav(e) {
    var nav = document.getElementById("header__nav--mobile_version");
    
    if (e == 1) {
        nav.style.display = "flex";
    } else {
        nav.style.display = "none";
    }
}

$("body").on("click", "#main__userAccount--editBtn", function() {
  $(".userFormWrap").slideToggle(300);
});

$("#getPromocode").submit(function (e) {
  e.preventDefault();

  let promocode = $("#getPromocode input").val();

  $.ajax({
    url: path + '/cart/promocode',
    data: {promocode : promocode},
    type: 'POST',
    success: function(result) {
        if (result == "Успешно") {
          $("#getPromocode").slideUp(300);
          $(".notifyField").html("<div id='successDisplay'>Промокод успешно применен <br> через 3 сек. сумма будет перерасчитана</div>");
          $("#successDisplay").fadeIn(300);
          
          window.setTimeout(function () {
            window.location.href = location.href;
          }, 3000);
        } else {
          $(".notifyField").html("<div id='errorDisplay'>Промокод не найден</div>");
          $("#errorDisplay").fadeIn(300);
        }
    },
    error: function() {
        alert('Ошибка');
    }
});
});

$('body').on('click', '.success, .error', function(e) {
  $(e.currentTarget).slideUp(300);
});