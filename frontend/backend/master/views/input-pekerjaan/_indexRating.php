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
use yii\db\ActiveRecord;
use yii\data\ArrayDataProvider;
use kartik\detail\DetailView;
$this->registerCss("
	#gv-rating .kv-grid-table :link {
		color: #fdfdfd;
	}
	// mouse over link 
	a:hover {
		color: #5a96e7;
	}
	//selected link 
	a:active {
		color: blue;
	}
	/* HEIGHT PANEL*/
	#gv-rating .panel {
		height: 500px;
	}
	/* CONTINER HIGHT */
	#gv-rating .kv-grid-container{
		height: 500px;
	}
	/* PANEL COLOR */
	/* #gv-product .panel-default > .panel-heading {
	  color: #333;
	  background-color: rgba(206, 137, 235, 1);
	  border-color: #ddd;
	} */
");

	/* $attViewFharga=[	
		[
			'columns' => [
				[
					'attribute'=>'ITEM_ID', 
					'label'=>'ITEM_ID',
					//'value'=> $dataProvider[0]['ITEM_ID'],
					'displayOnly'=>true,
					'valueColOptions'=>['style'=>'width:30%;font-family: tahoma ;font-size: 8pt;'], 
					'labelColOptions'=>['style'=>'width:130px;font-family: tahoma ;font-size: 8pt;'], 
				],
				[
					'attribute'=>'OUTLET_CODE', 
					'format'=>'raw',
					'label'=>'START TIME',
					'valueColOptions'=>['style'=>'font-family: tahoma ;font-size: 8pt;'], 
					'labelColOptions'=>['style'=>'width:130px; font-family: tahoma ;font-size: 8pt;'], 
					'displayOnly'=>true
				],
			],
		],
		[
			'columns' => [
				[
					'attribute'=>'ITEM_NM', 
					'label'=>'SALES ACCESS_UNIX',
					'valueColOptions'=>['style'=>'width:30%;font-family: tahoma ;font-size: 8pt;'], 
					'labelColOptions'=>['style'=>'width:130px;font-family: tahoma ;font-size: 8pt;'], 
					'displayOnly'=>true
				],
				[
					'attribute'=>'SATUAN',
					'format'=>'raw',
					'label'=>'END TIME',
					'valueColOptions'=>['style'=>'font-family: tahoma ;font-size: 8pt;'], 
					'labelColOptions'=>['style'=>'width:130px;font-family: tahoma ;font-size: 8pt;'], 
					'displayOnly'=>true
				],
			],
		]			
	];

	$dvViewFharga=DetailView::widget([
		'id'=>'dv-fharga-view',
		'model' => $modelItemInfo,
		'attributes'=>$attViewFharga,
		'condensed'=>true,
		'hover'=>true,
		// 'panel'=>false,
		// 'mode'=>DetailView::MODE_VIEW,
		
	]); */
	
	$bColorRating='rgba(80, 150, 241, 1)';
	$gvAttrating=[
		[
			'class'=>'kartik\grid\SerialColumn',
			'contentOptions'=>['class'=>'kartik-sheet-style'],
			'width'=>'10px',
			'header'=>'No.',
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','30px',$bColorRating,'#ffffff'),
			'contentOptions'=>Yii::$app->gv->gvContainBody('center','30px',''),
		],
		//TGL
		[
			'attribute'=>'TGL',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','50px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','50px',$bColorRating),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','50px',''),
			
		],	
		//ACCESS_UNIX
		[
			'attribute'=>'ACCESS_UNIX',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','50px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','50px',$bColorRating),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','50px',''),
			
		]	
		,//JADWAL_ID
		[
			'attribute'=>'JADWAL_ID',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','50px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','50px',$bColorRating),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','50px',''),
			
		]	
		,//ID_PEKERJA
		[
			'attribute'=>'ID_PEKERJA',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','50px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','50px',$bColorRating),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','50px',''),			
		]			
		,
		//JAM_MASUK
		[
			'attribute'=>'JAM_MASUK',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','50px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			//gvContainHeader($align,$width,$bColorRating)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','50px',$bColorRating),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','50px',''),			
		],
		//JAM_KELUAR
		[
			'attribute'=>'JAM_KELUAR',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','50px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			//gvContainHeader($align,$width,$bColorRating)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','50px',$bColorRating),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','50px',''),			
		],
		//NILAI
		[
			'attribute'=>'NILAI',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','50px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','50px',$bColorRating),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','50px',''),			
		]
		,//STATUS
		[
			'attribute'=>'STATUS',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','50px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			//gvContainHeader($align,$width,$bColorRating)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','50px',$bColorRating),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','50px',''),			
		]	
	
	];

	$gvJadwalInput=GridView::widget([
		'id'=>'gv-rating',
		'dataProvider' => $dataProviderRating,
		'filterModel' => $searchModelRating,
		'columns'=>$gvAttrating,	
		'pjax'=>true,
		'pjaxSettings'=>[
			'options'=>[
				'enablePushState'=>false,
				'id'=>'gv-rating',
		    ],						  
		],
		'hover'=>true, //cursor select
		'responsive'=>true,
		'responsiveWrap'=>true,
		'bordered'=>true,
		'striped'=>true,
		'autoXlFormat'=>true,
		'export' => false,		
		'toolbar' => false,
		'panel'=>[
			//'heading'=>$dvViewFharga.'<style="',
			'type'=>'info',
			'before'=>false,
			'footer'=>false,			
		],
		'summary'=>false,
		'floatOverflowContainer'=>true,
		'floatHeader'=>true,
	]); 
	
	
?>


<?=$gvJadwalInput?>

