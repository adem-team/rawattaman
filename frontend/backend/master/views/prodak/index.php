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
	#gv-product .panel {
		height: 500px;
	}
	
	/*Change Panel Color*/
	#gv-product .panel-default > .panel-heading {
	  color: #333;
	  background-color: rgba(206, 137, 235, 1);
	  border-color: #ddd;
	}
");
$this->registerJs($this->render('modal_produk.js'),View::POS_READY);
//$this->registerJs($this->render('tabx.js'),View::POS_READY);
echo $this->render('modal_produk'); //echo difinition

	$aryStt= [
		  ['STATUS' => 0, 'STT_NM' => 'DISABLE'],		  
		  ['STATUS' => 1, 'STT_NM' => 'ENABLE']
	];	
	$valStt = ArrayHelper::map($aryStt, 'STATUS', 'STT_NM');
	$bColor='rgba(87,114,111, 1)';
	
	$pageTitleProdak='<span class="fa-stack fa-xs text-right" style="color:red">				  
				  <i class="fa fa-share fa-1x"></i>
				</span> <b>List Prodak </b>
	';

	$bColorProdak='rgba(87,114,111, 1)';
	$gvAttProduct=[
		[
			'class'=>'kartik\grid\SerialColumn',
			'contentOptions'=>['class'=>'kartik-sheet-style'],
			'width'=>'10px',
			'header'=>'No.',
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','30px',$bColorProdak,'#ffffff'),
			'contentOptions'=>Yii::$app->gv->gvContainBody('center','30px',''),
		],
		//PRODAK_NAME
		[
			'attribute'=>'PRODAK_NAME',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','100px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','100px',$bColorProdak),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','100px',''),
			
		],	
		//KETERANGAN
		[
			'attribute'=>'KETERANGAN',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','250px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','250px',$bColorProdak),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','250px',''),
			
		]	
		,//HARGA
		[
			'attribute'=>'HARGA',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','50px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','50px',$bColorProdak),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','50px',''),
			
		]	
		,//DISCOUNT
		[
			'attribute'=>'DISCOUNT',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','50px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','50px',$bColorProdak),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','50px',''),			
		]			
		,
		//SHARE_PROFIT
		[
			'attribute'=>'SHARE_PROFIT',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','50px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			//gvContainHeader($align,$width,$bColorProdak)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','50px',$bColorProdak),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','50px',''),			
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
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','50px'),
			'hAlign'=>'right',
			'vAlign'=>'top',
			'mergeHeader'=>false,
			'noWrap'=>false,
			'format' => 'raw',	
			'value'=>function($model){
				 if ($model->STATUS == 0) {
				   return Html::decode('<span class="fa-stack fa-xl">
							  <i class="fa fa-circle-thin fa-stack-2x"  style="color:#25ca4f"></i>
							  <i class="fa fa-remove fa-stack-1x" style="color:#ee0b0b"></i>
							</span> Disable','',['title'=>'Disable']);
				} else if ($model->STATUS == 1) {
					return Html::decode('<span class="fa-stack fa-xl">
							  <i class="fa fa-circle-thin fa-stack-2x"  style="color:#25ca4f"></i>
							  <i class="fa fa-check fa-stack-1x" style="color:#01190d"></i>
							</span> Enable','',['title'=>'Enable']);
				}
			},
			//gvContainHeader($align,$width,$bColor)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','50',$bColor),
			'contentOptions'=>Yii::$app->gv->gvContainBody('center','50','')			
		],
		//ACTION
		[
			'class' => 'kartik\grid\ActionColumn',
			'template' => '{view}',
			'header'=>'ACTION',
			'dropdown' => false,
			// 'dropdownOptions'=>[
				// 'class'=>'pull-right dropdown',
				// 'style'=>'width:60px;background-color:#E6E6FA'				
			// ],
			// 'dropdownButton'=>[
				// 'label'=>'ACTION',
				// 'class'=>'btn btn-default btn-xs',
				// 'style'=>'width:100%;'		
			// ],
			'buttons' => [
				'view' =>function ($url, $model){
					return  tombolView($url, $model);
				},
			],
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','10px',$bColor,'#ffffff'),
			'contentOptions'=>Yii::$app->gv->gvContainBody('center','10px',''),
		]
	];

	$gvProduct=GridView::widget([
		'id'=>'gv-product',
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns'=>$gvAttProduct,	
		'pjax'=>true,
		'pjaxSettings'=>[
			'options'=>[
				'enablePushState'=>false,
				'id'=>'gv-product',
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
			'heading'=>$pageTitleProdak .' '.tombolCreateProduk(),
			//'type'=>'info',
			'before'=>false,
			'footer'=>false,			
		],
		'summary'=>false,
		// 'floatOverflowContainer'=>true,
		// 'floatHeader'=>true,
	]); 
	
	
?>
<div class="container-fluid" style="font-family: verdana, arial, sans-serif ;font-size: 8pt">
	<div class="col-xs-12 col-sm-12 col-lg-12" style="font-family: tahoma ;font-size: 9pt;">
			<?=$gvProduct?>
	</div>
</div>