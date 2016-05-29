@extends('head')
@section('content')
    <div>
        <table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0" style="position:relative">
            <tr height="5%">
                <td width="33%" rowspan="4">
                    <div id="ol"><textarea cols="2" rows="10" id="li" disabled></textarea></div>
                    <textarea name="code" cols="20" rows="40" wrap="off" id="c2" readonly="readonly">{{$code}}</textarea>
                </td>
                <td align="left" VALIGN="top" width="20%">
                    <div id="next" name="debug_behaviour">
                        <button type="button" onclick="getValueFromServer()" style="width:80px;height:40px">下一步</button>
                    </div>
                    <script>
                        function getValueFromServer()
                        {
                            $.ajax({
                                url: "/debug/next?var="+$('.dd1').val()+"&var_add="+$('.dd2').val()+"&mem="+$('.dd3').val(),
                                type: "GET",
                                dataType:"json",
                                success: function (data) {
                                    $('#var').val(data["var"]);
                                    $('#var_add').val(data["var_add"]);
                                    $('#mem').val(data["mem"]);
                                    console.log(JSON.stringify(data));
                                },
                                error: function (a, b, c) {
                                    alert(a+" " + b + " "+ c)
                                }
                            });


                        }
                    </script>
                </td>
                <td style="padding-left:170px" valign="top">
                    <h4>监测情况</h4>
                </td>
            </tr>
            <tr height="31%">
                <td align="right">变量的值:</td>
                <td valign="top">
                    <textarea id="var" rows="13" cols="20" readonly="readonly"></textarea>
                </td>
            </tr>
            <tr height="31%">
                <td align="right">变量地址:</td>
                <td valign="top">
                    <textarea id="var_add" rows="13" cols="20" readonly="readonly"></textarea>
                </td>
            </tr>
            <tr height="31%">
                <td align="right">内存详情:</td>
                <td valign="top">
                    <textarea id="mem" rows="13" cols="20" readonly="readonly"></textarea>
                </td>
            </tr>
        </table>
    </div>

    <hr>

    <div>
        <table border="10" cellspacing="0" cellpadding="0">
            <tr>
                变量名称:<input id="varname" name="var" class="dd1" value="...">
            </tr>
            <tr>
                变量地址:<input id="address" name="var_address" class="dd2" value="...">
            </tr>
            <tr>
                内存详情:<input id="memory" name="memory" class="dd3" value="...">
            </tr>
            <tr align="right">
                <button type="button" onclick="stopDebug()">停止演示</button>
            </tr>
            <tr align="right">
                <button type="button" onclick="saveCode({{$code}})">保存代码</button>
            </tr>
        </table>
    </div>

    <hr>

    <!--script>
        function getVars()
        {
            $.ajax({
                url: "/debug/next",
                type: "POST",
                data: {
                    "var": $('.dd1').val(),
                    "var_address": $('.dd2').val(),
                    "memory": $('.dd3').val()
                },
                dataType:"json",
                success: getValueFromServer(),
                error: function (a, b, c) {
                    alert(a + " " + b + " " + c)
                }
            });
        }
    </script-->

    <script>
        function stopDebug()
        {
            $.ajax({
                url: "/debug/stop",
                type: "GET",
                dataType:"json",
                success: function (){},
                error: function (a, b, c) {
                    alert(a + " " + b + " " + c)
                }
            });
        }
    </script>

    <script>
        function saveCode(code)
        {
            $.ajax({
                url: "/saveCode",
                type: "POST",
                dataType:{
                    "code" : code
                },
                success: function(){
                    alert("保存成功")
                },
                error: function (a, b, c) {
                    alert("保存失败:", a + "," + b +"," + c)
                }
            })
        }
    </script>

    <script type="text/javascript">
        var msgA=["msg1","msg2","msg3","msg4"];
        var c=["c1","c2","c3","c4"];
        var slen=[50,20000,20000,60];//允许最大字数
        var num="";//http://www.phpernote.com/javascript-function/752.html
        var isfirst=[0,0,0,0,0,0];
        function isEmpty(strVal){
            if( strVal=="" )
                return true;
            else
                return false;
        }
        function isBlank(testVal){
            var regVal=/^\s*$/;
            return (regVal.test(testVal))
        }
        function chLen(strVal){
            strValstrVal=strVal.trim2();
            var cArr=strVal.match(/[^\x00-\xff]/ig);
            return strVal.length+(cArr==null ? 0 : cArr.length);
        }
        function check(i){
            var iValue=F("c"+i);
            var iObj=G("msg"+i);
            var n=(chLen(iValue)>slen[i-1]);
            if((isBlank(iValue)==true)||(isEmpty(iValue)==true)||n==true){
                iObj.style.display ="block";
            }else{
                iObj.style.display ="none";
            }
        }
        function checkAll(){
            for(var i=0;i<msgA.length;i++){
                check(i+1);
                if(G(msgA[i]).style.display=="none"){
                    continue;
                }else{
                    alert("填写错误,请查看提示信息！");
                    return;
                }
            }
            G("form1").submit();
        }
        function clearValue(i){
            G(c[i-1]).style.color="#000";
            keyUp();
            if(isfirst[i]==0){
                G(c[i-1]).value="";
            }
            isfirst[i]=1;
        }
        function keyUp(){
            var obj=G("c2");
            var str=obj.value;
            strstr=str.replace(/\r/gi,"");
            strstr=str.split("\n");
            n=str.length;
            line(n);
        }
        function line(n){
            var lineobj=G("li");
            for(var i=1;i<=n;i++){
                if(document.all){
                    num+=i+"\r\n";
                }else{
                    num+=i+"\n";
                }
            }
            lineobj.value=num;
            num="";
        }
        function autoScroll(){
            var nV=0;
            if(!document.all){
                nV=G("c2").scrollTop;
                G("li").scrollTop=nV;
                setTimeout("autoScroll()",20);
            }
        }
        if(!document.all){
            window.addEventListener("load",autoScroll,false);
        }
    </script>
@stop