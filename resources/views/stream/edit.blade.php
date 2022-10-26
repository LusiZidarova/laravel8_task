
@extends('../layout')

@section('title') Edit Stream @endsection

@section('content')

<h2 class="">Update Stream</h2>

<a href="{{ url('/') }}" >
    <button  class="btn btn-info btn-sm" type="button">Go Back </button>
</a>

@if ($errors->any())
<div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<form action="{{route('stream.update',$stream->id)}}" method="POST" enctype="multipart/form-data">
    @method('POST')
    @csrf
    <div class="row">
        <div class='col-md-4'>

            <div class="form-group">
                <label for="inputTitle">Title</label>
                <input type="text" name="title" value="{{$stream->title}}" class="form-control" {{ old('title') }} id="inputTitle" placeholder="Entry title" required="required">
            </div>

            <div class="form-group">
                <label for="inputDescription">Description</label>

                <textarea name="description"  placeholder="Description..." id="inputDescription" class="form-control">{{$stream->description}}</textarea>


            </div>
            <div class="form-group">
                <label for="inputPrice">Price</label>
                <input type="number" name="tokens_price"  value="{{$stream->tokens_price}}" class="form-control" id="inputPrice" required="required">
            </div>

            <div class="form-group">

                <label for="inputType">Type</label>

                <select id="inputType" name="type_id" class="form-control">
                    <option value="" selected>Select Type....</option>
                    @foreach ( $types as $type)
                    <option value="{{$type->id}}" {{($type->name === $stream->type->name) ? 'Selected' : ''}}>{{$type->name}}</option>
                 
                    @endforeach

                </select>

            </div>
            <div class="form-group">

                <label for="date_expiration">Date Expiration
                    <div class='input-group date' id='datetimepicker'>
                        <input type='text'  value="{{$stream->date_expiration}}" name="date_expiration" id="date_expiration" class="form-control" required="required" />
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
            </div>

            <button type="submit" class="btn btn-primary">Update Stream</button>
        </div>
    </div>
</form>

<script type="text/javascript">

function goBack() {
            window.history.back();
        }
    $(document).ready(function() {
        $('#datetimepicker').datetimepicker();
    
    });
</script>
@endsection