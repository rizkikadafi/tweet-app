<h1 class="text-center">Halaman Home</h1>

<h2 class="text-center"><?= $data['user']['username']; ?></h2>
<h2 class="text-center"><?= $data['user']['email']; ?></h2>


<a href="<?= BASEURL ?>/logout" type="button" class="btn btn-primary mx-auto">Logout</a>
