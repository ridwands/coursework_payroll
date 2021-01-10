<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{env('APP_NAME')}} | Signin</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet">
    <link href="/assets//css/themes/lite-purple.min.css" rel="stylesheet">
    <!-- toastr -->
    <link rel="stylesheet" href="/assets/css/plugins/toastr.css" />
</head>
<div class="auth-layout-wrap" style="background-image: url(https://jurnalindonesiabaru.com/wp-content/uploads/2018/12/squareblur_201812921573243-155026879.jpg)">
    <div class="auth-content">
        <div class="card o-hidden">
            <div class="row">
                <div class="col-md-6">
                    <div class="p-4">
                        <div class="auth-logo text-center mb-4"><img src="https://1.bp.blogspot.com/-KBPO2OTYEsY/Xgv5PTMf7NI/AAAAAAAABbE/vDmxGALTm_wE2x50ra5oTMhUYrsYMuVtACLcBGAsYHQ/s1600/Logo%2BUniversitas%2BPelita%2BBangsa.png" alt=""></div>
                        <h1 class="mb-3 text-18">Sign In</h1>
                        <form id="login_form">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input class="form-control form-control-rounded" id="email" name="email" required
                                    type="email">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input class="form-control form-control-rounded" name="password" id="password"
                                    type="password">
                            </div>
                            <button class="btn-save btn btn-rounded btn-primary btn-block mt-2">Sign In</button>
                        </form>
                        <!-- <div class="mt-3 text-center"><a class="text-muted" href="forgot.html">
                                <u>Forgot Password?</u></a></div> -->
                    </div>
                </div>
                <div class="col-md-6 text-center"
                    style="background-size: cover;background-image: url(/assets//images/photo-long-3.jpg)">
                    <div class="pr-3 auth-right"><a
                            class="btn btn-rounded btn-outline-primary btn-outline-email btn-block btn-icon-text"
                            href="#"><i class="i-Mail-with-At-Sign"></i> Sign up with Email</a><a
                            class="btn btn-rounded btn-outline-google btn-block btn-icon-text"><i
                                class="i-Google-Plus"></i> Sign up with Google</a><a
                            class="btn btn-rounded btn-block btn-icon-text btn-outline-facebook"><i
                                class="i-Facebook-2"></i> Sign up with Facebook</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/assets/js/plugins/jquery-3.3.1.min.js"></script>
<!-- toastr -->
<script src="/assets/js/plugins/toastr.min.js"></script>
<script src="/assets/js/scripts/toastr.script.min.js"></script>
<script>
$('#login_form').on('submit', function(e) {
    e.preventDefault();

    // return console.log('tes')
    $.ajax({
        url: "/login",
        method: "POST",
        data: new FormData(this),
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
            $('.btn-save').attr("disabled", true);
            $('.btn-save').html("Loading...");
        },
        success: function(res) {
            // return console.log(res)
            if (res.code == 2200) {
                // window.location = "
                location.href = "/attendance"
                $('.btn-save').attr("disabled", false);
                $('.btn-save').html("Submit");
            } else {
                toastr.error(res.message)
                $('.btn-save').attr("disabled", false);
                $('.btn-save').html("Submit");
            }
        },
        error: function() {
            toastr.error('Check Your Internet Connection')
            $('.btn-save').attr("disabled", false);
            $('.btn-save').html("Submit");
        }
    })
})
</script>