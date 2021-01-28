@extends('layouts.app')

@section('title','All Emp Data')

@section('content')
<a href="/crud/public/emp/create">Create new</a>
<br><br>
<table border="1">
    
    @foreach($emp_details as $key=>$detail)
        <tr>
        <td>{{$key+1}}</td>
        <td><img src="{{url('/uploads/emp_img/'.$detail->emp_img)}}" style="height:100px;width=100px;"></td>
        <td>{{ $detail['emp_name'] }}<td>    
        <td>{{ $detail['emp_email'] }}<td>
        <td>{{ $detail['emp_city'] }}<td>
        <td>{{ $detail['emp_phone'] }}<td>
        <td><a href="{{ route('emp.edit',$detail->id)}}">Update</a><td>
        <form action="{{ route('emp.destroy', $detail->id)}}" method="post">
        {{csrf_field()}}
        {{method_field('DELETE')}}
        <td><input type="submit" value="delete"></button><td></form>
        </tr>
    @endforeach
    </table>
@endsection
