<?php

$asd;

?>
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
