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
	
	$bColorJadwal='rgba(80, 150, 241, 1)';
	$gvAttjadwalInput=[
		[
			'class'=>'kartik\grid\SerialColumn',
			'contentOptions'=>['class'=>'kartik-sheet-style'],
			'width'=>'10px',
			//'header'=>tombolCreateHarga(),
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','30px',$bColorJadwal,'#ffffff'),
			'contentOptions'=>Yii::$app->gv->gvContainBody('center','30px',''),
		],
		//ACCESS_UNIX
		[
			'attribute'=>'ACCESS_UNIX',
			//'label'=>'Cutomer',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','50px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			//gvContainHeader($align,$width,$bColorJadwal)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','50px',$bColorJadwal),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','50px',''),
			
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
			//gvContainHeader($align,$width,$bColorJadwal)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','50px',$bColorJadwal),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','50px',''),
			
		],			
		//HARI
		[
			'attribute'=>'HARI',
			//'label'=>'Cutomer',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','50px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			//gvContainHeader($align,$width,$bColorJadwal)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','50px',$bColorJadwal),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','50px',''),
			
		]		
		,//JAM_MASUK
		[
			'attribute'=>'JAM_MASUK',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','50px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			//gvContainHeader($align,$width,$bColorJadwal)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','50px',$bColorJadwal),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','50px',''),			
		]			
		,//JAM_KELUAR
		[
			'attribute'=>'JAM_KELUAR',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','50px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			//gvContainHeader($align,$width,$bColorJadwal)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','50px',$bColorJadwal),
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
			//gvContainHeader($align,$width,$bColorJadwal)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','50px',$bColorJadwal),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','50px',''),			
		]	
	
	];

	$gvJadwalInput=GridView::widget([
		'id'=>'gv-jadwal-input',
		'dataProvider' => $dataProviderJadwal,
		'filterModel' => $searchModelJadwal,
		'columns'=>$gvAttjadwalInput,	
		'pjax'=>true,
		'pjaxSettings'=>[
			'options'=>[
				'enablePushState'=>false,
				'id'=>'gv-jadwal-input',
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

