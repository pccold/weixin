<?php
    require_once('../lib/nusoap.php'); 
    require_once('../config.php');
//    $re = new TASiteInterface('http://sso.lvbao114.com/WeChartWebService/ServiceEntrance.asmx?wsdl',
//                                '6E3E6CC1-2263-49F7-BE0C-9F5473B9E428',
//                                true,
//                                 8);
//         $xml = $re->ConstructArray();
//       print_r($xml);
    class TASiteInterface {
        private $interfaceUrl;
        private  $taguid;
        private  $isTMS;
        private  $templageNO;
        
        public function __construct($_interfaceUrl,$_taguid,$_isTMS,$_templageNO){
                $this->interfaceUrl = $_interfaceUrl;
                $this->taguid  =$_taguid;
                $this->isTMS = $_isTMS;
                $this->templageNO = $_templageNO;
            }
            
        private function GetRecommod(){              
                //$url ='http://sso.lvbao114.com/WeChartWebService/ServiceEntrance.asmx?wsdl'; 
                $client = new nusoap_client($this->interfaceUrl, 'wsdl','','','','');
                $client->soap_defencoding='utf-8';   
                $client->decode_utf8=false;     
                $client->xml_encoding='utf-8';   
                $param = array('_taguid'=>$this->taguid,'isConnectTMS'=>$this->isTMS,'_templateNO'=>$this->templageNO);     //print_r($param);     $result = $client->call('GetTARecommod', $param);
                $result = $client->call('GetTARecommod', $param);
                    //'6E3E6CC1-2263-49F7-BE0C-9F5473B9E428'
            //print_r($result);
                return $result;
                 
        }
        
        private function GetResponseXML(){
            $Res=$this->GetRecommod();
            //print_r($Res);
            $str=implode("",$Res);
            //print_r($str);
            $xmlObj = simplexml_load_string($str, 'SimpleXMLElement', LIBXML_NOCDATA);
            $xmlArr=array();
            // print_r($xmlArr);
            foreach($xmlObj->children() as $depart)
            {
                //$PackageName=$depart->NameSingle;
                $tempArr=array($depart->NameSingle,$depart->TravelLineID,$depart->TitleImageLink,$depart->TypeID,$depart->ParentID,$depart->AdultPriceNet);
                array_push($xmlArr, $tempArr);
            }
          // print_r($xmlArr);
            return $xmlArr;
        }
        
        //把网站的推荐线路构建成微信图文格式的数组
        public function ConstructArray(){
            //把常量取出来
            $OrgArr=$this->GetResponseXML();
           //var_dump($OrgArr);
            //$taguid=TAGUID;
            $Template=$this->templageNO;
            $URL=URL;
            //$WeSiteName=WeSiteName;
            //做几个临时变量
            $arr[]=$this->ConstructHead();
          //  print_r($arr);
            foreach($OrgArr as $tempArr){
                $title=$tempArr[0].$tempArr[5]."元";
                $description = "123";
                $imgUrl=$URL."/App.TASite/Admin".$tempArr[2];
                $targetUrl=$URL."/App.TASite/TMSLineInfo.aspx?TravelLineID=".$tempArr[1]."&ParentID=".$tempArr[4]."&TravelLineTypeID=".$tempArr[3];
                $arr[]=array($title,$description,$imgUrl,$targetUrl);
                
            }
            // print_r($arr);
            return $arr;
        }
      
        private function ConstructHead(){ 
            $WeSiteName=WeSiteName;
            $description = "123";
            $URL=URL;
            $taguid=TAGUID;
            $arr=array($WeSiteName,$description,$URL."/App.TASite/admin/Images/".$taguid."/SidImage/banner.jpg",$URL);
          //  http://www.huaxialvxing.com/App.TASite/Admin/Images/b0c836f5-d9e3-4778-b453-c3f01f177748/SidImage/banner.jpg
            return $arr;
        }
    }
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

