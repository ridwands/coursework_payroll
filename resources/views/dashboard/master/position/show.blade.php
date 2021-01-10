@extends('dashboard.layouts.master')
@section('title',$data['title'])
@section('breadcrumb')

<div class="breadcrumb">
    <ul>
        <li><a href="#">{{$data['menu']}}</a></li>
        <li>{{$data['sub_menu']}}</li>
    </ul>
</div>
@stop
@section('content')
<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card text-left">
            <div class="card-body">
                <button id="btn_item_modal" class="btn btn-sm btn-primary"><i class="fa fa-plus"
                        aria-hidden="true"></i> Add Position</button>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-12 mb-4">
        <div class="card text-left">
            <div class="card-body">
                <h4 class="card-title mb-3">{{$data['table_title']}}</h4>
                <!-- <p>DataTables has most features enabled by default, so all you need to do to use it with your own ables
                    is to call the construction function: $().DataTable();.</p> -->
                <div class="table-responsive">
                    <table class="display table table-striped table-bordered" id="table-data" style="width:100%">

                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Position Code</th>
                                <th>Positition Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="item_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Input Position</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="item_form">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-md-12 form-group mb-3">
                            <label>Position Code</label>
                           <input type="text" class="form-control" name="p_code"/>
                        </div>
                        <div class="col-md-12 form-group mb-3">
                            <label>Position Name</label>
                           <input type="text" class="form-control" name="p_name"/>
                        </div>
                       
                    </div>
                   
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn-save btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

@stop
@push('js')
<script>
    var table = $('#table-data').DataTable({
        pageLength: 5,
        processing: true,
        serverSide: true,
        // "lengthChange": false,
        // searching: false,
        ajax: "/position/json",
        columns: [{
                "data": "no",
            },
            {
                "data": "position_code",
            },
            {
                "data": "position_name",
            }
        ],
        columnDefs: [{
                targets: 3,
                render: function (data, type, row, meta) {
                    return "<button onclick='delete_data(`"+row.position_code+"`)' class='btn btn-sm btn-primary'><i class='fa fa-trash' aria-hidden='true'></i></button>";
                }
            }],
    });

    $('#btn_item_modal').on('click', function () {
        $('#item_form').trigger("reset");
        $('#item_modal').modal('show');
    })

    $('#item_form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: "/position",
            method: "POST",
            data: new FormData(this),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $('.btn-save').attr("disabled", true);
                $('.btn-save').html("Loading...");
            },
            success: function (res) {
                // return console.log(res)
                if (res.code == 2200) {
                    // window.location = "/"
                    toastr.success(res.message)
                    table.ajax.reload();
                    $('#item_modal').modal('hide')
                    $('.btn-save').attr("disabled", false);
                    $('.btn-save').html("Submit");
                } else {
                    toastr.error(res.message)
                    $('.btn-save').attr("disabled", false);
                    $('.btn-save').html("Submit");
                }
            },
            error: function () {
                toastr.error('Check Your Internet Connection')
                $('.btn-save').attr("disabled", false);
                $('.btn-save').html("Submit");
            }
        })
    })

    function delete_data(id) {
    // return console.log(id)
    swal({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#0CC27E',
        cancelButtonColor: '#FF586B',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        confirmButtonClass: 'btn btn-success mr-5',
        cancelButtonClass: 'btn btn-danger',
        buttonsStyling: false
    }).then(function() {

        $.ajax({
            url: "/position/delete?position_code=" + id,
            method: "GET",
            success: function(response) {
                console.log(response)
                if (response.code == 200) {
                    table.ajax.reload();
                    swal('Deleted!', response.message, 'success');
                }
            },
        });
    }, function(dismiss) {
        // dismiss can be 'overlay', 'cancel', 'close', 'esc', 'timer'
        if (dismiss === 'cancel') {
            swal('Cancelled', 'The Position file is safe :)', 'error');
        }
    });
}
    </script>
    @endpush
