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

$this->title = 'Prodaks';
$this->params['breadcrumbs'][] = $this->title;

$this->registerCss("
	.kv-grid-table
	:link {
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
	/*Change Panel Color*/
	#gv-PayStatus .panel-default > .panel-heading {
		color: #333;
		background-color: rgba(133, 252, 89, 1);
		border-color: #ddd;
	}
");
	$pagePayStatus='<span class="fa-stack fa-xs text-right" style="color:red">				  
				  <i class="fa fa-share fa-1x"></i>
				</span> <b>PayStatus </b>
	';

	$bColorPayStatus='rgba(87,114,111, 1)';
	$gvAttPayStatus=[
		[
			'class'=>'kartik\grid\SerialColumn',
			'contentOptions'=>['class'=>'kartik-sheet-style'],
			'width'=>'10px',
			'header'=>'No.',
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','30px',$bColorPayStatus,'#ffffff'),
			'contentOptions'=>Yii::$app->gv->gvContainBody('center','30px',''),
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
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','50px',$bColorPayStatus),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','50px',''),
			
		],	
		//PRODAK_ID
		[
			'attribute'=>'PRODAK_ID',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','50px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','50px',$bColorPayStatus),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','50px',''),
			
		]	
		,//KETERANGAN
		[
			'attribute'=>'KETERANGAN',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','50px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','50px',$bColorPayStatus),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','50px',''),
			
		]	
		,//JUMLAH_BAYAR
		[
			'attribute'=>'JUMLAH_BAYAR',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','50px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','50px',$bColorPayStatus),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','50px',''),			
		]			
		,
		//STATUS
		[
			'attribute'=>'STATUS',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','50px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			//gvContainHeader($align,$width,$bColorPayStatus)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','50px',$bColorPayStatus),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','50px',''),			
		]
	];

	$gvPayStatus=GridView::widget([
		'id'=>'gv-pay-status',
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns'=>$gvAttPayStatus,	
		'pjax'=>true,
		'pjaxSettings'=>[
			'options'=>[
				'enablePushState'=>false,
				'id'=>'gv-pay-status',
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
			'heading'=>$pagePayStatus,
			//'type'=>'',
			'before'=>false,
			'footer'=>false,			
		],
		'summary'=>false,
	]); 
	
	
?>
<div class="container-fluid" style="font-family: verdana, arial, sans-serif ;font-size: 8pt">
	<div class="col-xs-12 col-sm-12 col-lg-12" style="font-family: tahoma ;font-size: 9pt;">
			<?=$gvPayStatus?>
	</div>
</div>