<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<?= $this->render('head')?>

<?= \application\admin\views\classes\IsGuestRender::toRenderBody($this, $content, Yii::$app->user->isGuest)?>

</html>

<?php $this->endPage()?>
