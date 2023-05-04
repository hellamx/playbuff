<?php use playbuff\Registry; ?>
<div style="width:100%" class="main__product--info">
	<h1 class="news__info--title signupTitle">Пополнение баланса</h1>
    <div class="singUp__content">
        <form class="balanceForm" method="post" action="/user/getbalance">
			<label for="balanceMethod">Способ оплаты:</label>
			<select id="balanceMethod" name="balanceMethod">
				<option value="card">Банковская карта или электронные кошельки</option>
				<option value="crypto">Криптовалюта</option>
			</select>
            <label for="password">Сумма в рублях:</label>
            <input type="text" name="balance" autocomplete="on" placeholder="Сумма">
            <input type="submit" style="margin-top: 5px" value="Пополнить">
        </form>
    </div>
</div>
</section>