<?php
/**
 * Created by PhpStorm.
 * User: ptr.nov
 * Date: 10/08/15
 * Time: 19:44
 */
namespace common\components;
use Yii;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\base\Component;
use Yii\base\Model;
use yii\data\ArrayDataProvider;

use common\models\UserloginSearch;
use common\models\Userlogin;
use common\models\ModulMenuSearch;
use common\models\StoreSearch;
/** 
  * Components User Option
  * @author ptrnov  <ptr.nov@gmail.com>
  * @since 1.1
*/
class Onesignal extends Component{	
	
	/**
	 * USER LOGIN INDENTIFY CENTER.
	 * STATUS	: PER-USER [].
	 * Author	: Piter Novian [ptr.nov@gmail.com].	
	*/	 
	public function sendMessageAll($cases,$data)
    {
        if($cases === 'NOO')
        {
            $CUST_NM        = $data['CUST_NM'];
            $CREATED_BY     = $data['CREATED_BY'];
            $content = array("en" => 'New Customer From '.$CREATED_BY.' With Customers Name '.$CUST_NM);  
        }
        if($cases === 'RO')
        {
            $content = array("en" => 'Stock Order Input By Sales');
        }
        $fields = array(
                            'app_id' => "a291df49-653d-41ff-858d-e36513440760",
                            'included_segments' => array('All'),
                            'data' => array("foo" => "bar"),
                            'contents' => $content
                        );
        $fields = json_encode($fields);
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
                                                   'Authorization: Basic YjQyYWNiZjEtMzU1OC00Y2QxLWFmY2YtZmJkOWNmNjM4OWFm'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);
        
        return $response;
    }
}