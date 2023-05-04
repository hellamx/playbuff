<?php
use playbuff\Registry;
$this->layout = "user";

?>

<div style="width:100%" class="main__product--info">
	<h1 class="news__info--title signupTitle">Изменение пароля</h1>
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
        <form class="resetForm" method="post" action="/user/auth">
            <label for="password">Новый пароль</label>
            <input type="password" name="password" autocomplete="on" placeholder="Новый пароль">
            <label for="password-repeat">Повторите пароль</label>
            <input type="password" name="password_repeat" autocomplete="on" placeholder="Повторите пароль">
            <input type="submit" style="margin-top: 5px" id="signupBtn" value="Сохранить">
        </form>
    </div>
    <p class="signup__alert">*Пароль должен содержать не менее 6 символов</p>
</div>
</section>