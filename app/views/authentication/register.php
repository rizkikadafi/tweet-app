<div class="container">
    <div class="banner">
      <img src="<?= BASEURL; ?>/img/logo_unj.png" alt="">
      <h1>Data Sistem Akademik</h1>
    </div>
    <div class="form-login">
      <form action="" method="post">
        <h2 class="form-title">Registerasi Siakad</h2>
        <div class="input-wrapper">
          <div class="form-input">
            <img src="<?= BASEURL; ?>/img/account-circle.svg" alt="" class="input-icon">
            <input type="text" name="fullname" id="fullname" autocomplete="off" required>
            <span class="placeholder" name="placeholder">Nama Lengkap</span>
          </div>
          <div class="form-input">
            <img src="<?= BASEURL; ?>/img/account-circle.svg" alt="" class="input-icon">
            <input type="text" name="username" id="username" autocomplete="off" required>
            <span class="placeholder" name="placeholder">Username</span>
          </div>
          <div class="form-input">
            <img src="<?= BASEURL; ?>/img/password.svg" alt="" class="input-icon">
            <input type="password" name="password" id="password" autocomplete="off" required>
            <span class="placeholder" name="placeholder">Password</span>
          </div>
          <div class="form-input">
            <img src="<?= BASEURL; ?>/img/password.svg" alt="" class="input-icon">
            <input type="password" name="password2" id="password2" autocomplete="off" required>
            <span class="placeholder" name="placeholder">Konfirmasi password</span>
          </div>
          <button type="submit" name="register" class="submit-form">Registerasi</button>
        </div>

        <div class="login">
          <p>Sudah punya akun? <a href="<?= BASEURL; ?>/authentication/login">Login</a></p>
        </div>
      </form>
    </div>
  </div>