<?php

/** @var array $data */

$lastBreadcrumb = array_pop($data);

?>

<ol class="breadcrumb float-sm-right">

    <?php foreach ($data as $breadcrumb) {?>

        <li class="breadcrumb-item">
            <a href="<?= $breadcrumb['url']?>"><?= $breadcrumb['title']?></a>
        </li>

    <?php }?>

    <li class="breadcrumb-item active"><?= $lastBreadcrumb['title']?></li>

</ol>
