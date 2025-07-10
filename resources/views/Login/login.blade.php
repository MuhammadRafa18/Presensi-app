<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Login</title>

    <style>
        body {
    height: 100%;
    margin: 0;
}

body {
    background-image: url("{{ asset('assets/img/jkt.jpg') }}");
    background-size: cover;
    background-position: center;
    backdrop-filter: blur(7px);
}


h1 {
    font-family: 'Open Sans', sans-serif;
    text-align: center;
    margin-bottom: 7%;
    text-transform: uppercase;

}




#bg {
    background-color: hsl(180, 100%, 90%);
}

#bg img {
    width: 25%;
    display: block;
    margin: auto;
    position: absolute;
    top: 35%;
    left: 25%;
    transform: translate(-50%, -50%);


}
h4 {
    display: block;
    margin: auto;
    position: absolute;
    top: 60%;
    left: 25%;
    transform: translate(-50%, -50%);
    color: black;

}
@media (max-width: 400px) {
.col-md-6 {
flex: 0 0 100%;
max-width: 100%;
}

.card-body {
padding: 2rem 1rem;
}

.card {
height: auto;
}

#bg img {
width: 25%;
top: 20%;
left: 50%;
transform: translate(-50%, -50%);
}

h4 {
width: 100%;
top: 60%;
left: 50%;
transform: translate(-50%, -50%);
text-align: center;
}
h5{
top: 50%;
}
}
.form-control {
    border-radius: 10px;
    padding: 10px;
}
.btn-rounded {
    border-radius: 20px; /* Sesuaikan dengan radius yang Anda inginkan */
}

.btn-block {
    width: 60%;
}


    </style>
</head>

<body>
    <section class=" d-flex justify-content-center align-items-center ">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10 ">
                    <div class="card" style="height: 100%; ">
                        <div class="row g-0 ">
                            <div class=" col-md-6 col-lg-6" id="warna">

                                <div id="bg" class="d-block   p-2 text-white h-100" style="">
                                    <img src="{{ asset('cn3.png') }}">
                                    <h4 class="mb-4" >Selamat Datang Di Aplikasi</h4>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">

                                    <form action="{{ route('login_proses') }}" method="POST">
                                        @csrf


                                        <h1>
                                            Login
                                        </h1>
                                        <h5 class="fw-normal mb-2 pb-2 text-left" >
                                            Silakan Masukan Akun Anda
                                        </h5>
                                        <div class="mb-4">
                                            <label class="form-label" for="form2Example17">Username</label>
                                            <input type="text" name="username" id="form2Example17" class="form-control" placeholder="Masukan Username">
                                            @error('username')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form2Example27">Password</label>
                                            <input type="password" name="password" id="form2Example27"
                                                class="form-control form-control-xl" placeholder="Masukan Password" />
                                            @error('password')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="pt-1 mb-4 text-center " >
                                            <button type="submit" class="btn btn-primary  btn-block btn-rounded ">Login</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if ($message = Session::get('success'))
        <script>
            const message = "{{ session('success') }}";
            Swal.fire({
                icon: "success",
                title: "Success",
                text: message,

            });
        </script>
    @endif
    @if ($message = Session::get('failed'))
        <script>
            const message = "{{ session('failed') }}"
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: message,

            });
        </script>
    @endif
    @if ($message = Session::get('error'))
        <script>
            const message = "{{ session('error') }}"
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: message,

            });
        </script>
    @endif


</body>

</html>
