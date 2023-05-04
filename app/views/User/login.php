<?php
use playbuff\Registry;
$this->layout = "user";

?>

<div style="width:100%" class="main__product--info">
	<h1 class="news__info--title signupTitle">Авторизация пользователя</h1>
    <div class="notifyField"></div>
    <?php if(isset($_SESSION['errors'])): ?>
        <div style="display:block" id="errorDisplay">
            <span><? echo $_SESSION['errors']; unset($_SESSION['errors']); ?></span>
        </div>
    <?php endif; ?>

    <?php if(isset($_SESSION['success'])): ?>
        <div style="display:block" id="successDisplay">
            <span><? echo $_SESSION['success']; unset($_SESSION['success']); ?></span>
        </div>
    <?php endif; ?>
    <div class="singUp__content">
        <form class="loginForm" method="post" action="/user/login">
            <label for="login">Логин</label>
            <input type="text" name="login" autocomplete="on" placeholder="Ваш логин">
            <label for="password">Пароль</label>
            <input type="password" name="password" autocomplete="on" placeholder="Ваш пароль">
            <input type="submit" style="margin-top: 5px" id="signupBtn" value="Авторизация">
        </form>
        <div class="signUp__question">
            <a href="/user/signup" class="question__content">
                <img src="/img/signup.png" alt="Log in">
                <p>Еще нет аккаунта?</p>
                <span>Регистрация</span>
            </a>
        </div>
    </div>
    <p class="signup__alert">*Все поля обязательны к заполнению</p>
    <p class="signup__alert">*Пароль должен содержать не менее 6 символов</p>
    <button id="resetPasswordBtn">Забыли пароль?</button>
    <div class="login__reset">
        <form class="reset__form" action="/user/reset" method="post">
            <input type="text" name="reset" placeholder="Укажите ваш Email адрес">
            <input type="submit" value="Сбросить">
        </form>
    </div>
</div>
</section>