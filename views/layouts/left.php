<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo $directoryAsset; ?>/img/avatar5.png" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?php echo Yii::$app->user->identity->username; ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <?php echo dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'Panel Report', 'options' => ['class' => 'header']],
                    ['label' => 'Barang', 'url' => ['barang/index']],
                    ['label' => 'Pembelian', 'url' => ['site/pembelian']],
                    ['label' => 'Pengeluaran Kas', 'url' => ['site/pengeluaran-kas']],
                    ['label' => 'Penjualan', 'url' => ['site/penjualan']],
                    ['label' => 'Penerimaan Kas', 'url' => ['site/penerimaan-kas']],
                    ['label' => 'Aktiva dan Investasi', 'url' => ['site/aktiva-investasi']],
                    ['label' => 'Lap. Keuangan', 'url' => ['site/lap-keuangan']],
                ],
            ]
        ) ?>

    </section>

</aside>
