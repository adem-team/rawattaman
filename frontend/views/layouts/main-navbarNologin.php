<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

// use frontend\assets\AppAssetSmoth;
// AppAssetSmoth::register($this);


    NavBar::begin([
        // 'brandLabel' => '		
			// <img src="http://ptrnov.net/img/ptrnov-putih.png" class="navbar-header page-scroll" style="width:170px; height:40px; margin-left:50px; margin-top:0px"/>
		// ',
		'brandLabel' => '<img src="https://web.rawattaman.int/img/logo.png" class="navbar-static-top" style="width:100px; height:80px; margin-left:20px; margin-top:-10px"/>',//.'<div class=" navbar-fixed-top pull-right" style="margin-left:20%; margin-top:10px; color:black"><h5>Under Maintenance !!</h5> </div>',//.'<div class=" navbar-fixed-top pull-right" style="margin-left:20%; margin-top:10px; color:black"><h5>info@lukison.com / Support: 021888888</h5> </div>',
							
        // 'brandLabel' =>'
			 // <div class="navbar-header page-scroll">                
                // <a class="navbar-brand" href="#page-top">RAWAT TAMAN</a>
            // </div>
		// ',
		'brandUrl' => Yii::$app->homeUrl,
        'options' => [
			'id'=>'mainNav',
           // 'class' => 'navbar-inverse navbar-fixed-top',
            //'class' => 'navbar navbar-default navbar-fixed-top navbar-custom',
			'class' =>  'navbar navbar-inverse navbar-static-top'
        ],
    ]);
	
	if (Yii::$app->user->isGuest) {
		// $menuItems[] = '<li class="hidden"> <a href="#page-top"></a></li>';
		// $menuItems[] = '<li class="page-scroll"> <a href="#home" id="home-controller">Home</a></li>';
		// $menuItems[] = '<li class="page-scroll"> <a href="#service" id="service-controller">Service</a></li>';
		// $menuItems[] = '<li class="page-scroll"> <a href="#help" id="help-controller">Help</a></li>';
		// $menuItems[] = '<li class="page-scroll"> <a href="#contact" id="contact-controller">Contact</a></li>'; 
        //$menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        //$menuItems[] = '<li class="page-scroll">  <a href="#signup-select" id="signup-controller">Signup</a></li>';
		//$menuItems[] = '<li class="page-scroll">  <a href="#login-select" id="login-controller">Login</a></li>';
	
        $menuItems[] = ['label' => '<div class="btn">LOGIN</div>', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
	?>
     <!--<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">!-->
	 <?php
		echo Nav::widget([
			'options' => ['class' => 'navbar-nav navbar-right'],
			'items' => $menuItems,
			//'activateParents' => true,
			'encodeLabels' => false,
		]);
	
	?>
	<!--</div>!-->
	<?php
    NavBar::end();
    ?>
	
	<?php
	$this->registerJs("
		//$('body').scrollspy({ target: '.navbar-fixed-top' })
	",$this::POS_READY);
	?>