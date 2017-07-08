<?php
namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->actionLogin();
        }
        #$modelBarang = new \app\models\Barang();
        #$recordBarang = $modelBarang->find()->select(['id', 'nm_barang', 'harga_jual', 'stock'])->asArray()->all();
        #Yii::$app->session->set('barang', $recordBarang);
        $model = [];
        $kategori = (new \yii\db\Query())->select('id, desc')->from('kategori')->orderBy('desc')->all();
        if (count($kategori) > 0) {
            foreach ($kategori as $row_kategori) {
                $barang = (new \yii\db\Query())->select(
                    'id, nm_barang'
                )->from('barang')->where(['id_kategori' => $row_kategori['id']])->all();
                if (count($barang) > 0) {
                    foreach ($barang as $row_barang) {
                        $model[$row_kategori['desc']][] = [
                            'id' => $row_barang['id'],
                            'nm_barang' => $row_barang['nm_barang']
                        ];
                    }
                }
            }
        }
        return $this->render('index', ['model' => $model]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        $this->layout = 'main-login';
        return $this->render(
            'login',
            [
                'model' => $model,
            ]
        );
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');
            return $this->refresh();
        }
        return $this->render(
            'contact',
            [
                'model' => $model,
            ]
        );
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * @return string
     */
    public function actionPembelian()
    {
        $dateFrom = Yii::$app->request->post('tgl_awal');
        $dateTo = Yii::$app->request->post('tgl_akhir');
        $timezone = new \DateTimeZone('Asia/Jakarta');
        $dateCreatedFrom = new \DateTime($dateFrom, $timezone);
        $dateCreatedTo = new \DateTime($dateTo, $timezone);
        $intervalDay = $dateCreatedFrom->diff($dateCreatedTo);
        $diffDay = (integer)$intervalDay->format('%a');
        if ($diffDay === 0) {
            $model = (new \yii\db\Query())->select('penerimaan_detail.qty_terima, penerimaan_detail.harga, penerimaan_detail.subtotal, barang.nm_barang, barang_detail.barcode')->from('penerimaan_detail')->innerJoin('barang', 'penerimaan_detail.id_barang=barang.id')->innerJoin('barang_detail', 'barang.id=barang_detail.id_barang')->where('penerimaan_detail.id_penerimaan IN(SELECT penerimaan.id FROM penerimaan WHERE penerimaan.tgl="' . $dateFrom . '")')->orderBy('barang.nm_barang ASC')->all();
        } else {
            $model = (new \yii\db\Query())->select('penerimaan_detail.qty_terima, penerimaan_detail.harga, penerimaan_detail.subtotal, barang.nm_barang, barang_detail.barcode')->from('penerimaan_detail')->innerJoin('barang', 'penerimaan_detail.id_barang=barang.id')->innerJoin('barang_detail', 'barang.id=barang_detail.id_barang')->where('penerimaan_detail.id_penerimaan IN(SELECT penerimaan.id FROM penerimaan WHERE penerimaan.tgl BETWEEN "' . $dateFrom . '" AND "' . $dateTo . '")')->orderBy('barang.nm_barang ASC')->all();
        }

        return $this->render('index_pembelian', ['model' => $model]);
    }

    /**
     * @return string
     */
    public function actionPenjualan()
    {
        $dateFrom = Yii::$app->request->post('tgl_awal');
        $dateTo = Yii::$app->request->post('tgl_akhir');
        $timezone = new \DateTimeZone('Asia/Jakarta');
        $dateCreatedFrom = new \DateTime($dateFrom, $timezone);
        $dateCreatedTo = new \DateTime($dateTo, $timezone);
        $intervalDay = $dateCreatedFrom->diff($dateCreatedTo);
        $diffDay = (integer)$intervalDay->format('%a');
        if ($diffDay === 0) {
            $model = (new \yii\db\Query())->select('penjualan_detail.jml, penjualan_detail.harga, penjualan_detail.subtotal, barang.nm_barang, penjualan_detail.barcode')->from('penjualan_detail')->innerJoin('barang', 'barang.id=penjualan_detail.id_barang')->where('penjualan_detail.id_penjualan IN(SELECT penjualan.id FROM penjualan WHERE DATE(penjualan.tgl)="' . $dateFrom . '")')->orderBy('barang.nm_barang ASC')->all();
        } else {
            $model = (new \yii\db\Query())->select('penjualan_detail.jml, penjualan_detail.harga, penjualan_detail.subtotal, barang.nm_barang, penjualan_detail.barcode')->from('penjualan_detail')->innerJoin('barang', 'barang.id=penjualan_detail.id_barang')->where('penjualan_detail.id_penjualan IN(SELECT penjualan.id FROM penjualan WHERE DATE(penjualan.tgl) BETWEEN "' . $dateFrom . '" AND "' . $dateTo . '")')->orderBy('barang.nm_barang ASC')->all();
        }
        return $this->render('index_penjualan', ['model' => $model]);
    }

    /**
     * @return string
     */
    public function actionPengeluaranKas()
    {
        $model = [];
        $modelKategori = new \app\models\PettyCashKategori();
        $recordKategori = $modelKategori->findOne(['id' => '1']);
        $dateFrom = Yii::$app->request->post('tgl_awal');
        $dateTo = Yii::$app->request->post('tgl_akhir');
        $timezone = new \DateTimeZone('Asia/Jakarta');
        $dateCreatedFrom = new \DateTime($dateFrom, $timezone);
        $dateCreatedTo = new \DateTime($dateTo, $timezone);
        $intervalDay = $dateCreatedFrom->diff($dateCreatedTo);
        $diffDay = (integer)$intervalDay->format('%a');
        if ($diffDay === 0) {
            $modelPembelian = (new \yii\db\Query())->select('tgl, SUM(total) AS total')->from('penerimaan')->groupBy(['tgl'])->where('tgl="' . $dateFrom . '"')->all();
            $modelPettyCash = (new \yii\db\Query())->select('petty_cash.tgl, petty_cash.id_kategori, petty_cash.nominal, petty_cash_kategori.nm_kategori')->from('petty_cash')->innerJoin('petty_cash_kategori', 'petty_cash.id_kategori=petty_cash_kategori.id')->where('tgl="' . $dateFrom . '"')->all();
        } else {
            $modelPembelian = (new \yii\db\Query())->select('tgl, SUM(total) AS total')->from('penerimaan')->groupBy(['tgl'])->where('tgl BETWEEN "' . $dateFrom . '" AND "' . $dateTo . '"')->all();
            $modelPettyCash = (new \yii\db\Query())->select('petty_cash.tgl, petty_cash.nominal, petty_cash_kategori.nm_kategori')->from('petty_cash')->innerJoin('petty_cash_kategori', 'petty_cash.id_kategori=petty_cash_kategori.id')->where('tgl BETWEEN "' . $dateFrom . '" AND "' . $dateTo . '"')->all();
        }
        if (count($modelPembelian) > 0) {
            foreach ($modelPembelian as $row) {
                $model[] = [
                    'tgl' => $row['tgl'],
                    'nm_kategori' => $recordKategori['nm_kategori'],
                    'total' => $row['total']
                ];
            }
        }
        if (count($modelPettyCash) > 0) {
            foreach ($modelPettyCash as $row) {
                $model[] = [
                    'tgl' => $row['tgl'],
                    'nm_kategori' => $row['nm_kategori'],
                    'total' => $row['nominal']
                ];
            }
        }

        return $this->render('index_pengeluaran_kas', ['model' => $model]);
    }

    /**
     * @return string
     */
    public function actionPenerimaanKas()
    {
        $model = [];
        return $this->render('index_penerimaan_kas', ['model' => $model]);
    }

    /**
     * @return string
     */
    public function actionAktivaInvestasi()
    {
        $model = [];
        return $this->render('index_aktiva_investasi', ['model' => $model]);
    }

    /**
     * @return string
     */
    public function actionLapKeuangan()
    {
        $model = [];
        return $this->render('index_lap_keuangan', ['model' => $model]);
    }
}
