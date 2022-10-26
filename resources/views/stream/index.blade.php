@extends('../layout')

@section('title') Create Stream @endsection

@section('style')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="https://datatables.net/media/css/site-examples.css">

@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
        </div>
        <div class="col-md-12">
           
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <div><h2>All Streams</h2></div>
                    </div>
                   <div>
                    <a href="{{ url('stream/create') }}">
                        <button style="float: right; font-weight: 900;" class="btn btn-info btn-sm" type="button">Create Stream </button>
                    </a>
                  </div>
                    <div class="table-responsive" style="margin-top:35px ;margin-right:15px; width:100%">
                        <table class="table table-bordered datatable" id="datatable_streams" style=" width:100%">
                            <thead>
                                <tr>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Delete Modal --}}
            <div class="modal fade" id="DeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Delete Student Data</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h4>Confirm to Delete Data ?</h4>
                            <input type="hidden" id="deleteing_id">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary delete_student">Yes Delete</button>
                        </div>
                    </div>
                </div>
            </div>
            {{-- End - Delete Modal --}}
        </div>
    </div>
</div>


@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

@endsection

<script type="text/javascript">
    $(document).ready(function() {
        let table;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        table = $('#datatable_streams').DataTable({
            destroy: true,
            "lengthChange": false,
            "processing": true,
            "serverSide": false,
            "bFilter": true,
            "searching": true,
            ajax: '{{ route("stream.getAll") }}',
            columns: [{
                    "title": "ID:",
                    "data": "id",
                },
                {
                    "title": "Title",
                    "data": "title",
                },
                {
                    "title": "Description",
                    "data": "description",
                },
                {
                    "title": "Price",
                    "data": "tokens_price",
                },
                {
                    "title": "Type",
                    "data": "type.name",
                },
                {
                    "title": "Date Expiration",
                    "data": "date_expiration",
                },
                {
                    "title": "Action",
                    "render": function(data, type, row) {

                        return '<button type="button" id="edit_stream" value="' + row.id + '" data-id="' + row.id + '" class="btn btn-success">Edit</button><button type="button" id="delete_stream" value="' + row.id + '" data-id="' + row.id + '" class="btn btn-danger">Delete</button>';

                    }
                },
            ],
        });

        $('#datatable_streams').on('click', '#edit_stream', function(e) {
            e.preventDefault();
            var stream_id = $(this).attr("data-id");

            document.location.href = `stream/edit/${stream_id}`;

        });

        $('#datatable_streams').on('click', '#delete_stream', function(e) {
            e.preventDefault();
            var stream_id = $(this).attr("data-id");

            $.ajax({
                url: `stream/delete/${stream_id}`,
                type: "GET",
                success: function(data) {
                 
                    alert('Stream is Deleted successfully');
                    table.ajax.reload();
                  
                },
                error: function() {
                    alert("There was an error. Try again please!");
                },
            });
        });

    });
</script>

@endsection