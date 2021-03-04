@extends('backend.base')

@section('postscript')
<script src="{{ url('assets/backend/js/script.js') }}"></script>
@endsection

@section('content')

<div class="container">
  
  <div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
                <a href="{{ url('backend/moneda') }}" class="btn btn-primary">monedas</a>
                <a href="{{ url('backend/moneda') }}" id="enlaceBorrar" data-id="{{ $moneda->id }}" data-name="{{ $moneda->name }}" class="btn btn-danger">delete moneda</a>
            </div>
        </div>
    </div>
  </div>
    <div class="row justify-content-md-center">
        
        <div class="col col-lg-2"></div>
        
        <div class="col-8">
            <form role="form" action="{{ url('backend/moneda/'. $moneda->id) }}" method="post" id="editmonedaForm">
                @method('put')
                @csrf
              <div class="card-body">
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" minlength="2" maxlength="40" required value="{{  old('name', $moneda->name) }}" name="name" class="form-control" id="name"  placeholder="moneda name">
              </div>
              <div class="form-group">
                <label for="symbol">symbol</label>
                <input type="text" minlength="1" maxlength="3" required value="{{ old('symbol', $moneda->symbol) }}" name="symbol" class="form-control" id="symbol" placeholder="symbol">
              </div>
              <div class="form-group">
                <label for="country">country</label>
                <input type="text" maxlength="100" maxlength="3" required value="{{ old('country', $moneda->country) }}" name="country" class="form-control" id="country" placeholder="country">
                </div>
            
              <div class="form-group">
                <label for="value (€)">value (€)</label>
                <input type="number" step="0.001" minlength="3" maxlength="60" required value="{{ old('value', $moneda->value) }}" name="value" class="form-control" id="value" placeholder="value">
              </div>
              <div class="form-group">
                <label for="date">date</label>
                <input required type="date" class="form-control" value="{{ old('date', $moneda->date) }}" name="date" id="date" placeholder="Enter date"></input>
              </div>
            </div>
            <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" value="create" class="btn btn-primary">Edit</button>
              </div>
            </div>
              
            </form>
            
                <div class="col-2"></div>
        </div>
    </div><!-- container -->
     @if(Session::get('error') !== null)
        <h2>{{Session::get('error')}}</h2>
    @endif
@endsection