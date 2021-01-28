@extends('layouts.app')
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous">
</script>
@section('title','Create New Emp')

@section('content')
    <h3 id="form_title"> create new record </h3>
    <form action="{{route('emp.store')}}" method="POST" enctype="multipart/form-data">
        {{csrf_field()}}
        Emp Name<input type="text" name="name" value={{old('name')}}><br>
        Emp Email<input type="text" name="email" value={{old('email')}}><br>
        {{-- Emp City<input type="text" name="city" value={{old('city')}}><br> --}}
        Emp State<select name="state" id="state">
            @foreach ($state_data as $item)
            <option value="{{$item->city_state}}">{{$item->city_state}}</option>
            @endforeach
          </select><br>
        Emp City<select id="city_list" name="city">

        </select><br>
        Emp Number<input type="number" name="number" value={{old('number')}}><br>
        Emp Image<input type="file" name="img"><br>
        <input type="submit" name="create" value="Create">
    </form>
    <div>
        {{-- all error list --}}
        @if($errors->any())
        <br><hr>All error lists <br>
        @foreach ($errors->all() as $error)
            <br>{{$error}}
        @endforeach
    @endif
    </div>
@endsection

<script>
    $(document).ready(function(){
        
        $('#state').change(function(){
            const selectedState = $('#state').val();
            $.ajax({
                    type: "get",
                    url: "{{route('emp.cities')}}",
                    data: {state:selectedState},
                    success: function(data){
                      $('#city_list').html(data);  
                    }
                });
            })
        });
</script>




