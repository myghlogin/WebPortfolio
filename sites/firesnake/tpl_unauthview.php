<div>
    <h3>Вход / Регистрация</h3>
    <p>Регистрация позволяет хранить рекорды.</p>
    <br>
    <?=$error?>
    <form>
        <span>Логин:</span>
        <br>
        <input type="text" name="login" id="login" value="<?=$login?>" maxlength="20">
        <br>
        <span>Пароль:</span>
        <br>
        <input type="password" name="password" id="password" value=""  maxlength="20">
        <br>
        <input type="button" name="loginBtn" id="loginBtn" value="Войти">
        <input type="button" name="registerBtn" id="registerBtn" value="Зарегистрироваться">
   </form>
</div>
