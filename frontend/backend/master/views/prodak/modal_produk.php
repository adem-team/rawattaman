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
		 * 'produkOptions' => [
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
	 * Button - produk CREATE.
	*/
	function tombolCreateProduk(){
		// if(getPermission()){
			// if(getPermission()->BTN_CREATE==1){
				//$title1 = Yii::t('app', ' New');
				$url = Url::toRoute(['/master/prodak/create-produk']);
				$options1 = ['value'=>$url,
							'id'=>'button-produk-create',
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
	
	/*
	 * Row Button - VIEW.
	*/
	function tombolView($url, $model){
		// if(getPermission()){
			//Jika BTN_CREATE Show maka BTN_CVIEW Show.
			// if(getPermission()->BTN_VIEW==1 OR getPermission()->BTN_CREATE==1){
				$title1 = Yii::t('app',' View');
				$options1 = [
					'value'=>url::to(['/master/prodak/update','id'=>$model->ID]),
					'id'=>'button-prodak-update',
					'class'=>"btn btn-default btn-xs",      
					
				];
				$icon1 = '
					<span class="fa-stack fa-xs">																	
						<i class="fa fa-circle fa-stack-2x " style="color:#f08f2e"></i>
						<i class="fa fa-eye fa-stack-1x" style="color:#fbfbfb"></i>
					</span>
				';      
				$label1 = $icon1 . '  ' . $title1;
				$content = Html::button($label1,$options1);		
				//return '<li>'.$content.'</li>';
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
	 * MODAL - PRODUK CREATE.
	*/
	$HeaderColor_Produk='rgba(206, 137, 235, 1)';//' rgba(74, 206, 231, 1)';
	$bgIconColor_Produk='#f08f2e';
	Modal::begin([
		'id' => 'modal-produk-create',
		'header' => '
			<span class="fa-stack fa-xs">																	
				<i class="fa fa-circle fa-stack-2x " style="color:'.$bgIconColor_Produk.'"></i>
				<i class="fa fa-plus fa-stack-1x" style="color:#fbfbfb"></i>
			</span><b> Tambahkan Produk </b>
		',		
		'size' =>'modal-dm',
		'headerOptions'=>[
			'style'=> 'border-radius:5px; background-color:'.$HeaderColor_Produk,
		],
		'clientOptions' => [
			'backdrop' => FALSE, //Static=disable, false=enable
			'keyboard' => TRUE,	// Kyboard 
		]
	]);
	echo "<div id='content-produk-create'></div>";
	Modal::end();
	
	/*
	 * MODAL - VIEW CREATE.
	*/
	$HeaderColor_Produk='rgba(206, 137, 235, 1)';//' rgba(74, 206, 231, 1)';
	$bgIconColor_Produk='#f08f2e';
	Modal::begin([
		'id' => 'modal-produk-update',
		'header' => '
			<span class="fa-stack fa-xs">																	
				<i class="fa fa-circle fa-stack-2x " style="color:'.$bgIconColor_Produk.'"></i>
				<i class="fa fa-plus fa-stack-1x" style="color:#fbfbfb"></i>
			</span><b> Update Produk </b>
		',		
		'size' =>'modal-dm',
		'headerOptions'=>[
			'style'=> 'border-radius:5px; background-color:'.$HeaderColor_Produk,
		],
		'clientOptions' => [
			'backdrop' => FALSE, //Static=disable, false=enable
			'keyboard' => TRUE,	// Kyboard 
		]
	]);
	echo "<div id='content-produk-update'></div>";
	Modal::end();
?>