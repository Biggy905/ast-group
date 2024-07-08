<?php

$js = <<<JS

    $(document).ready(function (e) {
        $('#click-button'). click(function (e) {
            e.preventDefault();
            
            var rememberMe = 86400;
            if ($('input[name="rememberMe"]').is(':checked')) {
                rememberMe = 1209600;
            }
            
            let body = JSON.stringify({
                "login": $('input[name="login"]').val(),
                "password": $('input[name="password"]').val(),
                "rememberMe": rememberMe
            });
            
            responseFormValidate(
                sendForm(
                    'POST',
                    '$url',
                    'application/json; charset=utf-8',
                    'json',
                    body
                )
            );
            
            return false;
        });

    });

JS;

$this->registerJs($js, \yii\web\View::POS_END);

?>

<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>Мероприятие</b></a>
    </div>

    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Старт</p>
            <form>
                <div class="input-group mb-3">
                    <input type="text" name="login" class="form-control" placeholder="Логин">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Пароль">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" name="rememberMe" id="rememberMe" value="1209600">
                            <label for="rememberMe">
                                Сохранить сессию
                            </label>
                        </div>
                    </div>

                    <div class="col-4">
                        <button id="click-button" class="btn btn-primary btn-block">Войти</button>
                    </div>

                </div>
            </form>
        </div>

    </div>
</div>
