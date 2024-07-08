<div class="error-page">
    <h2 class="headline text-danger"><?= $data['codeStatus']?></h2>
    <div class="error-content">
        <h3><i class="fas fa-exclamation-triangle text-danger"></i> <?= $data['message']?></h3>
        <p>
            Вы получили ошибку, обратитесь в техподдержку разработчиков. Сообщите детали ошибки, следствие чего возникла ошибка.
            Тем временем, вы можете <a href="/">вернуться в админку</a>.
        </p>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <h3>
            Детализация ошибки:
        </h3>
        <div class="card">
            <div class="card-body table-responsive p-0" style="height: 300px;">
                <table class="table table-head-fixed text-nowrap">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>File</th>
                        <th>Function</th>
                        <th>Class</th>
                        <th>Args</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php foreach($data['stacktrace'] as $key => $stacktrace) {?>

                        <tr>
                            <td><?= $key?></td>
                            <td><?= $stacktrace['file'] ?? ''?> : <?= $stacktrace['line'] ?? ''?></td>
                            <td><?= $stacktrace['function'] ?? ''?></td>
                            <td><?= $stacktrace['class'] ?? ''?></td>
                            <td>

                                <table>
                                    <tbody>

                                    <?php foreach ($stacktrace['args'] as $arg) { ?>

                                    <tr>
                                        <td>

                                            <?php if (is_int($arg)) { echo $arg;}?>
                                            <?php if (is_string($arg)) { echo $arg; }?>
                                            <?php if (is_array($arg)) { echo "Array Arg"; }?>

                                        </td>
                                    </tr>

                                    <?php }?>

                                    </tbody>
                                </table>

                            </td>
                        </tr>

                    <?php }?>

                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
