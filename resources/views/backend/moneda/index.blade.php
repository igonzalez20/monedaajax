@extends('backend.base')



@section('content')

<div class="modal fade" id="AddModal" tabindex="-1" role="dialog" aria-labelledby="AddModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="AddModalLabel">Add moneda</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="addMonedaForm">
            @csrf
            <div class="card-body">
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" minlength="2" maxlength="40" required value="" name="name" class="form-control" id="name"  placeholder="moneda name">
              </div>
              <div class="form-group">
                <label for="symbol">symbol</label>
                <input type="text" minlength="1" maxlength="3" required value="" name="symbol" class="form-control" id="symbol" placeholder="symbol">
              </div>
              <div class="form-group">
                <label for="country">country</label>
                <input type="text" maxlength="100" maxlength="3" required value="" name="country" class="form-control" id="country" placeholder="country">
                </div>
            
              <div class="form-group">
                <label for="value (€)">value (€)</label>
                <input type="number" step="0.001" minlength="3" maxlength="60" required value="" name="value" class="form-control" id="value" placeholder="value">
              </div>
              <div class="form-group">
                <label for="date">date</label>
                <input required type="date" class="form-control" value="" name="date" id="date" placeholder="Enter date"></input>
              </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="AddMoneda" class="btn btn-primary">Add moneda</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="EditModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="EditModalLabel">Edit moneda</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="editMonedaForm">
            @csrf
            <div class="card-body">
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" minlength="2" maxlength="40" required value="" name="name" class="form-control" id="nameEdit"  placeholder="moneda name">
              </div>
              <div class="form-group">
                <label for="symbol">symbol</label>
                <input type="text" minlength="1" maxlength="3" required value="" name="symbol" class="form-control" id="symbolEdit" placeholder="symbol">
              </div>
              <div class="form-group">
                <label for="country">country</label>
                <input type="text" maxlength="100" maxlength="3" required value="" name="country" class="form-control" id="countryEdit" placeholder="country">
                </div>
            
              <div class="form-group">
                <label for="value (€)">value (€)</label>
                <input type="number" step="0.001" minlength="3" maxlength="60" required value="" name="value" class="form-control" id="valueEdit" placeholder="value">
              </div>
              <div class="form-group">
                <label for="date">date</label>
                <input required type="date" class="form-control" value="" name="date" id="dateEdit" placeholder="Enter date"></input>
              </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="EditMoneda" class="btn btn-primary">Edit moneda</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="DeleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="DeletetModalLabel">Delete moneda</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          ¿Seguro que quiere borrar la moneda <span id="nameBorrar"></span>?
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="DeleteMoneda" class="btn btn-primary">Delete moneda</button>
      </div>
    </div>
  </div>
</div>


    
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            
            <div class="card-body">            
                <button type="button"  class="btn btn-primary" data-toggle="modal" data-target="#AddModal">Create coin</buton>
            </div>
        </div>
    </div>
</div>

<table class="table table-hover">
              <thead>
                <th scope="col">id #</th>
                <th scope="col">name</th>
                <th scope="col">symbol</th>
                <th scope="col">country</th>
                <th scope="col">value (€)</th>
                <th scope="col">date</th>
                
                <th scope="col">show</th>
                <th scope="col">edit</th>
                <th scope="col">delete</th>
            </thead>            
            <tbody id="tbody">
                               
            </tbody>            
        </table>
        <div class="row">
    <div class="col-lg-6" >
        <nav>
           <ul class="pagination" id="enlacesPaginacion">
           </ul>
        </nav>
    </div>
    <div class="col-lg-5">
        <div class="float-right">
            <label for="selectRows">Rows in each page: </label>
            <select name="rows" class="form-control" id="selectRows">
                <option >2</option>
                <option >3</option>
                <option >5</option>
                <option selected>10</option>
            </select>
        </div>
    </div>
</div>
@endsection

@section('poststyle')
<link rel="stylesheet" href="{{ url('assets/backend/css/moneda.css') }}">
@endsection

@section('postscript')
<script src="{{ url('assets/backend/js/moneda.js?r=' . uniqid()) }}"></script>
@endsection



