<?php
use yii\helpers\Html;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use kartik\widgets\FileInput;
use yii\helpers\Json;
use yii\web\Response;
use yii\widgets\Pjax;
use kartik\widgets\ActiveForm;
use yii\web\View;
use yii\web\Request;
use yii\db\ActiveRecord;
use yii\data\ArrayDataProvider;
use kartik\detail\DetailView;
use kartik\widgets\ActiveField;
	$aryStt= [
			  ['STATUS' => 0, 'STT_NM' => 'Disable'],		  
			  ['STATUS' => 1, 'STT_NM' => 'Enable'],
		];	
	$valStt = ArrayHelper::map($aryStt, 'STATUS', 'STT_NM');
	
	function sttMsg($stt){
		if($stt==0){
			 return Html::decode('<span class="fa-stack fa-xl">
					  <i class="fa fa-circle-thin fa-stack-2x"  style="color:#25ca4f"></i>
					  <i class="fa fa-remove fa-stack-1x" style="color:#ee0b0b"></i>
					</span> Disable','',['title'=>'Disable']);
		}elseif($stt==1){
			return Html::decode('<span class="fa-stack fa-xl">
					  <i class="fa fa-circle-thin fa-stack-2x"  style="color:#25ca4f"></i>
					  <i class="fa fa-check fa-stack-1x" style="color:#01190d"></i>
					</span> Enable','',['title'=>'Enable']);
		}elseif($stt==3){
			return Html::decode('<span class="fa-stack fa-xl">
					  <i class="fa fa-circle-thin fa-stack-2x"  style="color:#25ca4f"></i>
					  <i class="fa fa-close fa-stack-1x" style="color:#ee0b0b"></i>
					</span> Delete','',['title'=>'Delete']);
		}
	};	
	
	$dvAttTodolist=[
		[ 	
			'attribute' =>'LIST_NAME',
			'type'=>DetailView::INPUT_TEXT,			
			'displayOnly'=>true,
			'labelColOptions'=>['style'=>'width:5px;font-family: tahoma ;font-size: 8pt;'], 
		],	
		[
			'attribute'=>'KETERANGAN', 
			'displayOnly'=>false,
			'labelColOptions'=>['style'=>'width:160px;font-family: tahoma ;font-size: 8pt;'], 
		],
		[
			'attribute'=>'STATUS', 
			'format'=>'raw',
			'type'=>DetailView::INPUT_SELECT2,
			'value'=>sttMsg($model->STATUS),
			'widgetOptions'=>[
				'data'=>$valStt,
				'options'=>['id'=>'provinsi-review-store-id','placeholder'=>'Select ...'],
				'pluginOptions'=>['allowClear'=>true],
			],	
			'labelColOptions'=>['style'=>'width:160px; font-family: tahoma ;font-size: 8pt;'], 		
			'displayOnly'=>false
		],
	];
	
	$dvTodolist=DetailView::widget([
		'id'=>'dv-todolist-view',
		'model' => $model,
		'attributes'=>$dvAttTodolist,
		'condensed'=>true,
		'hover'=>true,
		'panel'=>[
			'heading'=>'<div style="float:left;margin-right:10px" class="fa fa-1x fa-list-alt"></div><div><h6 class="modal-title"><b> View/Edit Todolist</b></h6></div>',
			'type'=>DetailView::TYPE_INFO,
		],
		'buttons1'=>'{update}',
		'buttons2'=>'{view}{save}'
		
	]);
?>

<?=$dvTodolist?>

