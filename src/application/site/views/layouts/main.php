<?php

use application\site\assets\MainAssets;

MainAssets::register($this);

?>
<?php $this->beginPage() ?>
<html>

<head>
    <title><?= $this->title?></title>

    <?php $this->head()?>

</head>

<body class="bg">
<?php $this->beginBody()?>

<?= $content?>

<?php $this->endBody()?>
</body>

</html>
<?php $this->endPage()?>