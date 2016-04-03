<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>代码演示系统</title>
    <link href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">

    <style type="text/css">
        #main{color:#666}
        textarea{border:1px solid #7f9db9;font-size:9pt;width:430px;color:#000}
        .grey{color:#999}
        #msg1,#msg2,#msg3,#msg4{ display:none}
        #ol{position:absolute;z-index:1;padding:0px;margin:0px;border:0px;background:#ecf0f5;width:23px;text-align:left; }
        #li{background:#ecf0f5;height:700px;overflow:hidden;width:32px;border-right:0;line-height:20px;margin:0px;padding:0px;text-align:center}
        #c2{font-family:Arial, Helvetica, sans-serif;height:700px; margin:0px; width:416px;padding:0 0 0 35px;overflow-x: hidden;line-height:20px;}
    </style>
    <script type="text/javascript">
        String.prototype.trim2=function(){
            return this.replace(/(^\s*)|(\s*$)/g, "");
        }
        function F(objid){
            return document.getElementById(objid).value;
        }
        function G(objid){
            return document.getElementById(objid);
        }
    </script>
</head>

<script src="http://code.jquery.com/jquery-latest.js" > </script>
<h1 align="center">代码演示系统</h1>
<hr>
<body onload="keyUp();">
@yield('content')
</body>
</html>