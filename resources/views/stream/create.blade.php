@extends('../layout')

@section('title') Create Stream @endsection

@section('content')


<h2 class="">Create stream</h2>
<a href="{{ url('/') }}">
    <button style="float: left; font-weight: 900;" class="btn btn-info btn-sm" type="button">Back</button>
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

<form action="{{url('stream/store')}}" method="POST" enctype="multipart/form-data">
    @method('POST')
    @csrf
    <div class="row">
        <div class='col-md-4'>

            <div class="form-group">
                <label for="inputTitle">Title</label>
                <input type="text" name="title" class="form-control" id="inputTitle" placeholder="Entry title" required="required">
            </div>

            <div class="form-group">
                <label for="inputDescription">Description</label>

                <textarea name="description" placeholder="Description..." id="inputDescription" class="form-control"></textarea>


            </div>
            <div class="form-group">
                <label for="inputPrice">Price</label>
                <input type="number" name="tokens_price" class="form-control" id="inputPrice" required="required">
            </div>

            <div class="form-group">

                <label for="inputType">Type</label>

                <select id="inputType" name="type_id" class="form-control">
                    <option value="" selected>Select Type....</option>
                    @foreach ( $Types as $type)
                    <option value="{{$type->id}}">{{$type->name}}</option>
                    @endforeach

                </select>

            </div>
            <div class="form-group">

                <label for="date_expiration">Date Expiration
                    <div class='input-group date' id='datetimepicker'>
                        <input type='text' name="date_expiration" id="date_expiration" class="form-control" required="required" />
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
            </div>

            <button type="submit" class="btn btn-primary">Create Stream</button>
        </div>
    </div>
</form>

<script type="text/javascript">

    $(document).ready(function() {
        $('#datetimepicker').datetimepicker();

    });
</script>
@endsection