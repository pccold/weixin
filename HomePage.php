<?php
include 'config.php';
$header =new Homepage();
$header->header();
class Homepage{
    public function header(){
        $headFirst="<!doctype html>"
  . "<html>"
  . "<head>"
  . "<meta charset=\"utf-8\">"
  . "<title>".WeSiteName."</title>"
  . "<link rel=\"stylesheet\" type=\"text/css\" href=\"css.css\">"
  . "<link rel=\"stylesheet\" href=\"style.css\" type=\"text/css\"/>"
  . "</head>"
  . "<body>"
  . "<div class=\"container\">"
  . " <article class=\"content-index\">"
  . "      <img class=\"bigpic\" src=\"img/big-pic.gif\">"
  . "      <ul class=\"nav\">"
  . "              <li><a href=\"items.html\"><img src=\"img/recomend1.gif\"><span>推荐线路</span></a></li>"
  . "              <li><a href=\"items-all.html\"><img src=\"img/items1.gif\"><span>全部线路</span></a></li>"
  . "              <li id=\"clear\"><a href=\"search.html\"><img src=\"img/search1.gif\"><span>搜索</span></a></li>"
  . "      </ul>"
  . "      <ul class=\"nav\">"
  . "              <li><a href=\"travel-articles.html\"><img src=\"img/baodian1.gif\"><span>旅游宝典</span></a></li>"
  . "              <li><a href=\"login.html\"><img src=\"img/user1.gif\"><span>会员</span></a></li>"
  . "              <li id=\"clear\"><a href=\"weather.html\"><img src=\"img/weather1.gif\"><span>景点天气</span></a></li>"
  . "      </ul>"
  . "      <div class=\"footer\">"
  . "             <ul class=\"foot\">"
  . "                 <li><a href=\"#\">预订</a></li>"
  . "                 <li><a href=\"#\">人工客服</a></li>"
  . "                 <li id=\"clear\"><a href=\"contact.html\">联系我们</a></li>"
  . "                 "
  . "             </ul>"
  . "      </div>"
  . " </article>"
  . "</div>"
  . "</body>"
  . "</html>";
        echo $headFirst;
    }
}
