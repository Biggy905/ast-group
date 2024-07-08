<?php

use yii\helpers\Url;

?>

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Список</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-success"
                            data-bs-toggle="modal"
                            data-bs-target="#create">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                    <?php if (empty($tableData) && empty($tableTitles)) {?>

                        <tr>
                            <td>
                                Нет данных
                            </td>
                        </tr>

                    <?php } else {?>

                        <tr>
                            <?php foreach ($tableTitles as $tableTitle) {?>

                                <th><?= !is_array($tableTitle) ? $tableTitle : $tableTitle['title']?></th>

                            <?php }?>

                            <th class="text-right" style="width: 10%">
                                Действия
                            </th>
                        </tr>

                    <?php }?>

                    </thead>
                    <tbody>
                    <?php if (!empty($tableData) && !empty($tableTitles)) {?>
                    <?php foreach ($tableData as $table){?>

                        <tr>
                            <?php foreach ($table as $data){
                                $title = null;
                                if (is_string($data) || is_int($data)){
                                    $title = $data;
                                } elseif (is_array($data) && $data['relation_type'] === 'one') {
                                    $title = $data['relation_data']['title'];
                                } elseif (is_array($data) && $data['relation_type'] === 'many') {
                                    $tempTitle = [];
                                    foreach ($data['relation_data'] as $relationData) {
                                        $tempTitle[]= $relationData['title'];
                                    }

                                    $title = implode(', ', $tempTitle);
                                }
                                ?>

                            <td><?= (is_string($title) || is_int($title)) ? $title : 'Нет данных'?></td>

                            <?php }?>

                            <td class="project-actions text-right">
                                <button type="button" class="btn btn-primary btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#info-<?= $table['id']?>">
                                    <i class="fas fa-info"></i>
                                </button>
                                <button type="button" class="btn btn-info btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#edit-<?= $table['id']?>">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                <button type="button" class="btn btn-danger btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#delete-<?= $table['id']?>">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>

                        </tr>

                    <?php }?>
                    <?php }?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- START COMPONENTS: MODAL -->
        <div class="modal fade" id="create">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Создать</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body" id="create_form">

                        <?= \application\admin\views\classes\FormRender::toRenderForModal(
                                $this,
                                $create_form,
                                Url::to($create_url, true),
                                'create_form',
                                'send_form'
                        )?>

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-bs-dismiss="modal">Закрыть</button>
                        <button type="button" id="send_form" class="btn btn-success create-button">Сохранить</button>
                    </div>
                </div>
            </div>
        </div>

    <?php foreach ($tableData as $data) {
        $id = $data['id'];
        $urlUpdate = Url::to($update_url[$id], true);
        $update_form->load($data);
        $update_form->validate();
        $update_form->reloadAttributesTypeInput();

        $urlDelete = Url::to($delete_url[$id], true);
        $delete_form->load($data);
        $delete_form->validate();
        $delete_form->reloadAttributesTypeInput();
        ?>

        <div class="modal fade" id="info-<?= $data['id']?>">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Информация</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <?php foreach ($tableTitles as $tableLabel => $tableTitle) {

                            $label = 'Нет данных';
                            if (is_string($tableTitle)) {
                                $label = $tableTitle;
                            } elseif (is_array($tableTitle)) {
                                $label = $tableTitle['title'];
                            }

                            $title = null;
                            if (is_string($data[$tableLabel]) || is_int($data[$tableLabel])){
                                $title = $data[$tableLabel];
                            } elseif (is_array($data[$tableLabel]) && $data[$tableLabel]['relation_type'] === 'one') {
                                $title = $data[$tableLabel]['relation_data']['title'];
                            } elseif (is_array($data[$tableLabel]) && $data[$tableLabel]['relation_type'] === 'many') {
                                $tempTitle = [];
                                foreach ($data[$tableLabel]['relation_data'] as $relationData) {
                                    $tempTitle[]= $relationData['title'];
                                }

                                $title = implode(', ', $tempTitle);
                            }
                            ?>

                            <p>
                                <b><?=  $label?>: </b><?= $title?>
                            </p>

                        <?php }?>

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-bs-dismiss="modal">Закрыть</button>
                        <button type="button" class="btn btn-info"
                                data-bs-toggle="modal"
                                data-bs-target="#edit-<?= $table['id']?>">Обновить
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="edit-<?= $data['id']?>">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Обновить</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body" id="update_form_<?= $data['id']?>">

                        <?= \application\admin\views\classes\FormRender::toRenderForModal(
                                $this,
                                $update_form,
                                $urlUpdate,
                                'update_form_' . $data['id'],
                                'send_update_form_' . $data['id']
                        ) ?>

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-bs-dismiss="modal">Закрыть</button>
                        <button type="button" id="send_update_form_<?= $data['id']?>" class="btn btn-info">Обновить</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="delete-<?= $data['id']?>">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Вы точно хотите удалить "<?= $data['title']?>"?</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?= \application\admin\views\classes\FormRender::toRenderForModal(
                                $this,
                                $delete_form,
                                $urlDelete,
                                'delete_form_' . $data['id'],
                                'send_delete_form_' . $data['id']
                        ) ?>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-bs-dismiss="modal">Закрыть</button>
                        <button type="button" id="send_delete_form_<?= $data['id']?>" class="btn btn-danger">Да, удалить</button>
                    </div>
                </div>
            </div>
        </div>

    <?php }?>
    <!-- END COMPONENTS: MODAL -->
