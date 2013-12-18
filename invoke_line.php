<?
		require_once('config.php'); 
		require_once('loop_line.php');
		require_once('re_line.php');
		$Recommend=new TASiteInterface('http://sso.lvbao114.com/WeChartWebService/ServiceEntrance.asmx?wsdl', TAGUID, IsTMS, Template);
		$line=$Recommend->ConstructArray();
		$loop = new loop();
		$result = $loop->fun_loop($line);
		echo $result;
		