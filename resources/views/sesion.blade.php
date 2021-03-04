@extends('base')

@section('title')
sesion
@endsection

@section('titlePart')
sesion
@endsection

@section('content')    

<h2>{{ $incrementar ?? 'sin valor' }}</h2>
<h2>
    @if($suma != 0)
        {{ $suma }}
        
        @else
            
            no existe
    @endif
</h2>
<h2>
    
flash: {{ request()->session()->get('flash') }}
flash: {{ Session::get('flash') }}
</h2>


<form action="{{ url('sesion') }}">
    <input type="text" value="" name="incrementar"/>
    <input type="submit" value="Submit"/>
</form>

@endsection
