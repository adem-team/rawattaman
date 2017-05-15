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
	#gv-User .kv-grid-wrapper {
		position: relative;
		overflow: auto;
		height: 500px;
	}
	
	/* #gv-User .panel {
		height: 500px;
	} */
	
	/*Change Panel Color*/
	#gv-User .panel-default > .panel-heading {
	  color: #333;
	  background-color: rgba(83, 224, 234, 1);
	  border-color: #ddd;
	}
");
	$pageTitleUser='<span class="fa-stack fa-xs text-right" style="color:red">				  
				  <i class="fa fa-share fa-1x"></i>
				</span> <b>Login User </b>
	';

	$bColorUser='rgba(87,114,111, 1)';
	$gvAttUser=[
		[
			'class'=>'kartik\grid\SerialColumn',
			'contentOptions'=>['class'=>'kartik-sheet-style'],
			'width'=>'10px',
			'header'=>'No.',
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','30px',$bColorUser,'#ffffff'),
			'contentOptions'=>Yii::$app->gv->gvContainBody('center','30px',''),
		],
		//username
		[
			'attribute'=>'username',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','50px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','50px',$bColorUser),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','50px',''),
			
		],	
		//email
		[
			'attribute'=>'email',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','50px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','50px',$bColorUser),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','50px',''),
			
		]	
	];

	$gvUser=GridView::widget([
		'id'=>'gv-User',
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns'=>$gvAttUser,	
		'rowOptions'   => function ($model, $key, $index, $grid) {
			return ['id' => $model->ACCESS_UNIX,'onclick' => '
					$.pjax.reload({
						url: "'.Url::to(['/master/user-admin']).'?id="+this.id,
						container:"#dv-user-info,#dv-user-link,#dv-user-token"
					});
									
			'];
		},	 
		'pjax'=>true,
		'pjaxSettings'=>[
			'options'=>[
				'enablePushState'=>false,
				'id'=>'gv-User',
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
			'heading'=>$pageTitleUser,
			//'type'=>'info',
			'before'=>false,
			'footer'=>false,			
		],
		'summary'=>false,
		'floatOverflowContainer'=>true,
		'floatHeader'=>true,
	]); 
	
	$dvAttUserInfo=[
		//Identitas
		// [	
			// 'group'=>true,
			// 'label'=>'Identitas',
			// 'rowOptions'=>['class'=>'success'],
			// 'groupOptions'=>['class'=>'text-left'] 			
		// ],
		[ 	
			'attribute' =>'ACCESS_UNIX',
			'type'=>DetailView::INPUT_TEXT,			
			'displayOnly'=>true,
			'labelColOptions'=>['style'=>'width:5px;font-family: tahoma ;font-size: 8pt;'], 
		],	
		[
			'attribute'=>'username', 
			'displayOnly'=>false,
			'labelColOptions'=>['style'=>'width:160px;font-family: tahoma ;font-size: 8pt;'], 
		],
		[
			'attribute'=>'email', 
			'labelColOptions'=>['style'=>'width:160px; font-family: tahoma ;font-size: 8pt;'], 
			'displayOnly'=>false
		],			
		[
			'attribute'=>'UUID', 
			'labelColOptions'=>['style'=>'width:160px; font-family: tahoma ;font-size: 8pt;'], 
			'displayOnly'=>false
		],
		[
			'attribute'=>'status', 
			'labelColOptions'=>['style'=>'width:160px; font-family: tahoma ;font-size: 8pt;'], 
			'displayOnly'=>false
		],
	];
	
	$dvAttUserLink=[
		//Identitas
		// [	
			// 'group'=>true,
			// 'label'=>'User Link',
			// 'rowOptions'=>['class'=>'success'],
			// 'groupOptions'=>['class'=>'text-left'] 			
		// ],
		[
			'attribute'=>'ID_FB', 
			'labelColOptions'=>['style'=>'width:160px; font-family: tahoma ;font-size: 8pt;'], 
			'displayOnly'=>false
		],	
		[
			'attribute'=>'ID_GOOGLE', 
			'labelColOptions'=>['style'=>'width:160px; font-family: tahoma ;font-size: 8pt;'], 
			'displayOnly'=>false
		],
		[
			'attribute'=>'ID_TWITTER', 
			'labelColOptions'=>['style'=>'width:160px; font-family: tahoma ;font-size: 8pt;'], 
			'displayOnly'=>false
		],	
	];
	
	$dvAttUserToken=[
		//Identitas
		// [	
			// 'group'=>true,
			// 'label'=>'User Token',
			// 'rowOptions'=>['class'=>'success'],
			// 'groupOptions'=>['class'=>'text-left'] 			
		// ],
		[
			'attribute'=>'ID_FB', 
			'labelColOptions'=>['style'=>'width:160px; font-family: tahoma ;font-size: 8pt;'], 
			'displayOnly'=>false
		],	
		[
			'attribute'=>'ID_GOOGLE', 
			'labelColOptions'=>['style'=>'width:160px; font-family: tahoma ;font-size: 8pt;'], 
			'displayOnly'=>false
		],
		[
			'attribute'=>'ID_TWITTER', 
			'labelColOptions'=>['style'=>'width:160px; font-family: tahoma ;font-size: 8pt;'], 
			'displayOnly'=>false
		],	
	];
	
	$dvUserInfo=DetailView::widget([
		'id'=>'dv-user-info',
		'model' => $modelUsesr,
		'attributes'=>$dvAttUserInfo,
		'condensed'=>true,
		'hover'=>true,
		'panel'=>[
					'heading'=>'<div style="float:left;margin-right:10px" class="fa fa-1x fa-list-alt"></div><div><h6 class="modal-title"><b> USER DETAIL</b></h6></div>',
					'type'=>DetailView::TYPE_INFO,
				],
		'saveOptions'=>[ 
			'id' =>'saveBtn',
			//'value'=>'/master/customers/viewcust?id='.$model->CUST_KD,
			'params' => ['custom_param' => true],
		],	
		
	]);	
	
	$dvUserLink=DetailView::widget([
		'id'=>'dv-user-link',
		'model' => $modelUsesr,
		'attributes'=>$dvAttUserLink,
		'condensed'=>true,
		'hover'=>true,
		'panel'=>[
					'heading'=>'<div style="float:left;margin-right:10px" class="fa fa-1x fa-list-alt"></div><div><h6 class="modal-title"><b> LOGIN LINK </b></h6></div>',
					'type'=>DetailView::TYPE_SUCCESS,
				],
		'saveOptions'=>[ 
			'id' =>'saveBtn',
			//'value'=>'/master/customers/viewcust?id='.$model->CUST_KD,
			'params' => ['custom_param' => true],
		],	
		
	]);	
	
	$dvUserToken=DetailView::widget([
		'id'=>'dv-user-token',
		'model' => $modelUsesr,
		'attributes'=>$dvAttUserToken,
		'condensed'=>true,
		'hover'=>true,
		'panel'=>[
					'heading'=>'<div style="float:left;margin-right:10px" class="fa fa-1x fa-list-alt"></div><div><h6 class="modal-title"><b> USER TOKEN</b></h6></div>',
					'type'=>DetailView::TYPE_DANGER,
				],
		'saveOptions'=>[ 
			'id' =>'saveBtn',
			//'value'=>'/master/customers/viewcust?id='.$model->CUST_KD,
			'params' => ['custom_param' => true],
		],	
		
	]);	
?>
<div class="container-fluid" style="font-family: verdana, arial, sans-serif ;font-size: 8pt">
	<div class="col-xs-12 col-sm-12 col-lg-12" style="font-family: tahoma ;font-size: 9pt;">
		<div class="row">
			<div class="col-xs-6 col-sm-4 col-lg-4" style="font-family: tahoma ;font-size: 9pt;">
				<div class="row">
					<?=$gvUser?>
				</div>
			</div>
			<div class="col-xs-6 col-sm-8 col-lg-8" style="padding-left:20px;font-family: tahoma ;font-size: 9pt;">
				<div class="row">
					<?=$dvUserInfo?>
					<?=$dvUserLink?>
					<?=$dvUserToken?>
				</div>
			</div>
		</div>
	</div>
</div>
