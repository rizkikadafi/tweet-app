# Info

- BASEURL: http://localhost/uas-project/public
- BASEURL/controller/method
- Note:
  - Default controller: *home*
  - Default method: *index*
  - Jadi pas akses public langsung ke *home/index*
  - tapi kalo ngga ada session di lempar ke *authentication/login*
 
# Usage
## Static file
- Semua static file di taro dalem folder public
- misal ambil gambar:
```php
BASEURL . '/img/nama-gambar.png'
```
- kalo di embed di html:
```php
<img src="<?= BASEURL; ?>/img/nama-gambar.png">
```

## Views
- Buat tampilan ada di folder *views*
- isinya semua yg ada dalem body (tag body ga ush)
- header sama footer html ada di folder *templates*
- header buat metadata, bootstrap, dll
- footer buat bootstrap, js, dll

## Controller
- Buat controller ada di folder *controllers*
- file untuk controller, huruf awal kapital: *Home.php*
- Isi controller:
```php
<?php 
class NamaController extends Controller {
  // Default method untuk controller ini (wajib ada)
  public function index() {
    $data['title'] = 'homepage'; // title tab
    // file css di taro di public/css
    $data['styles'] = ['file.css', file2.css];
    $this->view('templates/header', $data); // wajib ada
    $this->view('home/index'); // manggil file index yang ada di folder views/home
    $this->view('templates/footer'); // wajib ada
  }
}
```
## Contoh
- misal mao bikin post
- di post, kita bisa upload, edit, atau delete post
- jadi controllernya Post, methodnya ada index (defaultnya), upload, edit, delete
- kalo misalkan uploadnya mao jadi default buat controller Post, tinggal panggil method upload di index
- di url:
  - ```BASEURL/post```
otomatis manggil controller Post dengan method defaultnya
  - ```BASEURL/post/upload```
manggil controller post dengan method upload

