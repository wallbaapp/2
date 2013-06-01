<?
/*
|--------------------------------------------------------------------------
| default.php
|--------------------------------------------------------------------------
| auther:Liutiansi
| blog:http://blog.liuts.com
| Email:liutiansi@gmail.com
| update:2006-07-28
|
*/
$getURL=$_GET["imgURL"];
if ($getURL==""){
	$defaultURL="http://";
}else{
	$defaultURL=$getURL;
	$onload=" onLoad=\"restore();c2();\"";
}
?>
<html>
<head>
<meta http-equiv="Content-Language" content="zh-cn">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="GENERATOR" content="Microsoft FrontPage 4.0">
<meta name="ProgId" content="FrontPage.Editor.Document">
<style type="text/css">
<!--
body{font-family: 'MS Shell Dlg', 宋体, Tahoma;font-size: 12px;background-color: #ffffff;color:#000000;}
select 
{ 
	width: 110px; 
	line-height: 14px; color: #6799CC; 
	font-color:red;
	border-style: none; 
	border-width: 0px; 
}
td, div, input, textarea{font-family: 'MS Shell Dlg', 宋体, Tahoma;font-size: 12px;cursor: default;}
.title{background-color: #000080;color:#fdf7d3;padding: 1;font-family:宋体;font-size:12px;}
.up{
	background-color: #cccccc;
	color:#000000;
	border: 2px outset #ffffff;
	padding: 1px;
}
.down{background-color: #cccccc;border:2px inset #ffffff}
.up1{background-color: #cccccc;color: #000000;border: 1px outset #ffffff}
.border-all {
	border: 1px solid #333333;
}
.down1{background-color:#cccccc;border:1px inset #ffffff}
.l           { background-color: #cccccc; height: 18px; border-left: 2px outset #ffffff; 
               border-right: 2px outset #ffffff; color:#000000;
               border-top: 2px outset #ffffff; padding-top: 2;height:18}
.lc           { background-color: #cccccc; height: 18px; border-left: 2px outset #ffffff; 
               border-right: 2px outset #ffffff; color:#000000;
               border-top: 2px outset #ffffff; padding-top: 2;height:20}
.l-h         { background-color: #cccccc; border-left: 2px outset #ffffff ; border-top: 2px outset #ffffff;color:#000000; }
.l-c         { background-color: #cccccc; border-top: 2px outset #ffffff }
.l-r         { background-color: #cccccc; border-right: 2px outset #ffffff; border-top: 2px outset #ffffff;color:#000000;}
.l-hc         { background-color: #cccccc; border-left: 2px outset #ffffff;color:#000000;}
.l-cc         { background-color: #cccccc;color:#000000; }
.l-rc         { background-color: #cccccc; border-right: 2px outset #ffffff;color:#000000;}
td{color:#000000;}
.l1 {background-color: #cccccc; height: 18px; border-left: 2px outset #ffffff; 
               border-right: 2px outset #ffffff; color:#000000;
               border-top: 2px outset #ffffff; padding-top: 2;height:18}
.lc1 {background-color: #cccccc; height: 18px; border-left: 2px outset #ffffff; 
               border-right: 2px outset #ffffff; color:#000000;
               border-top: 2px outset #ffffff; padding-top: 2;height:20}
-->
</style>
<title>选择操作图像：</title>
</head>
<body style="border:outset 1 #ffffff;margin: 0;background-color: #cccccc;padding:3px" scroll=no<?=$onload?>>
<script src="lib/prototype.js" type="text/javascript"></script>
<SCRIPT LANGUAGE="JavaScript">
<!--
function restore()
{
td1.className="l";td2.className="l";td3.className="l";
td_1.className="l-h";td_2.className="l-c";td_3.className="l-c";
w1.style.display="none";w2.style.display="none";w3.style.display="none";
}
function c1()
{
td1.className="lc";
td_1.className="l-hc";
w1.style.display="block";
document.freeMenu.labelIndex.value="1";
}
function c2()
{
td2.className="lc";
td_2.className="l-cc";
w2.style.display="block";
document.freeMenu.labelIndex.value="2";
document.freeMenu.urlimages.focus();
}
function c3()
{
td3.className="lc";
td_3.className="l-cc";
w3.style.display="block";
document.freeMenu.labelIndex.value="3";
document.freeMenu.uploadimages.focus();
}

//-->
</SCRIPT>
<script language='javascript'>
var myGlobalHandlers = {
	onCreate: function(){
		$('systemWorking').style.display="none";
		Element.show('systemWorking');
	},
	onComplete: function() {
		if(Ajax.activeRequestCount == 0){
			Element.hide('systemWorking');
		}
	}
};
Ajax.Responders.register(myGlobalHandlers);

function submitOP()
{
	var optype = $F('labelIndex');
	if (optype=="1")
		var initimage = $F('sysimg');
	else if (optype=="2")
					var initimage = $F('urlimages');
			 else if (optype=="3"){
					document.freeMenu.action='UserInit_do.php';
					document.freeMenu.target='uploadF';
					document.freeMenu.submit();
					return false;
			}
	var url = 'UserInit_do.php';
	var pars = 'optype=' + optype + '&initimage=' + initimage;
	var myAjax = new Ajax.Request(
	url,
	{
		method: 'post',
		parameters: pars,
		onComplete: showResponse
	});	
}
function showResponse(originalRequest)
{
	try {
		eval("var strReq = " + originalRequest.responseText);		
		var tryarray=1;
	}catch(e){
		alert('数据处理发生异常！');
	}
	if (tryarray==1){
		var getresult=strReq["item"][0]["result"];
		var geterrorInfo=strReq["item"][0]["errorInfo"];
		if (getresult=="1"){
			//var parwin=window.dialogArguments;
			//parwin.Pagereload();
			window.location.href="index.php";
		}
		else
		{
			alert(geterrorInfo);
		}
	}
}
</script>

<form name="freeMenu" id="freeMenu" method="post" enctype="multipart/form-data">
<div align="center">
  <center>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <table width="700" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#FFFFFF">
    <tr>
      <td bgcolor="#E4EFF7">&nbsp;</td>
    </tr>
    <tr>
      <td align="center" bgcolor="#FFFFFF"><br>
	  <div id="systemWorking" style="z-index:auto; position:absolute;display:none;top:200"><table width="250" height="20" border="0" cellpadding="0" cellspacing="1" bgcolor="#6EB1F4"><tr><td bgcolor="#FFFFFF" align="center" valign="middle"><img src="loading.gif" align=center>　　正在处理中...</td></tr></table></div>
        <table border="0" cellpadding="0" cellspacing="0" width="400">
        <tr>
          <td width="100" align="center" valign="bottom" onclick=restore();c1();><div id="td1" class="lc1">测试图像</div></td>
          <td width="100" align="center" valign="bottom" onclick=restore();c2();><div id="td2" class="l1">远程图像</div></td>
          <td width="100" align="center" valign="bottom" onclick=restore();c3();><div id="td3" class="l1">本地图像</div></td>
          <td width="50" align="center" valign="bottom" id="td6"></td>
          <td width="50" align="center" valign="bottom"></td>
        </tr>
        <tr  style="">
          <td width="50" align="center" class="l-hc" id="td_1" >&nbsp;</td>
          <td width="50" align="center" class="l-c" id="td_2">&nbsp;</td>
          <td width="50" align="center" class="l-c" id="td_3">&nbsp;</td>
          <td width="50" align="center" class="l-c" id="td_4">&nbsp;</td>
          <td align="center" class="l-c" id="td_5">&nbsp;</td>
          <td width="50" align="center" class="l-c" id="td_6">&nbsp;</td>
          <td width="50" align="center" class="l-c" id="td_">&nbsp;</td>
          <td width="50" align="center" class="l-r" id="td_">&nbsp;</td>
        </tr>
        <tr>
          <td width="398" colspan="8" class="up" style="border-top-style: solid; border-top-width: 0; padding: 5"><div align="center">
              <table border="0" cellpadding="0" cellspacing="0" width="100%" height="225">
                <tr>
                  <td width="100%" height="200" bgcolor="#E4EFF7" class="border-all"><div align="center">
                      <center>
                        <div style="display:" id=w1> 选择图像：
                            <SELECT name="sysimg" id="sysimg" onChange="document.freeMenu.mvimg.src=options[selectedIndex].value+'_1.jpg'">
                              <option value="sysimg/1">雪地</option>
                              <option value="sysimg/2">绿地</option>
                              <option value="sysimg/3">青树</option>
                              <option value="sysimg/4">枫树</option>
                              <option value="sysimg/5">沙滩</option>
                              <option value="sysimg/6">清水</option>
                              <option value="sysimg/7">乡村</option>
                              <option value="sysimg/8">青叶</option>
                              <option value="sysimg/9">绿叶</option>
                            </SELECT>
                          <br>
                          <br>
                            <img id=mvimg width=200 src="sysimg/1_1.jpg" align=center border=1></div>
                        <div style="display:none" id=w2> 图像URL地址：
                            <input type=text name="urlimages" id="urlimages" value="<?=$defaultURL?>" size="50">
                        </div>
                        <div style="display:none" id=w3> 上传图像：
                            <input type=file id="uploadimages" name="uploadimages" size="40">
                        </div>
                      </center>
                  </div></td>
                </tr>
              </table>
          </div></td>
        </tr>
        <tr>
          <td width="398" colspan="8" align="center" style="border-top-style: solid; border-top-width: 0; padding: 5"><p align="center">
              <input type="button" value="下一步&gt;&gt;" name="_ok" style="width: 60;height:22" class="up" onClick="submitOP();">              
              </td>
        </tr>
      </table>
        <br></td>
    </tr>
    <tr>
      <td bgcolor="#E4EFF7">&nbsp;</td>
    </tr>
  </table>
</div>
<input type="hidden" name="labelIndex" value="1" id="labelIndex">
</form>
<IFRAME name="uploadF" height="0" width="0"></IFRAME>
<div align=center><script src="http://s139.cnzz.com/stat.php?id=1884884&web_id=1884884&show=pic1" language="JavaScript" charset="utf-8"></script></div>
</body>
</html> 
