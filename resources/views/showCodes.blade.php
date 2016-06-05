@extends('head')
@section('content')
    @foreach($codes as $code)
        <table width="100%" border="0" cellspacing="0" cellpadding="0" style="position:relative">
            <tr>
                <td width="50%">
                    <a href="/codeDetail?id={{$code->id}}">
                        <h2>{{$code->id}} {{$code->error_type}}</h2>
                    </a>
                </td>
            </tr>
        </table>
    @endforeach
@stop