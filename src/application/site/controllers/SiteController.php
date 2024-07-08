<?php

declare(strict_types=1);

namespace application\site\controllers;

use application\common\components\AbstractController;
use application\common\forms\SlugPhotoAlbumForm;
use application\site\services\PhotoAlbumService;
use yii\web\NotFoundHttpException;

final class SiteController extends AbstractController
{
    public function __construct(
        $id,
        $module,
        array $config = []
    ) {
        parent::__construct($id, $module, $config);
    }

    public function actionIndex(): string
    {
        return $this->render('index');
    }
}
