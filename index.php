<?php

define("TOKEN", "pccold");
require_once ('TASiteInface.php');
require_once('config.php');
$wechatObj = new wechatCallbackapiTest();
$wechatObj->weixin_run(); //执行接收器方法

class wechatCallbackapiTest
{
   private $fromUsername;
   private $toUsername;
   private $times;
   private $keyword;
   
   
public function weixin_run(){
     $this->responseMsg();
     
     $TASiteRecommodPackage=new TASiteInterface('http://sso.lvbao114.com/WeChartWebService/ServiceEntrance.asmx?wsdl', TAGUID, IsTMS, Template);
     $returnArr=$TASiteRecommodPackage->ConstructArray();
       
     $returnStr=$this->fun_xml("news", $returnArr, array(6,0));
     
     $this->echo_server_log($returnStr);
     echo $returnStr;
   }
   
public function responseMsg()
    {
        $this->fromUsername = "Trpal";
        $this->toUsername = "user";
        $this->keyword = "测试";
        $this->times = time();
//		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
//                
//		if (!empty($postStr)){
//              	$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
//               
//                $this->fromUsername = $postObj->FromUserName;
//                $this->toUsername = $postObj->ToUserName;
//                $this->keyword = trim($postObj->Content);
//				$this->times = time();
//        }else {
//        	echo "this a file for weixin API!";
//        	exit;
//        }
    }
	
	//微信封装类,
	//type: text 文本类型, news 图文类型
	//text,array(内容),array(ID)
	//news,array(array(标题,介绍,图片,超链接),...小于10条),array(条数,ID)
	
private function fun_xml($type,$value_arr,$o_arr=array(0)){
	  //=================xml header============
	  $con="<xml><ToUserName><![CDATA[%s]]></ToUserName><FromUserName><![CDATA[%s]]></FromUserName><CreateTime>%s</CreateTime><MsgType><![CDATA[%s]]></MsgType>";
	 $con=sprintf($con,$this->fromUsername,$this->toUsername,time(),$type);		
      //=================type content============
	  switch($type){
	  
	    case "text" : 
		  $con.="<Content><![CDATA[{$value_arr[0]}]]></Content>
				<FuncFlag>{$o_arr}</FuncFlag>";  
		break;
		
		case "news" : 
		  $con.="<ArticleCount>%s</ArticleCount>
				 <Articles>";
                  $con=sprintf($con,$o_arr[0]);
		 foreach($value_arr as $id=>$v){
		 if($id>=$o_arr[0]) break; else null; //判断数组数不超过设置数
         $con.="<item>
				 <Title><![CDATA[%s]]></Title> 
				 <Description><![CDATA[%s]]></Description>
				 <PicUrl><![CDATA[%s]]></PicUrl>
				 <Url><![CDATA[%s]]></Url>
				 </item>";
                   $con=sprintf($con,$v[0],$v[1],$v[2],$v[3]);
		 }
		 $con.="</Articles>
				 <FuncFlag>%s</FuncFlag>";  
                 $con=sprintf($con,$o_arr[1]);
		break;
		
	  } //end switch
	  
	 //=================end return============
	  return $con."</xml>";
	}
        
        public function echo_server_log($log){
                file_put_contents("log.txt",$log,FILE_APPEND);  
        }
        
        
		
		
}

