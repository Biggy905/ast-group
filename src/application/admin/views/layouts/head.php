<?php

use application\admin\assets\AdminAsset;
use application\admin\assets\MainAssets;

AdminAsset::register($this);
MainAssets::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);

?>
<head>

<title><?= $this->title?></title>

<?php $this->head() ?>

</head>
