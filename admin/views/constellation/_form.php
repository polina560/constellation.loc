<?php

use admin\widgets\input\Select2;
use common\widgets\AppActiveForm;
use kartik\icons\Icon;
use yii\bootstrap5\Html;
use yii\helpers\Url;

/**
 * @var $this     yii\web\View
 * @var $model    common\models\Constellation
 * @var $form     AppActiveForm
 * @var $isCreate bool
 */
?>

<div class="constellation-form">

    <?php $form = AppActiveForm::begin() ?>

    <?= $form->field($model, 'coordinates')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'en_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'en_description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image')->widget(\admin\widgets\ckfinder\CKFinderInputFile::class) ?>

    <?= $form->field($model, 'user_photo')->widget(\admin\widgets\ckfinder\CKFinderInputFile::class) ?>

    <?= $form->field($model, 'status')->widget(
        Select2::class,
        ['data' => \common\enums\ModerationStatus::indexedDescriptions(), 'hideSearch' => true]) ?>

    <?= $form->field($model, 'type')->widget(
        Select2::class,
        ['data' => \common\enums\Type::indexedDescriptions(), 'hideSearch' => true]) ?>

    <div class="form-group">
        <?php if ($isCreate) {
            echo Html::submitButton(
                Icon::show('save') . Yii::t('app', 'Save And Create New'),
                ['class' => 'btn btn-success', 'formaction' => Url::to() . '?redirect=create']
            );
            echo Html::submitButton(
                Icon::show('save') . Yii::t('app', 'Save And Return To List'),
                ['class' => 'btn btn-success', 'formaction' => Url::to() . '?redirect=index']
            );
        } ?>
        <?= Html::submitButton(Icon::show('save') . Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php AppActiveForm::end() ?>

</div>
