const imageInput = document.getElementById('imageInput');
const imageLink = document.querySelector('#image-link');

Array.from(imageLink.children).forEach(element => {
  element.addEventListener('click', function() {
    imageInput.click();
  });
});

imageInput.addEventListener('change', function() {
  const fileInfo = this.files[0];
  const alowedType = ['image/jpg', 'image/jpeg', 'image/png'];
  console.log(fileInfo);
  console.log(fileInfo.type in alowedType);

  if (!(alowedType.includes(fileInfo.type))) {
    appendAlert('Tipe file tidak valid!', 'warning')
    return;
  } else if ((fileInfo.size / 1000) > 500) {
    appendAlert('Ukuran gambar harus dibawah 500kb', 'warning')
    return;
  }

  const fr = new FileReader();
  const imageTarget = document.querySelector('#image-link img');
  fr.onload = function() { imageTarget.src = this.result; };
  fr.readAsDataURL(fileInfo);
});

const alertPlaceholder = document.getElementById('upload-alert')
const appendAlert = (message, type) => {
  const wrapper = document.createElement('div')
  wrapper.innerHTML = [
    `<div class="alert alert-${type} alert-dismissible" role="alert">`,
    `   <div>${message}</div>`,
    '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
    '</div>'
  ].join('')

  alertPlaceholder.append(wrapper)
}
