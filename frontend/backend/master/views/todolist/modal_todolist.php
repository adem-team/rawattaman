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
	function tombolCreateTodolist(){
		// if(getPermission()){
			// if(getPermission()->BTN_CREATE==1){
				//$title1 = Yii::t('app', ' New');
				$url = Url::toRoute(['/master/todolist/create']);
				$options1 = ['value'=>$url,
							'id'=>'button-todolist-create',
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
					'value'=>url::to(['/master/todolist/update','id'=>$model->ID]),
					'id'=>'button-todolist-update',
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
	 * MODAL - TODOLIST CREATE.
	*/
	$HeaderColor_Todolist='rgba(133, 252, 89, 1)';//' rgba(74, 206, 231, 1)';
	$bgIconColor_Todolist='#f08f2e';
	Modal::begin([
		'id' => 'modal-todolist-create',
		'header' => '
			<span class="fa-stack fa-xs">																	
				<i class="fa fa-circle fa-stack-2x " style="color:'.$bgIconColor_Todolist.'"></i>
				<i class="fa fa-plus fa-stack-1x" style="color:#fbfbfb"></i>
			</span><b> Tambahkan Todolist </b>
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
	echo "<div id='content-todolist-create'></div>";
	Modal::end();
	
	/*
	 * MODAL - TODOLIST VIEW.
	*/
	$HeaderColor_Todolist='rgba(133, 252, 89, 1)';//' rgba(74, 206, 231, 1)';
	$bgIconColor_Todolist='#f08f2e';
	Modal::begin([
		'id' => 'modal-todolist-update',
		'header' => '
			<span class="fa-stack fa-xs">																	
				<i class="fa fa-circle fa-stack-2x " style="color:'.$bgIconColor_Todolist.'"></i>
				<i class="fa fa-plus fa-stack-1x" style="color:#fbfbfb"></i>
			</span><b> Edit Todolist </b>
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
	echo "<div id='content-todolist-update'></div>";
	Modal::end();
?>