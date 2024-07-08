<?php

namespace application\admin\forms;

use application\common\components\AbstractForm;
use DomainException;
use yii\web\NotFoundHttpException;

final class IdForm extends AbstractForm
{
    public $id;
    public $repository;

    public function rules(): array
    {
        return [
            [
                'id',
                'integer',
            ],
            [
                'id',
                'validateExistsId',
            ],
            [
                'repository',
                'safe',
            ],
        ];
    }

    public function validateExistsId(): void
    {
        if (!method_exists($this->repository, 'existsById')) {
            throw new DomainException(
                'Please, add new method "existsById(int $id)" in class "' . $this->repository::class . '"'
            );
        }

        $exists = $this->repository->existsById($this->id);
        if (!$exists) {
            throw new NotFoundHttpException('Страница не найдена!');
        }
    }
}
