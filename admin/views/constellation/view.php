<?php

use admin\components\widgets\detailView\Column;
use admin\components\widgets\detailView\ColumnImage;
use admin\modules\rbac\components\RbacHtml;
use common\components\helpers\UserUrl;
use common\models\ConstellationSearch;
use yii\widgets\DetailView;

/**
 * @var $this  yii\web\View
 * @var $model common\models\Constellation
 */

$this->title = $model->title;
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Constellations'),
    'url' => UserUrl::setFilters(ConstellationSearch::class)
];
$this->params['breadcrumbs'][] = RbacHtml::encode($this->title);
?>
<div class="constellation-view">

    <h1><?= RbacHtml::encode($this->title) ?></h1>

    <p>
        <?= RbacHtml::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= RbacHtml::a(
            Yii::t('app', 'Delete'),
            ['delete', 'id' => $model->id],
            [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post'
                ]
            ]
        ) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            Column::widget(),
            Column::widget(['attr' => 'token_id']),
            Column::widget(['attr' => 'coordinates']),
            Column::widget(['attr' => 'title']),
            Column::widget(['attr' => 'en_title']),
            Column::widget(['attr' => 'description']),
            Column::widget(['attr' => 'en_description']),
            ColumnImage::widget(['attr' => 'image']),
            Column::widget(['attr' => 'user_photo']),
            Column::widget(['attr' => 'status', 'items' => \common\enums\ModerationStatus::class]),
            Column::widget(['attr' => 'type', 'items' => \common\enums\Type::class]),
        ]
    ]) ?>

</div>
