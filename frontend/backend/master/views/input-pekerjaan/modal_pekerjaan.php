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
		 * 'clientOptions' => [
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
	 * Button - CLIENT CREATE.
	*/
	function tombolCreateClient(){
		// if(getPermission()){
			// if(getPermission()->BTN_CREATE==1){
				//$title1 = Yii::t('app', ' New');
				$url = Url::toRoute(['/master/input-pekerjaan/create-client']);
				$options1 = ['value'=>$url,
							'id'=>'button-client-create',
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
	 * Button - JADWAL CREATE.
	*/
	function tombolCreateJadwal($getAccessUnix){
		// if(getPermission()){
			// if(getPermission()->BTN_CREATE==1){
				//$title1 = Yii::t('app', ' New');
				$url = Url::toRoute(['/master/input-pekerjaan/create-jadwal','id'=>$getAccessUnix]);
				$options1 = ['value'=>$url,
							'id'=>'button-jadwal-create',
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
	 * Button - JADWAL CREATE.
	*/
	function tombolCreateRating($getAccessUnix){
		// if(getPermission()){
			// if(getPermission()->BTN_CREATE==1){
				//$title1 = Yii::t('app', ' New');
				$url = Url::toRoute(['/master/input-pekerjaan/create-rating','id'=>$getAccessUnix]);
				$options1 = ['value'=>$url,
							'id'=>'button-rating-create',
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
	 * Button - SET TO RATING.
	*/
	function tombolRating($url, $model){
		// if(getPermission()){
			//Jika BTN_CREATE Show maka BTN_CVIEW Show.
			// if(getPermission()->BTN_VIEW==1 OR getPermission()->BTN_CREATE==1){
				$title1 = Yii::t('app',' SetTo Rating');
				$options1 = [
					'value'=>url::toRoute(['/master/input-pekerjaan/create-rating','id'=>$model->ID]),
					'id'=>'button-rating-create',
					'class'=>"btn btn-default btn-xs",      
					'style'=>['text-align'=>'left','width'=>'100%', 'height'=>'25px','border'=> 'none'],
				];
				$icon1 = '
					<span class="fa-stack fa-sm text-justify">
						  <i class="fa fa-circle fa-stack-2x" style="color:yellow"></i>
						  <i class="fa fa-star-half-full fa-stack-1x style="color:#05944d"></i>
						</span>		
				'; 
				$icon2 = '
					<span class="fa-stack fa-sm text-justify">
						  <i class="fa fa-circle fa-stack-2x" style="color:red"></i>
						  <i class="fa fa-star-half-full fa-stack-1x style="color:#05944d"></i>
						</span>		
				'; 			
				$icon = $model->STATUS==1?$icon1:$icon2;
				$label1 = $icon . '  ' . $title1;
				$content = Html::button($label1,$options1);		
				return '<li>'.$content.'</li>';
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
	 * MODAL - CLIENT CREATE.
	*/
	$HeaderColor_Client='rgba(133, 240, 51, 1)';//' rgba(74, 206, 231, 1)';
	$bgIconColor_Client='#f08f2e';//kuning '#1eaac2';//biru Laut.
	Modal::begin([
		'id' => 'modal-client-create',
		'header' => '
			<span class="fa-stack fa-xs">																	
				<i class="fa fa-circle fa-stack-2x " style="color:'.$bgIconColor_Client.'"></i>
				<i class="fa fa-plus fa-stack-1x" style="color:#fbfbfb"></i>
			</span><b> Tambahkan Pengguna, New Client </b>
		',		
		'size' =>'modal-dm',
		'headerOptions'=>[
			'style'=> 'border-radius:5px; background-color:'.$HeaderColor_Client,
		],
		'clientOptions' => [
			'backdrop' => FALSE, //Static=disable, false=enable
			'keyboard' => TRUE,	// Kyboard 
		]
	]);
	echo "<div id='content-client-create'></div>";
	Modal::end();
	
	/*
	 * MODAL - JADWAL CREATE.
	*/
	$HeaderColor_Jadwal='rgba(80, 150, 241, 1)';//'rgba(175, 183, 164, 0.52)';//' rgba(74, 206, 231, 1)';
	$bgIconColor_Jadwal='#f08f2e';
	Modal::begin([
		'id' => 'modal-jadwal-create',
		'header' => '
			<span class="fa-stack fa-xs">																	
				<i class="fa fa-circle fa-stack-2x " style="color:'.$bgIconColor_Jadwal.'"></i>
				<i class="fa fa-plus fa-stack-1x" style="color:#fbfbfb"></i>
			</span><b> Tambahkan Jadwal Pekerjaan </b>
		',		
		'size' =>'modal-lg',
		'headerOptions'=>[
			'style'=> 'border-radius:5px; background-color:'.$HeaderColor_Jadwal,
		],
		'clientOptions' => [
			'backdrop' => FALSE, //Static=disable, false=enable
			'keyboard' => TRUE,	// Kyboard 
		]
	]);
	echo "<div id='content-jadwal-create'></div>";
	Modal::end();	
	
	/*
	 * MODAL - RATING CREATE.
	*/
	$HeaderColor_Rating='rgba(133, 240, 51, 1)';//' rgba(74, 206, 231, 1)';
	$bgIconColor_Rating='#f08f2e';//kuning '#1eaac2';//biru Laut.
	Modal::begin([
		'id' => 'modal-rating-create',
		'header' => '
			<span class="fa-stack fa-xs">																	
				<i class="fa fa-circle fa-stack-2x " style="color:'.$bgIconColor_Rating.'"></i>
				<i class="fa fa-plus fa-stack-1x" style="color:#fbfbfb"></i>
			</span><b> Tambahkan Pekerjaan </b>
		',		
		'size' =>'modal-lg',
		'headerOptions'=>[
			'style'=> 'border-radius:5px; background-color:'.$HeaderColor_Rating,
		],
		'clientOptions' => [
			'backdrop' => FALSE, //Static=disable, false=enable
			'keyboard' => TRUE,	// Kyboard 
		]
	]);
	echo "<div id='content-rating-create'></div>";
	Modal::end();
?>