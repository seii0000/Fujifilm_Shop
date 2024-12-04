document.addEventListener("DOMContentLoaded", function() {
  fetch('/Fujifilm_Shop/page/header.html')
    .then(response => {
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      return response.text();
    })
    .then(data => {
      document.getElementById('header-placeholder').innerHTML = data;
    })
    .catch(error => {
      console.error('There was a problem with the fetch operation:', error);
    });

  fetch('/Fujifilm_Shop/page/footer.html')
    .then(response => {
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      return response.text();
    })
    .then(data => {
      document.getElementById('footer-placeholder').innerHTML = data;
    })
    .catch(error => {
      console.error('There was a problem with the fetch operation:', error);
    });
});