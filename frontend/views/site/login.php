<?php
require('index_nologin.php');
use yii\helpers\Html;
use kartik\icons\Icon;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
/* $this->registerCss("div#modal_login{ padding-right: 11000%;
												}"); */
//use kartik\widgets\FileInput;
//echo $pk_emp.'ok';

	$title1 = Yii::t('app','Set Password');
	$options1 = [ //'id'=>'password',
				 // '/data-toggle'=>"modal",
				 // 'data-target'=>"#ubah-password-modal",
				  'class' => 'btn btn-primary',
				 // 'style' => 'text-align:left',
	];
	$icon1 = '<span class="fa fa-shield fa-md"></span>';
	$label1 = $icon1 . ' ' . $title1;
	$url1 = Url::toRoute(['/site/ubah-password']);
	$content = Html::a($label1,$url1, $options1);
?>
<!-- <div class="col-md-3 col-md-offset-5" style="margin-top: 10px"> !-->


<?php
    Modal::begin([
        'id' => 'modal_login',
        'header' => '<img src="http://lukisongroup.com/login_icon1.png" style="width:70px; height:50px"/>' ,
		'size' => 'modal-sm',
        'options' => ['class'=>'slide'],
		'headerOptions'=>[
			//'style'=> 'border-radius:5px; background-color:rgba(230, 251, 225, 1);'
			//'style'=> 'border-radius:5px; background-color:rgba(61, 235, 64, 1);'
			'style'=> 'border-radius:5px; background-color:rgba(110, 226, 126, 1);'
		], 
		/* 'options'=>[
			'style'=> 'display:bloack;padding-right:270px;'
		] */
	
    ]);
		$form = ActiveForm::begin([
			'id' => 'login-form',
			'action'=>'/site/login'
		]); 
			echo $form->field($model, 'username')->textInput();
			echo $form->field($model, 'password')->passwordInput();
			echo Html::submitButton('Login', ['class' => 'btn btn-lg btn-success btn-block',	 'name' => 'login-button']);
		ActiveForm::end();
	Modal::end();	
?>





