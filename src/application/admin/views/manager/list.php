<?php

use application\common\components\HttpClient\enums\MethodHttpEnum;
use yii\helpers\Url;
use application\admin\assets\ToastrAssets;

ToastrAssets::register($this);

$enumMethod = MethodHttpEnum::METHOD_POST;
$method = $enumMethod->takeMethod();

$url = Url::to(['manager/run'], true);

$js = <<<JS
        $(document).ready(function (e) {
            $('#send-queue'). click(function (e) {
                e.preventDefault();
                
                var body = JSON.stringify({});
                
                responseFormValidate(
                    sendForm(
                        '$method',
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

<div class="row">
    <div class="row justify-content-md-end">
        <div class="col-12 mb-3">
            <button id="send-queue" class="btn btn-outline-info">Отправить на RetailCRM</button>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">

        <?= \application\admin\views\classes\TableRender::toArray($this,['data' => $data]);?>

    </div>
</div>
<div class="row justify-content-md-center">
    <div class="col-sm-12 col-md-8 justify-content-center">

        <?= \application\admin\views\classes\PaginationRender::toArray($this, $data['pagination'])?>

    </div>
</div>

