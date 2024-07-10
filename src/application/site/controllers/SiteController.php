<?php

declare(strict_types=1);

namespace application\site\controllers;

use application\admin\forms\PageForm;
use application\common\components\AbstractController;
use application\common\forms\SlugPhotoAlbumForm;
use application\site\services\PhotoAlbumService;
use application\site\services\SiteService;
use yii\web\NotFoundHttpException;
use yii\web\Response;

final class SiteController extends AbstractController
{
    public function __construct(
        $id,
        $module,
        private readonly SiteService $service,
        private readonly PageForm $pageForm,
        array $config = []
    ) {
        parent::__construct($id, $module, $config);
    }

    public function actionIndex(): Response
    {
        return $this->redirect(['site/list', 'page' => 1]);
    }

    public function actionList(int $page): string
    {
        $form = $this->pageForm;

        $form->runValidate(['page' => $page,]);

        if ($form->hasErrors()) {
            throw new NotFoundHttpException($form->getFirstError('page'));
        }

        return $this->render(
            'index',
            [
                'data' => $this->service->list($page)
            ]
        );
    }
}
