<?php

use admin\components\GroupedActionColumn;
use admin\components\widgets\gridView\Column;
use admin\components\widgets\gridView\ColumnSelect2;
use admin\modules\rbac\components\RbacHtml;
use admin\widgets\sortableGridView\SortableGridView;
use kartik\grid\SerialColumn;
use yii\widgets\ListView;

/**
 * @var $this         yii\web\View
 * @var $searchModel  common\models\ConstellationSearch
 * @var $dataProvider yii\data\ActiveDataProvider
 * @var $model        common\models\Constellation
 */

$this->title = Yii::t('app', 'Constellations');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="constellation-index">

    <h1><?= RbacHtml::encode($this->title) ?></h1>

    <div>
        <?=
            RbacHtml::a(Yii::t('app', 'Create Constellation'), ['create'], ['class' => 'btn btn-success']);
//           $this->render('_create_modal', ['model' => $model]);
        ?>
    </div>

    <?= SortableGridView::widget([
        'dataProvider' => $dataProvider,
        'pjax' => true,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => SerialColumn::class],

            Column::widget(),
            Column::widget(['attr' => 'title']),
            Column::widget(['attr' => 'en_title']),
            Column::widget(['attr' => 'coordinates']),
//            Column::widget(['attr' => 'description']),
//            Column::widget(['attr' => 'en_description']),
//            Column::widget(['attr' => 'image']),
//            Column::widget(['attr' => 'user_photo']),
            ColumnSelect2::widget(['attr' => 'status', 'items' => \common\enums\ModerationStatus::class, 'hideSearch' => true]),
            ColumnSelect2::widget(['attr' => 'type', 'items' => \common\enums\Type::class, 'hideSearch' => true]),

            ['class' => GroupedActionColumn::class]
        ]
    ]) ?>
</div>
