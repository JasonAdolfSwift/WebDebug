@extends('head')
@section('content')
    <form name="code" action="/code" method="POST">
        <div style="width:100%; margin: 5px 500px">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="position:relative">
                <tr>
                    <td width="55%">
                        <div id="ol"><textarea cols="2" rows="10" id="li" disabled></textarea></div>
                        <textarea name="code" cols="60" rows="10" wrap="off" id="c2"  onblur="check('2')" onKeyUp="keyUp()" onFocus="clearValue('2')" onscroll="G('li').scrollTop=this.scrollTop;" oncontextmenu="return false"  class="grey">请在这里粘入多段字看一看。</textarea>
                    </td>
                </tr>
            </table>
        </div>
        <hr>
        <input type="submit" value="编译">
        <input type="hidden" name="_token"         value="{csrf_token()}"/>
        <em class="block" id="msg2">文本框没有内容。</em>
    </form>
    <hr>
    <a href="/showSavedCode"><input type="button" value="查看已保存的代码"></a>
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