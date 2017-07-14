<?php
/* @var $this yii\web\View */
use kartik\helpers\Html;
use yii\bootstrap\Carousel;
// use lukisongroup\assets\Profile;
// Profile::register($this);

$this->title = 'Rawat Taman';
		
	$bgColor='rgba(0, 0, 5, 1)';//'#3e3939';//black   //'#2292d0'//blue;
	$bgColorIcon='#fffefe';//'#c72b42';//merah
	$rangeColorIcon='#2292d0';//blue;'#25ca4f';// hijo
	$colorIcon='#3e3939';
	$colorTextIcon='#0f0202';
			
?>

<!-- CROUSEL Author: -ptr.nov- !-->
<?php
	echo Carousel::widget([
	  'items' => [
		 // equivalent to the above
		  [
			'content' => '<img src="https://web.rawattaman.int/img/bg2.png" style="width:100%; height:100%"/>',
			//'content' => '<img src="http://lukisongroup.int/upload/carousel/Lukison-Slider3.jpg" style="width:100%; height:100%"/>',
		//	'options' =>[ 'style' =>'width: 100%; height: 300px;'],
		  ],
		  [
			'content' => '<img src="https://web.rawattaman.int/img/bg3.png" style="width:100%; height:100%"/>',
			//'options' =>[ 'style' =>'width: 100% ; height: 300px;'],
		  ],

		  // the item contains both the image and the caption
		  [
			  'content' => '<img src="https://web.rawattaman.int/img/bg1.png" style="width:100%;height:100%"/>',
			  //'caption' => '<h4>This is title</h4><p>This is the caption text</p>',
			// 'options' =>[ 'style' =>'width: 100%; height: 300px;'],

		  ]
	  ],
	   //'options' =>[ 'style' =>'width: 100%!important; height: 300px;'],
	]);
?>

	
	

