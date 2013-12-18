<?php
	require_once('re_line.php');
	
	class loop{
		public function fun_loop($loop_arr){
			foreach($loop_arr as $id=>$v){
				$loop_con  = "<html>"
  . "<head>"
  . "<meta charset=\"utf-8\">"
  . "<link rel=\"stylesheet\" type=\"text/css\" href=\"css.css\">"
  . "</head>"
  . "<body>"
  . "<div class=\"container\">"
  . " <article class=\"content\">"
  . "      <ul class=\"items\">"
  . "         <li>"
  . "            <img src=\"$v[2]\">"
  . "            <div class=\"content-info\">"
  . "                <h4><a href=\"$v[3]\">$v[0]</a></h4>"
  . "                <p><span>￥</span><strong>$v[1]</strong></font></p>"
  . "            </div>"
  . "         </li>"
  . "      </ul>    "
  . " </article>"
  . "<div>"
  . "<body>"
  . "<html>";
  

			}  
			echo $loop_con;
		}
	}
