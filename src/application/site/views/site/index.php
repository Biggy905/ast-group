<?php

/** @var array $data */

use yii\bootstrap5\LinkPager;

$currentPage = Yii::$app->request->get('page');

$pagination = $data['pagination'];

$count = $pagination->totalCount;

$maxButtonCount = 3;
$intCurrentPage = (int) $currentPage;
$dirtyLastPage = intdiv($count + 16, 16);

$firstPageLabel = false;
$prevPageLabel = false;
$nextPageLabel = false;
$lastPageLabel = false;
if ($maxButtonCount < $dirtyLastPage) {
    // Если юзер находится на 1 и 2 странице
    if ($intCurrentPage === 1 || $intCurrentPage === 2) {
        $maxButtonCount = 4;
        $nextPageLabel = '...';
        $lastPageLabel = $dirtyLastPage;
        // Если юзер находится на позиции более 2 страниц
    } elseif ($intCurrentPage > 2) {
        $firstPageLabel = 1;
        $prevPageLabel = '...';

        if (
            $intCurrentPage === ($dirtyLastPage - 1)
            || $intCurrentPage === $dirtyLastPage
        ) {
            $nextPageLabel = false;
            $lastPageLabel = false;
        } elseif (
            $intCurrentPage < ($dirtyLastPage - 1)
            || $intCurrentPage <= $dirtyLastPage
        ) {
            $nextPageLabel = '...';
            $lastPageLabel = $dirtyLastPage;
        }
    }
}

$linkPager = LinkPager::widget([
    'pagination' => $pagination,
    'maxButtonCount' => $maxButtonCount,

    'pageCssClass' => 'paginate_button page-item',
    'firstPageCssClass' => 'paginate_button page-item',
    'lastPageCssClass' => 'paginate_button page-item',
    'activePageCssClass' => 'paginate_button page-item active',
    'disabledPageCssClass' => 'paginate_button page-item disabled',

    'firstPageLabel' => $firstPageLabel,
    'lastPageLabel' => $lastPageLabel,
    'nextPageLabel' => $nextPageLabel,
    'prevPageLabel' => $prevPageLabel,
    'hideOnSinglePage' => false,
    'options' => [
        'tag' => 'div',
        'id' => false,
        'class' => 'pagination justify-content-center',
    ],
    'linkOptions' => [
        'class' => 'page-link',
    ],
]); ?>

<?php if (!empty($data['list'])) { ?>
<div class="container">
    <div class="row">

            <?php foreach ($data['list'] as $item) {
                $date = 'Не указан';
                if (!empty($item['date'])) {
                    $date = \application\common\helpers\DateTimeHelper::getDateTime($item['date'])
                        ->format(
                            \application\common\enums\DateTimeFormatEnums::FORMAT_SITE->value
                        );
                }

                ?>

        <div class="col-3 mt-3">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title"><?= $item['title']?></h5>
                    <p><b>Дата проведения: </b><?= $date?></p>
                    <p><?= $item['description']?></p>
                    <p>Организаторы:</p>
                    <ul>

                        <?php if(!empty($item['managers']['relation_data'])) {
                            foreach ($item['managers']['relation_data'] as $manager) {?>

                                <li><p><?= $manager['name'] . ' ' . $manager['surname']?></p></li>

                            <?php }?>

                        <?php }?>

                    </ul>
                </div>
            </div>
        </div>

            <?php }?>

    </div>
</div>
<?php } else {?>

    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h2>
                    Администрация сайта не добавила мероприятия.
                </h2>
                <p>Приносим извинения.</p>
            </div>
        </div>
    </div>

<?php }?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-5 mt-5 mb-5">

<?= $linkPager?>

        </div>
    </div>
</div>
