<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Super Admin</title>
    <link rel="stylesheet" href="../../vendors/feather/feather.css">
    <link rel="stylesheet" href="../../vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../../vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../../css/vertical-layout-light/style.css">
    <link rel="shortcut icon" href="../../images/fitnesslogo.png" />
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            <div class="brand-logo">
                                <img src="../../images/fitnesslogo.png" alt="logo">
                            </div>
                            <form method="POST" action="{{ route('password.forgot') }}">
                                @csrf
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label>Email</label>
                                        <input type="email" class="form-control form-control-lg" name="email"
                                            required>
                                    </div>
                                </div>
                                <div class="row mb-12">
                                    <div class="col-md-12 offset-md-12">
                                        <button type="submit"
                                            class="btn btn-primary btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">Send
                                            OTP</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../../vendors/js/vendor.bundle.base.js"></script>
    <script src="../../js/off-canvas.js"></script>
    <script src="../../js/hoverable-collapse.js"></script>
    <script src="../../js/template.js"></script>
    <script src="../../js/settings.js"></script>
    <script src="../../js/todolist.js"></script>
</body>

</html>
<style>
    .btn-primary,
    .wizard>.actions a {
        color: #fff;
        background-color: #6DA12F;
        border-color: #6DA12F;
    }
</style>
