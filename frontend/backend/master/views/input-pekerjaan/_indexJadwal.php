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
use kartik\widgets\TimePicker;
$this->registerCss("
	.kv-grid-table :link {
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
	#gv-jadwal-input .panel {
		height: 500px;
	}
	/* CONTINER HIGHT */
	#gv-jadwal-input .kv-grid-container{
		height: 500px;
	}
	/* PANEL COLOR */
	#gv-product .panel-default > .panel-heading {
	  color: #333;
	  background-color: rgba(206, 137, 235, 1);
	  border-color: #ddd;
	}
");

	$aryStt= [
	  ['STATUS' => 0, 'STT_NM' => 'PLAN'],		  
	  ['STATUS' => 1, 'STT_NM' => 'PROGRESS'],
	  ['STATUS' => 2, 'STT_NM' => 'FINISH'],
	];	
	$valStt = ArrayHelper::map($aryStt, 'STATUS', 'STT_NM');
	//Result Status value.
	function sttMsg($stt){
		if($stt==0){ //TRIAL
			 return Html::a('<span class="fa-stack fa-xl">
					  <i class="fa fa-circle-thin fa-stack-2x"  style="color:#25ca4f"></i>
					  <i class="fa fa-check fa-stack-1x" style="color:#ee0b0b"></i>
					</span>','',['title'=>'PLAN']);
		}elseif($stt==1){
			 return Html::a('<span class="fa-stack fa-xl">
					  <i class="fa fa-circle-thin fa-stack-2x"  style="color:#25ca4f"></i>
					  <i class="fa fa-check fa-stack-1x" style="color:#05944d"></i>
					</span>','',['title'=>'PROGRESS']);
		}elseif($stt==2){
			return Html::a('<span class="fa-stack fa-xl">
					  <i class="fa fa-circle-thin fa-stack-2x"  style="color:#25ca4f"></i>
					  <i class="fa fa-remove fa-stack-1x" style="color:#01190d"></i>
					</span>','',['title'=>'FINISH']);
		}
	};
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
			'attribute'=>'ClientNm',
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
		[
			'attribute'=>'ACCESS_UNIX',
			//'label'=>'Cutomer',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','40px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			//gvContainHeader($align,$width,$bColorJadwal)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','40px',$bColorJadwal),
			'contentOptions'=>Yii::$app->gv->gvContainBody('center','40px',''),
			
		],
		//TGL
		[
			'attribute'=>'TGL',
			'filterType'=>GridView::FILTER_DATE,
			'filterWidgetOptions'=>[
				'pluginOptions' =>Yii::$app->gv->gvPliginDate(),
				'layout'=>'{picker}{remove}{input}'
			],
			'filter'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','50px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			//gvContainHeader($align,$width,$bColorJadwal)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','50px',$bColorJadwal),
			'contentOptions'=>Yii::$app->gv->gvContainBody('center','50px',''),
			
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
			'filterType'=>GridView::FILTER_DATETIME,
			'filterWidgetOptions'=>[
				'name'=>'jam-masuk',
				'pluginOptions' => [
					'calendarWeeks' => false,
					'autoclose' => true,
					'format' => 'hh:ii'
				]
			],			
			'filter'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','50px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			//gvContainHeader($align,$width,$bColorJadwal)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','50px',$bColorJadwal),
			'contentOptions'=>Yii::$app->gv->gvContainBody('center','50px',''),			
		]			
		,//JAM_KELUAR
		[
			'attribute'=>'JAM_KELUAR',
			'filterType'=>GridView::FILTER_DATETIME,
			'filterWidgetOptions'=>[
				'name'=>'jam-keluar',
				'pluginOptions' => [
					'calendarWeeks' => false,
					'autoclose' => true,
					'format' => 'hh:ii'
				]
			],			
			'filter'=>true,
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			//gvContainHeader($align,$width,$bColorJadwal)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','50px',$bColorJadwal),
			'contentOptions'=>Yii::$app->gv->gvContainBody('center','50px',''),			
		]
		,//STATUS
		[
			'attribute'=>'STATUS',
			'filterType'=>GridView::FILTER_SELECT2,
			'filterWidgetOptions'=>[
				'pluginOptions' =>Yii::$app->gv->gvPliginSelect2(),
			],
			'filterInputOptions'=>['placeholder'=>'Select'],
			'filter'=>$valStt,//Yii::$app->gv->gvStatusArray(),
			'format' => 'raw',	
			'value'=>function($model){
				return sttMsg($model->STATUS);				 
			},
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			//gvContainHeader($align,$width,$bColorJadwal)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','50px',$bColorJadwal),
			'contentOptions'=>Yii::$app->gv->gvContainBody('center','50px',''),			
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

