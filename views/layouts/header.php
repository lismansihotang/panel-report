<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">
    <?php echo Html::a(
        '<span class="logo-mini">APP</span><span class="logo-lg">' . Yii::$app->name . '</span>',
        Yii::$app->homeUrl,
        ['class' => 'logo']
    ); ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?php echo $directoryAsset; ?>/img/avatar5.png"
                             class="user-image"
                             alt="User Image"/>
                        <span class="hidden-xs"><?php echo Yii::$app->user->identity->username; ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?php echo $directoryAsset; ?>/img/avatar5.png" class="img-circle"
                                 alt="User Image"/>

                            <p>
                                <?php echo Yii::$app->user->identity->username; ?>
                                <small><?php echo date('D m Y'); ?></small>
                            </p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <?php echo Html::a(
                                    'Sign out',
                                    ['/site/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
