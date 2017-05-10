<?php
use yii\helpers\Html;
use kartik\widgets\Select2;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\widgets\Breadcrumbs;
use kartik\widgets\Spinner;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use kartik\widgets\FileInput;
use yii\helpers\Json;
use yii\web\Response;
use yii\widgets\Pjax;
use kartik\widgets\ActiveForm;
use kartik\tabs\TabsX;
use kartik\date\DatePicker;
use yii\web\View;
use yii\web\Request;
use kartik\detail\DetailView;

	$attViewProfile=[
		//INFO
		[	
			'group'=>true,
			'label'=>'Info',
			'rowOptions'=>['class'=>'success'],
			'groupOptions'=>['class'=>'text-left'] 			
		],
		[ 	
			'attribute' =>'ACCESS_UNIX',
			'type'=>DetailView::INPUT_TEXT,			
			'displayOnly'=>true,
			'labelColOptions'=>['style'=>'width:5px;font-family: tahoma ;font-size: 8pt;'], 
		],	
		[
			'attribute'=>'NM_DEPAN', 
			'displayOnly'=>false,
			'labelColOptions'=>['style'=>'width:160px;font-family: tahoma ;font-size: 8pt;'], 
		],
		[
			'attribute'=>'NM_TENGAH', 
			'labelColOptions'=>['style'=>'width:160px; font-family: tahoma ;font-size: 8pt;'], 
			'displayOnly'=>false
		],	
		[
			'attribute'=>'NM_BELAKANG', 
			'labelColOptions'=>['style'=>'width:160px; font-family: tahoma ;font-size: 8pt;'], 
			'displayOnly'=>false
		],
		[
			'attribute'=>'EMAIL', 
			'labelColOptions'=>['style'=>'width:160px; font-family: tahoma ;font-size: 8pt;'], 
			'displayOnly'=>false
		],
		[
			'attribute'=>'HP', 
			'labelColOptions'=>['style'=>'width:160px; font-family: tahoma ;font-size: 8pt;'], 
			'displayOnly'=>false
		],
		//IDENTITAS
		[	
			'group'=>true,
			'label'=>'Identitas',
			'rowOptions'=>['class'=>'success'],
			'groupOptions'=>['class'=>'text-left'] 			
		],
		[ 	
			'attribute' =>'KTP',
			'type'=>DetailView::INPUT_TEXT,			
			'displayOnly'=>true,
			'labelColOptions'=>['style'=>'width:5px;font-family: tahoma ;font-size: 8pt;'], 
		],	
		[ 	
			'attribute' =>'LAHIR_TEMPAT',
			'type'=>DetailView::INPUT_TEXT,			
			'displayOnly'=>true,
			'labelColOptions'=>['style'=>'width:5px;font-family: tahoma ;font-size: 8pt;'], 
		],	
		[ 	
			'attribute' =>'LAHIR_TGL',
			'type'=>DetailView::INPUT_TEXT,			
			'displayOnly'=>true,
			'labelColOptions'=>['style'=>'width:5px;font-family: tahoma ;font-size: 8pt;'], 
		],	
		[ 	
			'attribute' =>'LAHIR_GENDER',
			'type'=>DetailView::INPUT_TEXT,			
			'displayOnly'=>true,
			'labelColOptions'=>['style'=>'width:5px;font-family: tahoma ;font-size: 8pt;'], 
		],	
		//PRODUCT
		[	
			'group'=>true,
			'label'=>'Prodak',
			'rowOptions'=>['class'=>'danger'],
			'groupOptions'=>['class'=>'text-left'] 			
		],
		[ 	
			'attribute' =>'LUAS_TANAH',
			'type'=>DetailView::INPUT_TEXT,			
			'displayOnly'=>true,
			'labelColOptions'=>['style'=>'width:5px;font-family: tahoma ;font-size: 8pt;'], 
		],	
		
		
	];

	$dvViewProvile=DetailView::widget([
		'id'=>'dv-profile',
		'model' => $modelProfile,
		'attributes'=>$attViewProfile,
		'condensed'=>true,
		'hover'=>true,
		'panel'=>[
					'heading'=>'<div style="float:left;margin-right:10px" class="fa fa-1x fa-list-alt"></div><div><h6 class="modal-title"><b> User Profile</b></h6></div>',
					'type'=>DetailView::TYPE_INFO,
				],
		'saveOptions'=>[ 
			'id' =>'saveBtn',
			//'value'=>'/master/customers/viewcust?id='.$model->CUST_KD,
			'params' => ['custom_param' => true],
		],	
		
	]);	

?>
<?=$dvViewProvile?>

