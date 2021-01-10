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
                <form target="_blank" id="report_form" action="/report/pdf">
                   
                    <div class="row">
                        <div class="col-md-12 form-group mb-3">
                            <label>Choose Month</label>
                            <select style="width: 100%;" name="month" class="form-control select2">
                                <option>--Choose--</option>
                                <option value="01">January</option>
                                <option value="02">Februari</option>
                                <option value="03">Maret</option>
                                <option value="04">April</option>
                                <option value="05">Mei</option>
                                <option value="06">Juni</option>
                                <option value="07">Juli</option>
                                <option value="08">Agustus</option>
                                <option value="09">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                            <option value="12">Desember<option>
                            </select>
                        </div>
                        <div class="col-md-12 form-group mb-3">
                            <label>Choose Year</label>
                            <select style="width: 100%;" name="year" class="form-control select2">
                                    <option>--Choose--</option>
                                    <option value="2020">2020</option>
                                    <option value="2021">2021</option>
                                </select>
                        </div>
                        <div class="col-md-12 form-group mb-3">
                                <button type="submit" class="btn-save btn btn-sm btn-primary">Submit</button>
                        </div>
                       
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
@push('js')
<script>
  
    // $('#report_form').on('submit', function (e) {
    //     e.preventDefault();

    //     $.ajax({
    //         url: "/report/pdf",
    //         method: "POST",
    //         data: new FormData(this),
    //         dataType: 'JSON',
    //         contentType: false,
    //         cache: false,
    //         processData: false,
    //         beforeSend: function () {
    //             $('.btn-save').attr("disabled", true);
    //             $('.btn-save').html("Loading...");
    //         },
    //         success: function (res) {
    //             // return console.log(res)
    //             if (res.code == 2200) {
    //                 // window.location = "/"
    //                 toastr.success(res.message)
    //                 $('.btn-save').attr("disabled", false);
    //                 $('.btn-save').html("Submit");
    //             } else {
    //                 toastr.error(res.message)
    //                 $('.btn-save').attr("disabled", false);
    //                 $('.btn-save').html("Submit");
    //             }
    //         },
    //         error: function () {
    //             toastr.error('Check Your Internet Connection')
    //             $('.btn-save').attr("disabled", false);
    //             $('.btn-save').html("Submit");
    //         }
    //     })
    // })


</script>
@endpush
