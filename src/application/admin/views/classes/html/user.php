<body class="hold-transition sidebar-mini layout-fixed">

<?php $this->beginBody()?>

<div class="wrapper">

    <?= \application\admin\views\classes\NavRender::toRender($this)?>

    <?= \application\admin\views\classes\LeftSideBarRender::toRender($this)?>

    <div class="content-wrapper" style="min-height: 331px;">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"><?= $this->title?></h1>
                    </div>
                    <div class="col-sm-6">

                        <?= \application\admin\views\classes\BreadcrumbRender::toRender($this)?>

                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">

                <?= $content?>

            </div>
        </section>

    </div>

</div>

<?php $this->endBody()?>

</body>
