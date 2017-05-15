<?php
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Url;

/**
* ===============================
 * Button Permission.
 * Modul ID	: 12
 * Author	: ptr.nov2gmail.com
 * Update	: 01/02/2017
 * Version	: 2.1
 * ===============================
*/
	$this->registerCss("
		/**
		 * CSS - Border radius Sudut.
		 * piter novian [ptr.nov@gmail.com].
		 * 'todolistOptions' => [
		 *		'backdrop' => FALSE, //Static=disable, false=enable
		 *		'keyboard' => TRUE,	// Kyboard 
		 *	]
		*/
		.modal-content { 
			border-radius: 5px;
		}
		button span {
		  pointer-events: none;  //Disable Span in Button.
		}
	");
		
	/*
	 * Button - todolist CREATE.
	*/
	function tombolCreatePayment(){
		// if(getPermission()){
			// if(getPermission()->BTN_CREATE==1){
				//$title1 = Yii::t('app', ' New');
				$url = Url::toRoute(['/master/payment/create']);
				$options1 = ['value'=>$url,
							'id'=>'button-payment-create',
							'class'=>"btn btn-default btn-xs"  
				];
				$icon1 = '
						<span class="fa-stack fa-sm text-justify">
						  <i class="fa fa-circle fa-stack-2x" style="color:#ffffff"></i>
						  <i class="fa fa-plus fa-stack-1x style="color:red"></i>
						</span>			
				';
				$label1 = $icon1 . ' ' ;//. $title1;
				$content = Html::button($label1,$options1);
				return $content;
			// }
		// }
	}
	
/**
* ===============================
 * Button & Link Modal item
 * Author	: ptr.nov2gmail.com
 * Update	: 21/01/2017
 * Version	: 2.1
 * ===============================
*/	
	/*
	 * MODAL - JADWAL CREATE.
	*/
	$HeaderColor_Todolist='rgba(80, 150, 241, 1)';//' rgba(74, 206, 231, 1)';
	$bgIconColor_Todolist='#f08f2e';
	Modal::begin([
		'id' => 'modal-payment-create',
		'header' => '
			<span class="fa-stack fa-xs">																	
				<i class="fa fa-circle fa-stack-2x " style="color:'.$bgIconColor_Todolist.'"></i>
				<i class="fa fa-plus fa-stack-1x" style="color:#fbfbfb"></i>
			</span><b> Tambahkan  Payment </b>
		',		
		'size' =>'modal-dm',
		'headerOptions'=>[
			'style'=> 'border-radius:5px; background-color:'.$HeaderColor_Todolist,
		],
		'clientOptions' => [
			'backdrop' => FALSE, //Static=disable, false=enable
			'keyboard' => TRUE,	// Kyboard 
		]
	]);
	echo "<div id='content-payment-create'></div>";
	Modal::end();
?>