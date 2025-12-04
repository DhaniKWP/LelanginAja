<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Akun - LelanginAja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background:#f4f7ff;
            height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            font-family: 'Poppins', sans-serif;
        }
        .card{
            width:420px;
            border-radius:15px;
            border:none;
            padding:35px;
            background:white;
            box-shadow:0 8px 25px rgba(0,0,0,.08);
        }
        .title{
            font-weight:700;
            color:#1E5EFF;
        }
        input{
            border:1px solid #d8deee;
            height:45px;
        }
        input:focus{
            border-color:#1E5EFF;
            box-shadow:0 0 4px rgba(30,94,255,.4);
        }
        .btn-primary{
            background:#1E5EFF;
            border:none;
            height:45px;
            font-weight:600;
        }
        .btn-primary:hover{
            background:#0D47A1;
        }
        .logo-circle{
            width:60px;height:60px;
            border-radius:50%;
            background:#1E5EFF;
            display:flex;justify-content:center;align-items:center;
            color:white;font-size:24px;font-weight:700;
            margin:auto;
            margin-bottom:15px;
        }
        a{color:#1E5EFF;text-decoration:none;}
        a:hover{text-decoration:underline;}
    </style>
</head>

<body>

<div class="card">
    <div class="logo-circle">LJ</div>
    <h3 class="text-center title mb-1">LelanginAja</h3>
    <p class="text-center text-secondary mb-4">Daftar untuk mulai mengikuti lelang</p>

    <?php if(session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif ?>

    <form action="/register/process" method="POST">

        <div class="mb-3">
            <label class="fw-semibold">Nama Lengkap</label>
            <input type="text" name="nama" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="fw-semibold">Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="fw-semibold">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="fw-semibold">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button class="btn btn-primary w-100 mt-2">Daftar</button>

        <p class="text-center mt-3">Sudah punya akun? <a href="/login">Login</a></p>
    </form>
</div>

</body>
</html>
