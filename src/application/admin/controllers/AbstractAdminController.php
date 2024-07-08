<?php


use application\admin\forms\IdForm;
use application\admin\forms\PageForm;
use application\admin\services\interfaces\AbstractServiceInterface;
use application\common\components\AbstractController;
use application\common\components\AbstractForm;
use application\common\components\repository\AbstractRepositoryInterface;
use DomainException;
use Yii;
use yii\web\NotFoundHttpException;

/**
 *
 * @property-write AbstractServiceInterface $service
 */
abstract class AbstractAdminController extends AbstractController
{
    protected static AbstractRepositoryInterface $_repository;
    protected static AbstractForm $_createForm;
    protected static AbstractForm $_updateForm;
    protected static AbstractForm $_deleteForm;

    public function __construct(
        $id,
        $module,
        protected readonly IdForm $idForm,
        protected readonly PageForm $pageForm,
        $config = []
    ) {
        parent::__construct($id, $module, $config);
    }

    /**
     * @throws NotFoundHttpException
     */
    public function actionItem(int $id): string
    {
        $this->exception();
        $form = $this->validateId($id, static::$_repository);

        $data = $this->service->item($form);
        $this->view->title = $data['title'] ?? '';
        $this->view->params['breadcrumbs'] = $data['breadcrumbs'] ?? [];

        return $this->render(
            'item',
            [
                'data' => $data,
            ]
        );
    }

    public function actionList(int $page = 1): string
    {
        $this->exception();
        $this->validatePage($page);

        $data = $this->service->list($page);
        $this->view->title = $data['title'] ?? '';
        $this->view->params['breadcrumbs'] = $data['breadcrumbs'] ?? [];

        return $this->render(
            'list',
            [
                'data' => $data,
            ]
        );
    }
    public function actionCreate(): array
    {
        $postPayload = json_decode(Yii::$app->request->getRawBody(), true) ?? [];

        $form = static::$_createForm;
        $data = match ($form->runValidate($postPayload)) {
            true => $this->service->create($form),
            false => $form->getFirstErrors(),
        };

        return $this->response($data);
    }

    /**
     * @throws NotFoundHttpException
     */
    public function actionUpdate(int $id): array
    {
        $this->exception();
        $this->validateId($id, static::$_repository);

        $patchPayload = json_decode(Yii::$app->request->getRawBody(), true) ?? [];

        $form = static::$_updateForm;
        $data = match ($form->runValidate($patchPayload)) {
            true => $this->service->update($form),
            false => $form->getFirstErrors(),
        };

        return $this->response($data);
    }

    /**
     * @throws NotFoundHttpException
     */
    public function actionDelete(int $id): array
    {
        $this->exception();
        $form = $this->validateId($id, static::$_repository);

        $data = match ($form->runValidate([])) {
            true => $this->service->delete($form),
            false => $form->getFirstErrors(),
        };

        return $this->response($data);
    }

    public function beforeAction($action): bool
    {
        if (
            ($this->action->id == 'create')
            || ($this->action->id == 'update')
            || ($this->action->id == 'delete')
        ) {
            $this->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);
    }

    private function exception(): void
    {
        if (empty(static::$_createForm)) {
            throw new DomainException(
                'No property "$_createForm" declared  in the class "' . static::class . '".'
            );
        }
        if (empty(static::$_updateForm)) {
            throw new DomainException(
                'No property "$_updateForm" declared  in the class "' . static::class . '".'
            );
        }
        if (empty(static::$_deleteForm)) {
            throw new DomainException(
                'No property "$_deleteForm" declared  in the class "' . static::class . '".'
            );
        }
        if (empty(static::$_repository)) {
            throw new DomainException(
                'No property "$_repository" declared  in the class "' . static::class . '".'
            );
        }
    }

    /**
     * @throws NotFoundHttpException
     */
    private function validateId(int $id, AbstractRepositoryInterface $abstractRepository): AbstractForm
    {
        $form = $this->idForm;

        $form->runValidate(
            [
                'id' => $id,
                'repository' => $abstractRepository,
            ]
        );

        if ($form->hasErrors()) {
            throw new NotFoundHttpException($form->getFirstError('id'));
        }

        return $form;
    }

    private function validatePage(int $page): void
    {
        $form = $this->pageForm;

        $form->runValidate(
            [
                'page' => $page,
            ]
        );

        if ($form->hasErrors()) {
            throw new DomainException($form->getFirstError('page'));
        }
    }
}
