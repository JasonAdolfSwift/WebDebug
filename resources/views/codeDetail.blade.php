@extends('head')
@section('content')
    <h3>错误类型:{{$code->error_type}}</h3>

    <form name="code" action="/code" method="POST">
        <div>
            <table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0" style="position:relative">
                <tr height="5%">
                    <td width="33%" rowspan="4">
                        <div id="ol"><textarea cols="2" rows="10" id="li" disabled></textarea></div>
                        <textarea name="code" cols="20" rows="40" wrap="off" id="c2" readonly="readonly" class="code">{{$code->code}}</textarea>
                    </td>
                </tr>
            </table>
        </div>
        <hr>
        <input type="submit" value="编译">
    </form>
@stop