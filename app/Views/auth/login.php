<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - LelanginAja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body{
            background:#eef3ff;
            height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            font-family:'Poppins', sans-serif;
        }
        .card{
            width:400px;
            background:white;
            border-radius:15px;
            padding:35px;
            box-shadow:0 10px 25px rgba(0,0,0,.08);
        }
        input{
            height:45px;
            border:1px solid #d9dff0;
        }
        input:focus{
            border-color:#1E5EFF;
            box-shadow:0px 0px 4px rgba(30,94,255,.4);
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
            width:60px;height:60px;border-radius:50%;
            background:#1E5EFF;color:#fff;font-weight:700;
            display:flex;justify-content:center;align-items:center;
            font-size:22px;margin:auto;margin-bottom:15px;
        }
        a{color:#1E5EFF;text-decoration:none;}
        a:hover{text-decoration:underline;}
    </style>
</head>

<body>

<div class="card">

    <div class="logo-circle">LJ</div>
    <h3 class="text-center fw-bold text-primary">Selamat Datang!</h3>
    <p class="text-center text-secondary mb-4">Login untuk mulai melelang dan bidding</p>

    <?php if(session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif ?>

    <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif ?>

    <form action="/login/process" method="POST">

        <div class="mb-3">
            <label class="fw-semibold">Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>

        <div class="mb-2">
            <label class="fw-semibold">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button class="btn btn-primary w-100 mt-3">Login</button>

        <p class="text-center mt-3">Belum punya akun? <a href="/register">Daftar</a></p>
    </form>

</div>

</body>
</html>
