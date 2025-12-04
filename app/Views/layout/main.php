<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'LelanginAja' ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { background:#f7f9ff; font-family:'Poppins',sans-serif; }
        .section-title { font-size:24px;font-weight:700;margin-bottom:20px;color:#1E5EFF; }
        .card-lelang:hover { transform:scale(1.02);transition:.3s; }
    </style>
</head>

<body>

    <?= $this->include('layout/navbar') ?>

    <div class="container py-4">
        <?= $this->renderSection('content') ?>
    </div>

    <?= $this->include('layout/footer') ?>

</body>
</html>
