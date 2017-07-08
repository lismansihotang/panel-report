<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */
$this->title = 'Sign In';
$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
];
$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];
?>

<div class="row">
    <div class="col-md-4">
        <div class="login-box">
            <div class="login-logo">
                <a href="#"><b>Admin</b>Panel-Report</a>
            </div>
            <div class="login-box-body">
                <p class="login-box-msg">Sign in to start your session</p>
                <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>
                <?php echo $form
                    ->field($model, 'username', $fieldOptions1)
                    ->label(false)
                    ->textInput(['placeholder' => $model->getAttributeLabel('username')]); ?>
                <?php echo $form
                    ->field($model, 'password', $fieldOptions2)
                    ->label(false)
                    ->passwordInput(['placeholder' => $model->getAttributeLabel('password')]); ?>

                <div class="row">
                    <div class="col-xs-8">
                    </div>
                    <div class="col-xs-4">
                        <?php echo Html::submitButton(
                            'Sign in',
                            ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']
                        ); ?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
    <div class="col-md-4 text-yellow">
        <h1>Report Panel</h1>

        <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas scelerisque fermentum eros, non lacinia
            ante tristique nec. Integer vestibulum dictum nunc in condimentum. Ut et venenatis eros. Suspendisse cursus,
            velit et cursus ultricies, ligula felis egestas neque, sit amet tempus felis quam sit amet orci. Sed
            facilisis a ante nec tempor. Fusce finibus non quam pulvinar venenatis. In augue purus, tempor quis felis
            nec, euismod bibendum erat.
        </p>
    </div>
</div>

