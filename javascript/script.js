
/*Dark Mode*/
localStorage.setItem('darkmode', window.matchMedia("(prefers-color-scheme: dark)").matches);
const element = document.body;
element.classList.toggle('dark-mode', window.matchMedia("(prefers-color-scheme: dark)").matches);

/*Preview Uploaded images*/
document.getElementById('fileInput').addEventListener('change', function() {
    var file = this.files[0];
    var reader = new FileReader();
  
    reader.onload = function(e) {
      var previewImage = document.getElementById('previewImage');
      previewImage.src = e.target.result;
      previewImage.style.display = 'block';
    };
  
    reader.readAsDataURL(file);
  });
