<?php

/** @var \application\common\components\AbstractForm $form */

use yii\web\View;
use application\admin\assets\ToastrAssets;

ToastrAssets::register($this);

$method = $form::TYPE_METHOD;

$fields = $form->attributeTypeInput;

$generate = '';
foreach ($fields as $name => $field) {
    $htmlId = 'field-' . $name;
    $generate .= "Form['$name'] = $('#$id #$htmlId').val();\n\t\t";
}

$js = <<<JS
    
    function getBodyValueFromModal_$id()
    {
        var Form = {};
        
        $generate

        return Form;
    }
    
    function sendFormFromModal_$id() {
        $(document).ready(function (e) {
            $('#$button'). click(function (e) {
                e.preventDefault();
                
                var valueFromModal = getBodyValueFromModal_$id();
                var body = JSON.stringify(valueFromModal);
                
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
    }
    
    sendFormFromModal_$id();

JS;

$this->registerJs($js, View::POS_END);

?>

<?php foreach ($fields as $name => $field) {?>

    <div class="form-group">
        <label for="field-<?= $name?>" class="form-label"><?= $field['title'] ?? ''?></label>

        <?= \application\common\enums\FormTypeInputEnums::case($field['enum'], $name, $field['options'], $field['value'] ?? null)?>

    </div>

<?php }?>
