<h1 class="text-center">Halaman Home</h1>

<img src='<?= $data['user']['picture']; ?>' class="rounded-circle border border-secondary p-1 mx-auto d-block">
<h2 class="text-center"><?= $data['user']['name']; ?></h2>

<a href="<?= BASEURL ?>/logout" type="button" class="btn btn-primary mx-auto">Logout</a>
