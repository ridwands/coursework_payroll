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
                <button id="btn_att_modal" class="btn btn-sm btn-primary"><i class="fa fa-plus"
                        aria-hidden="true"></i> Add Atteendance</button>
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
                                <th>NIK</th>
                                <th>Time IN</th>
                                <th>Time Out</th>
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

<div class="modal fade" id="att_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Input Attendance</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="att_form">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-md-12 form-group mb-3">
                            <label>NIK</label>
                            <select style="width: 100%;" name="nik" class="form-control select2">
                                <option>--Choose--</option>
                                @foreach ($data['m_employees'] as $item)
                                <option value="{{$item->nik}}">
                                    {{$item->nik}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12 form-group mb-3">
                            <label>Date</label>
                            <input type="text" readonly name="date" required autocomplete="off"
                                placeholder="Date" value="{{date('Y-m-d')}}" class="form-control" />
                        </div>
                        <div class="col-md-12 form-group mb-3">
                            <label>Time IN</label>
                            <input type="time" name="time_in" required autocomplete="off"
                                placeholder="Time IN" class="form-control" />
                        </div>
                        <div class="col-md-12 form-group mb-3">
                            <label>Time Out</label>
                            <input type="time" name="time_out" required autocomplete="off"
                            placeholder="Time Out" class="form-control" />
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
        "lengthChange": false,
        searching: false,
        ajax: "/attendance/json",
        columns: [{
                "data": "no",
            },{
                "data": "nik",
            },
            {
                "data": "time_in",
            },
            {
                "data": "time_out",
            },
        ],
    });

    $('#btn_att_modal').on('click', function () {
        $('#att_form').trigger("reset");
        $('#att_modal').modal('show');
    })

    $('#att_form').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            url: "/attendance",
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
                    $('#att_modal').modal('hide')
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
    </script>
    @endpush