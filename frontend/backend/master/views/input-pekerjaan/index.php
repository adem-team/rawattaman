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
	#gv-profile .kv-grid-wrapper {
		position: relative;
		overflow: auto;
		height: 500px;
	}
	#gv-harga-per-store .kv-grid-wrapper {
		position: relative;
		overflow: auto;
		height: 380px;
	}
	
	#gv-discount-detail .kv-grid-wrapper {
		position: relative;
		overflow: auto;
		height: 380px;
	}
");

$this->registerJs($this->render('modal_pekerjaan.js'),View::POS_READY);
//$this->registerJs($this->render('tabx.js'),View::POS_READY);
echo $this->render('modal_pekerjaan'); //echo difinition

	$aryStt= [
		  ['STATUS' => 0, 'STT_NM' => 'DISABLE'],		  
		  ['STATUS' => 1, 'STT_NM' => 'ENABLE']
	];	
	$valStt = ArrayHelper::map($aryStt, 'STATUS', 'STT_NM');
	
	$bColor='rgba(87,114,111, 1)';
	$pageNm='<span class="fa-stack fa-xs text-right" style="color:red">				  
				  <i class="fa fa-share fa-1x"></i>
				</span> <b>Input Pekerjaan</b>
	';
	
	$gvAttriProfile=[
		[
			'class'=>'kartik\grid\SerialColumn',
			'contentOptions'=>['class'=>'kartik-sheet-style'],
			'width'=>'10px',
			'header'=>'No.',
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','30px',$bColor,'#ffffff'),
			'contentOptions'=>Yii::$app->gv->gvContainBody('center','30px',''),
		],
		//ACCESS_UNIX
		[
			'attribute'=>'ACCESS_UNIX',
			//'label'=>'Cutomer',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','200px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			//gvContainHeader($align,$width,$bColor)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','200px',$bColor),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','200px',''),
			
		],
		//ACCESS_UNIX
		[
			'attribute'=>'NM_DEPAN',
			'label'=>'Nama',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','200px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			//gvContainHeader($align,$width,$bColor)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','200px',$bColor),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','200px',''),
			
		]	
	];

	$gvProfile=GridView::widget([
		'id'=>'gv-profile',
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns'=>$gvAttriProfile,	
		'rowOptions'   => function ($model, $key, $index, $grid) {
			return ['id' => $model->ACCESS_UNIX,'onclick' => '
				var url = window.location.href.split("#")[1];	
					//alert(url);
					if(url=="tab-a"){
						$.pjax.reload({
							url: "'.Url::to(['/master/input-pekerjaan']).'?id="+this.id+"#tab-a",
							container:"#dv-profile"
						});
					}else if(url=="tab-b"){
						$.pjax.reload({
							url: "'.Url::to(['/master/input-pekerjaan']).'?id="+this.id+"#tab-b",
							container:"#gv-jadwal-input"
						});
					}else if(url=="tab-c"){
						$.pjax.reload({
							url: "'.Url::to(['/master/input-pekerjaan']).'?id="+this.id+"#tab-c",
							container:"#gv-rating"
						});
					}else if(url="undefined"){
						$.pjax.reload({
							url: "'.Url::to(['/master/input-pekerjaan']).'?id="+this.id+"#tab-a",
							container:"#dv-profile"
						});
					};						
			'];
		},	 
		'pjax'=>true,
		'pjaxSettings'=>[
			'options'=>[
				'enablePushState'=>false,
				'id'=>'gv-profile',
		    ],						  
		],
		'hover'=>true, //cursor select
		'responsive'=>true,
		'responsiveWrap'=>true,
		'bordered'=>true,
		'striped'=>true,
		'autoXlFormat'=>true,
		'export' => false,
		'panel'=>false,
		'toolbar' => false,
		'panel' => [
			'heading'=>'',
			//'heading'=>tombolBack().'<div style="float:right"> '.tombolCreate().' '.tombolExportExcel().'</div>',  
			'heading'=>tombolCreateClient().' '.$pageNm,  
			'type'=>'info',
			//'before'=> tombolBack().'<div style="float:right"> '.tombolCreate().' '.tombolExportExcel().'</div>',
			//'before'=> tombolBack(),
			'before'=>false,
			'footer'=>false,
		],
		
		'summary'=>false,
		'floatOverflowContainer'=>true,
		'floatHeader'=>true,
	]); 
	
	$dvIndexProfile= $this->render('_indexProfile',[
		'getAccessUnix'=>$getAccessUnix,
		'modelProfile'=>$modelProfile,
	]);
	
	$gvIndexJadwal= $this->render('_indexJadwal',[
		'getAccessUnix'=>$getAccessUnix,
		'searchModelJadwal'=>$searchModelJadwal,
		'dataProviderJadwal'=>$dataProviderJadwal
	]);	
	
	$dvIndexRating= $this->render('_indexRating',[
		'getAccessUnix'=>$getAccessUnix,
		'searchModelRating'=>$searchModelRating,
		'dataProviderRating'=>$dataProviderRating
	]);
	
	
?>

<div class="container-fluid" style="font-family: verdana, arial, sans-serif ;font-size: 8pt">
	<div class="col-xs-12 col-sm-12 col-lg-12" style="font-family: tahoma ;font-size: 9pt;">
		<div class="row">
			<div class="col-xs-6 col-sm-3 col-lg-3" style="font-family: tahoma ;font-size: 9pt;">
				<div class="row">
					<?=$gvProfile?>
				</div>
			</div>
			<div class="col-xs-6 col-sm-9 col-lg-9" style="font-family: tahoma ;font-size: 9pt;">
				<div class="row">
					<?php
						$items=[
							[
								'label'=>'<i class="fa fa-users fa-lg"></i>  Profile','content'=>$dvIndexProfile,
								//'active'=>$tab0,
								'options' => ['id' => 'tab-a'],
							],	
							[
								'label'=>'<i class="fa fa-calendar-check-o fa-lg"></i>  Jadwal','content'=>$gvIndexJadwal,
								//'active'=>$tab0,
								'options' => ['id' => 'tab-b'],
							],
							[
								'label'=>'<i class="fa fa-star-half-full fa-lg"></i>  Rating','content'=>$dvIndexRating,
								//'active'=>$tab1,
								'options' => ['id' => 'tab-c'],
							]
						];
						
						echo TabsX::widget([
							'id'=>'tab-index-formula',
							'items'=>$items,
							'position'=>TabsX::POS_ABOVE,
							//'height'=>'tab-height-xs',
							'bordered'=>true,
							'encodeLabels'=>false,
							//'align'=>TabsX::ALIGN_LEFT,
							// 'pluginOptions' => [
								// 'enableCache'=>true,
								// 'cacheTimeout'=>300000
							// ],
							'enableStickyTabs' => true, //get data 'options' => ['id' => 'b'],
							// 'stickyTabsOptions' => [
								//'selectorAttribute' => ['tab'=>'data-target'],
								// 'backToTop' => true,
							// ],
						]); 
					?>
				</div>
			</div>
		</div>
	</div>
</div>
