@extends('app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    Oops! We have some erros
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(Session::has('message'))
                <div class="alert alert-success">
                  {!!Session::get('message')!!}
                </div>
            @endif
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            
            <h2>Bulk edit</h2>
            {!! Form::open(['action' => 'ConceptosController@bulk_update', 'method' => "POST", "class"=>"form-inline"]) !!}
            <div class="form-group">
                <label for="lead_status">For selected rows change filed </label>
                {!! Form::select('bulk_clave_sat', $concepto_columns, [], ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                <label for="lead_status">equal to</label>
                {!! Form::text('bulk_concepto', null, ['class' => 'form-control'])!!}
            </div>
            <button class="btn btn-default">Save</button>
            <hr>
            <table class="table table-striped">
            @foreach($test as $t)
                <tr>
                    <td><td width="10px"><input type="checkbox" name="ids_to_edit[]" value="{{$t->id}}" /></td></td>
                    <td>{{$t->id}}</td>
                    <td><a href="#" class="testEdit" data-type="text" data-column="clave_sat" data-url="{{route('test/update', ['id'=>$t->id])}}" data-pk="{{$t->id}}" data-title="change" data-name="clave_sat">{{$t->clave_sat}}</a></td>
                    <td><a href="#" class="testEdit" data-type="text" data-column="concepto"  data-url="{{route('test/update', ['id'=>$t->id])}}" data-pk="{{$t->id}}" data-title="change" data-name="concepto">{{$t->concepto}}</a></td>
                </tr>
            @endforeach
            </table>
            {!! Form::close() !!}
            
            
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
$.fn.editable.defaults.mode = 'inline';
$(document).ready(function() {
    $('.testEdit').editable({
        params: function(params) {
            // add additional params from data-attributes of trigger element
            params.name = $(this).editable().data('name');
            return params;
        },
        error: function(response, newValue) {
            if(response.status === 500) {
                return 'Server error. Check entered data.';
            } else {
                return response.responseText;
                // return "Error.";
            }
        }
    });
});
</script>
@endsection
