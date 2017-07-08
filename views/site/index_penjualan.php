<?php
use yii\helpers\Html;
use kartik\date\DatePicker;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BarangSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Laporan Penjualan';
$this->params['breadcrumbs'][] = $this->title;
$tglAwal = '';
$tglAkhir = '';
$post = Yii::$app->request->post();
if (count($post) > 0) {
    $tglAwal = $post['tgl_awal'];
    $tglAkhir = $post['tgl_akhir'];
}
?>
<div class="barang-index">
    <h1><?php echo Html::encode($this->title) ?></h1>
    <?php
    $form = ActiveForm::begin();
    echo '<label class="control-label">Periode Laporan</label>';
    echo DatePicker::widget(
        [
            'name' => 'tgl_awal',
            'name2' => 'tgl_akhir',
            'attribute' => 'tgl_awal',
            'attribute2' => 'tgl_akhir',
            'id' => 'tgl_awal',
            'value' => $tglAwal,
            'value2' => $tglAkhir,
            'options' => ['placeholder' => 'Tgl. Awal'],
            'options2' => ['placeholder' => 'Tgl. Akhir'],
            'type' => DatePicker::TYPE_RANGE,
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd',
                'autoclose' => true,
            ]
        ]
    );
    ?>
    <div class="form-group">
        <?php
        echo Html::submitButton(
            'Check Laporan',
            ['class' => 'btn btn-primary margin-top-5 margin-right-5']
        );
        echo Html::button(
            'Cetak Laporan Ini',
            ['class' => 'btn btn-success margin-top-5 margin-right-5', 'id' => 'cetak-laporan-2']
        ); ?>
    </div>
    <?php
    ActiveForm::end();
    ?>
    <table class="table table-hover table-striped table-bordered">
        <thead>
        <tr>
            <th>No</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Kuantitas</th>
            <th>Harga</th>
            <th>Jumlah</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if (count($model) > 0) {
            $i = 1;
            foreach ($model as $row) {
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $row['barcode']; ?></td>
                    <td><?php echo strtoupper($row['nm_barang']); ?></td>
                    <td class="text-center"><?php echo number_format($row['jml']); ?></td>
                    <td class="text-right"><?php echo number_format($row['harga']); ?></td>
                    <td class="text-right"><?php echo number_format($row['subtotal']); ?></td>
                </tr>
                <?php
                $i++;
            }
        }
        ?>
        </tbody>
    </table>
</div>
