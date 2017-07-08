<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Barang */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Barangs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title"><?php echo Html::encode($this->title); ?></h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
        </div>
    </div>
    <div class="box-body">
        <div class="btn-group margin-bottom-5">
            <?php echo Html::a('<i class="glyphicon glyphicon-home"> </i> ' . 'Home', ['index'], ['class' => 'btn btn-sm
                                btn-success']);
            echo Html::a('<i class="glyphicon glyphicon-th"> </i> ' . 'Kartu Stock Gudang', ['stock-gudang', 'id' => $model->id], ['class'
            => 'btn btn-sm btn-primary']);
            echo Html::a('<i class="glyphicon glyphicon-th"> </i> ' . 'Kartu Stock Toko', ['stock-toko', 'id' => $model->id], [
                'class' => 'btn btn-sm btn-primary',
            ]); ?>
        </div>

        <?php echo DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'nm_barang',
                'ket_barang:ntext',
            ],
        ]); ?>
    </div>
    <div class="box-footer">

    </div>
</div>



