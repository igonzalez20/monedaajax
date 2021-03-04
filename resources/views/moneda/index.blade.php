@extends('index')

@section('title')

@endsection

@section('content')

    <!--@foreach ($monedas as $moneda)
    
        <div class="col-md-6" style="margin-bottom: 20px;">
          <div class="card mb-6 shadow-sm">
            <img class="bd-placeholder-img card-img-top" src="{{ url('fotos/' . $moneda['id']. '.jpg')}}" width="100%" height="225"  preserveAspectRatio="xMidYMid slice" focusable="false" ></img>
            <div class="card-body">
              <pre><h2>{{ $moneda['name'] }}   <small class="text-muted">fecha: {{ $moneda['date'] }}</small> </h2>
                <h3>{{ $moneda['price'] }}€            <small class="text-muted">hora: {{ $moneda['time'] }}</small></h3></pre>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-secondary"><a href="{{ url('backend/ticket/' . $moneda['id']) }}">Ver</a></button>
                  <button type="button" class="btn btn-sm btn-outline-secondary"><a href="{{ url('backend/ticket/' . $moneda['id'] . '/edit') }}">Editar</a></button>
                </div>
              </div>
            </div>
          </div>
        </div>
        
    @endforeach
    
    @foreach ($monedas as $moneda)
    
        <div class="col-md-6" style="margin-bottom: 20px;">
          <div class="card mb-6 shadow-sm">
            <img class="bd-placeholder-img card-img-top" src="{{ url('fotos/' . $moneda['id']. '.jpg')}}" width="100%" height="225"  preserveAspectRatio="xMidYMid slice" focusable="false" ></img>
            <div class="card-body">
              <pre><h2>{{ $moneda['name'] }}   <small class="text-muted">fecha: {{ $moneda['date'] }}</small> </h2>
                <h3>{{ $moneda['price'] }}€            <small class="text-muted">hora: {{ $moneda['time'] }}</small></h3></pre>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-secondary">Ver</button>
                  <button type="button" class="btn btn-sm btn-outline-secondary">Editar</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        
    @endforeach-->
@endsection