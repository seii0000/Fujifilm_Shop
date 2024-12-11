document.addEventListener("DOMContentLoaded", function() {
    // Lấy tất cả các tab liên quan đến form
    const tabLinks = document.querySelectorAll('.nav-link');
    const tabPanes = document.querySelectorAll('.tab-pane');
    
    // Xử lý sự kiện khi nhấn vào các tab
    // Đặt tab đầu tiên luôn được active khi mở login form
    tabLinks[0].classList.add('active');
    tabPanes[0].classList.add('active', 'show');

    tabLinks.forEach(tab => {
      tab.addEventListener('click', function(event) {
      event.preventDefault(); // Ngăn chặn hành vi mặc định của thẻ a khi click vào nó
      
      // Loại bỏ class 'active' và 'show' khỏi tất cả các tab
      tabLinks.forEach(link => {
        link.classList.remove('active');
      });
      tabPanes.forEach(pane => {
        pane.classList.remove('active', 'show');
      });
      
      // Thêm class 'active' vào tab vừa được click
      tab.classList.add('active');
      
      // Lấy ID của tab đã chọn
      const targetTabId = tab.getAttribute('href').substring(1); // Lấy id của tab (bỏ dấu '#')
      
      // Thêm class 'active' và 'show' vào tab-pane tương ứng
      const targetTabPane = document.getElementById(targetTabId);
      targetTabPane.classList.add('active', 'show');
      });
    });
  

  // Get the button
  let mybutton = document.getElementById("btn-back-to-top");

  // When the user scrolls down 20px from the top of the document, show the button
  window.onscroll = function () {
    scrollFunction();
  };

  function scrollFunction() {
    if (
      document.body.scrollTop > 20 ||
      document.documentElement.scrollTop > 20
    ) {
      mybutton.style.display = "block";
    } else {
      mybutton.style.display = "none";
    }
  }

  // When the user clicks on the button, scroll to the top of the document
  mybutton.addEventListener("click", backToTop);

  function backToTop() {
    window.scrollTo({
      top: 0,
      behavior: "smooth"
    });
  }

  
});