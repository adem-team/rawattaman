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
use kartik\widgets\ActiveField;

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
	#gv-karyawan .kv-grid-wrapper {
		position: relative;
		overflow: auto;
		height: 500px;
	}
	
	/* #gv-karyawan .panel {
		height: 500px;
	} */
	
	/*Change Panel Color*/
	#gv-karyawan .panel-default > .panel-heading {
	  color: #333;
	  background-color: rgba(83, 224, 234, 1);
	  border-color: #ddd;
	}
");


$this->registerJs($this->render('modal_pekerja.js'),View::POS_READY);
echo $this->render('modal_pekerja'); //echo difinition

	$pageTitleKaryawan='<span class="fa-stack fa-xs text-right" style="color:red">				  
				  <i class="fa fa-share fa-1x"></i>
				</span> <b>Data Pekerja </b>
	';

	$bColorKaryawan='rgba(87,114,111, 1)';
	$gvAttKaryawan=[
		[
			'class'=>'kartik\grid\SerialColumn',
			'contentOptions'=>['class'=>'kartik-sheet-style'],
			'width'=>'10px',
			'header'=>'No.',
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','30px',$bColorKaryawan,'#ffffff'),
			'contentOptions'=>Yii::$app->gv->gvContainBody('center','30px',''),
		],
		//ID_PEKERJA
		[
			'attribute'=>'ID_PEKERJA',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','50px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','50px',$bColorKaryawan),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','50px',''),
			
		],	
		//NAMA
		[
			'attribute'=>'NAMA',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','50px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','50px',$bColorKaryawan),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','50px',''),
			
		]	
	];

	$gvKaryawan=GridView::widget([
		'id'=>'gv-karyawan',
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns'=>$gvAttKaryawan,	
		'rowOptions'   => function ($model, $key, $index, $grid) {
			return ['id' => $model->ID_PEKERJA,'onclick' => '
					$.pjax.reload({
						url: "'.Url::to(['/master/pekerja']).'?id="+this.id,
						container:"#dv-karyawan"
					});
									
			'];
		},	 
		'pjax'=>true,
		'pjaxSettings'=>[
			'options'=>[
				'enablePushState'=>false,
				'id'=>'gv-karyawan',
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
			'heading'=>$pageTitleKaryawan. ' ' . tombolCreatePekerja(),
			//'type'=>'info',
			'before'=>false,
			'footer'=>false,			
		],
		'summary'=>false,
		'floatOverflowContainer'=>true,
		'floatHeader'=>true,
	]); 
	
	$dvAttKaryawan=[
		//Identitas
		[	
			'group'=>true,
			'label'=>'Identitas',
			'rowOptions'=>['class'=>'success'],
			'groupOptions'=>['class'=>'text-left'] 			
		],
		[ 	
			'attribute' =>'ID_PEKERJA',
			'type'=>DetailView::INPUT_TEXT,			
			'displayOnly'=>true,
			'labelColOptions'=>['style'=>'width:5px;font-family: tahoma ;font-size: 8pt;'], 
		],	
		[
			'attribute'=>'NAMA', 
			'displayOnly'=>false,
			'labelColOptions'=>['style'=>'width:160px;font-family: tahoma ;font-size: 8pt;'], 
		],
		[
			'attribute'=>'KTP', 
			'labelColOptions'=>['style'=>'width:160px; font-family: tahoma ;font-size: 8pt;'], 
			'displayOnly'=>false
		],	
		[
			'attribute'=>'TGL_LAHIR', 
			'labelColOptions'=>['style'=>'width:160px; font-family: tahoma ;font-size: 8pt;'], 
			'displayOnly'=>false
		],
		[
			'attribute'=>'GENDER', 
			'labelColOptions'=>['style'=>'width:160px; font-family: tahoma ;font-size: 8pt;'], 
			'displayOnly'=>false
		],
		[
			'attribute'=>'ALAMAT', 
			'labelColOptions'=>['style'=>'width:160px; font-family: tahoma ;font-size: 8pt;'], 
			'displayOnly'=>false
		],	
		[
			'attribute'=>'HP', 
			'labelColOptions'=>['style'=>'width:160px; font-family: tahoma ;font-size: 8pt;'], 
			'displayOnly'=>false
		],
		[
			'attribute'=>'EMAIL', 
			'labelColOptions'=>['style'=>'width:160px; font-family: tahoma ;font-size: 8pt;'], 
			'displayOnly'=>false
		],	
	];
	
	$dvKaryawan=DetailView::widget([
		'id'=>'dv-karyawan',
		'model' => $modelViewKayawan,
		'attributes'=>$dvAttKaryawan,
		'condensed'=>true,
		'hover'=>true,
		'panel'=>[
			'heading'=>'<div style="float:left;margin-right:10px" class="fa fa-1x fa-list-alt"></div><div><h6 class="modal-title"><b> Karyawan Detail</b></h6></div>',
			'type'=>DetailView::TYPE_INFO,
		],
		'buttons1'=>'{update}',
		'buttons2'=>'{view}{save}'
		
	]);	
?>
<div class="container-fluid" style="font-family: verdana, arial, sans-serif ;font-size: 8pt">
	<div class="col-xs-12 col-sm-12 col-lg-12" style="font-family: tahoma ;font-size: 9pt;">
		<div class="row">
			<div class="col-xs-6 col-sm-4 col-lg-4" style="font-family: tahoma ;font-size: 9pt;">
				<div class="row">
					<?=$gvKaryawan?>
				</div>
			</div>
			<div class="col-xs-6 col-sm-8 col-lg-8" style="padding-left:20px;font-family: tahoma ;font-size: 9pt;">
				<div class="row">
					<?php
						$form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL,
							'id'=>'edit-emp-id',
							'enableClientValidation' => true,
							'options'=>['enctype'=>'multipart/form-data'],
							'action'=>'/master/pekerja/update?id='.$modelViewKayawan->ID_PEKERJA,
						]);
							echo $dvKaryawan;
						ActiveForm::end();
					?>
				</div>
			</div>
		</div>
	</div>
</div>
