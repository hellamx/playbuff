<?php
use playbuff\Registry;
$this->layout = "user";

?>

<div style="width:100%" class="main__product--info">
	<h1 class="news__info--title signupTitle">Регистрация нового аккаунта</h1>
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
        <form class="signupForm" method="post" action="/user/signup">
            <label for="email">Email</label>
            <input type="text" name="email" autocomplete="on" placeholder="Email адрес">
            <label for="login">Логин</label>
            <input type="text" name="login" autocomplete="on" placeholder="Логин пользователя">
            <label for="password">Пароль</label>
            <input type="password" name="password" autocomplete="on" placeholder="Придумайте пароль">
            <input type="submit" id="signupBtn" value="Регистрация">
        </form>
        <div class="signUp__question">
            <a href="/user/login" class="question__content">
                <img src="/img/login.png" alt="Log in">
                <p>Уже есть аккаунт?</p>
                <span>Войти</span>
            </a>
        </div>
    </div>
    <p class="signup__alert">*Все поля обязательны к заполнению</p>
    <p class="signup__alert">*Email и Логин должны быть уникальными</p>
    <p class="signup__alert">*Логин должен содержать не менее 4 символов символов</p>
    <p class="signup__alert">*Пароль должен содержать не менее 6 символов</p>
    
</div>
</section>