@extends('backend.base'); 

@section('postscript')
<script src="{{ url('assets/backend/js/script.js?r=' . uniqid()) }}"></script>
@endsection

@section('content')
<form id="formDelete" action="{{ url('backend/moneda/' . $moneda->id) }}" method="post">
    @method('delete')
    @csrf
</form>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <a href="{{ url('backend/moneda') }}" class="btn btn-primary">View monedas</a>
                <a href="{{ url('backend/moneda/create') }}" class="btn btn-primary">Create moneda</a>
                <a href="#" data-id="{{ $moneda->id }}" data-name="{{ $moneda->name }}" class="btn btn-danger" id="enlaceBorrar">Delete moneda</a>
            </div>
        </div>
    </div>
</div>

<table class="table table-hover">
            <thead>
                <th scope="col">Field</th>
                <th scope="col">Value</th>
            </thead>

           <tbody>
                <tr>
                   <td>Name</td>
                   <td>{{ $moneda->name }}</td>
                </tr>
                <tr>
                   <td>Symbol</td>
                   <td>{{ $moneda->symbol }}</td>
                </tr>
                <tr>
                   <td>Country</td>
                   <td>{{ $moneda->country }}</td>
                </tr>
                <tr>
                   <td>Value (€)</td>
                   <td>{{ $moneda->value }}</td>
                </tr>
                <tr>
                   <td>Date</td>
                   <td>{{ date("d-m-Y", strtotime($moneda->date)) }}</td>
                </tr>
            </tbody>

        </table>

@endsection