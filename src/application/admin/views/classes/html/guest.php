<?php

use application\admin\assets\ToastrAssets;

ToastrAssets::register($this);

?>
<body class="hold-transition login-page">

<?php $this->beginBody()?>

<?= $this->render('../../components/forms/login.php', ['url' => $url]);?>

<?php $this->endBody()?>

</body>
