document.addEventListener("DOMContentLoaded", function() {
    fetch('/Fujifilm_Shop/page/header.html')
      .then(response => response.text())
      .then(data => {
        document.getElementById('header-placeholder').innerHTML = data;
      });
  
    fetch('/Fujifilm_Shop/page/footer.html')
      .then(response => response.text())
      .then(data => {
        document.getElementById('footer-placeholder').innerHTML = data;
      });
  });