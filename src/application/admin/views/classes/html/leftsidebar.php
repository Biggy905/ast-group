<?php

use yii\helpers\Url;

?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="/" class="brand-link">
        <i class="nav-icon fas fa-bullhorn"></i>
        <span class="brand-text font-weight-light">Мероприятие</span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="<?= Url::to(['event/list', 'page' => 1], true);?>" class="nav-link">
                        <i class="nav-icon fas fa-bullhorn"></i>
                        <p>
                            Мероприятия
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= Url::to(['manager/list', 'page' => 1], true);?>" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Организаторы
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
