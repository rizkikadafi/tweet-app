<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $data['title'] ?? 'Document' ?></title>
  <?php foreach($data['styles'] ?? [] as $style) : ?>
    <link rel="stylesheet" href="<?= BASEURL; ?>/css/<?= $style; ?>">
  <?php endforeach ?>
</head>
<body>