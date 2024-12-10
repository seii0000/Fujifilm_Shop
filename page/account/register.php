<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>adiShop</title>
  <link rel="stylesheet" href="/Fujifilm_Shop/page/style.css"/>
  <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet"> -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
  <div id="header-placeholder"></div>
  <main>
    <div class="my-account-wrap">
        <div class="container">
            <div class="row">
                <div class="col-md-4 offset-md-4 col-sm-6 offset-dm-3 col-12">
                    <div id="auth-form" class="login-layout">
                        <div class="auth-heading">
                            <img src="/Fujifilm_Shop/images/logo/logo.png" alt="" srcset="">
                            <h1 class="mt-5"><span class="login-form-heading">ĐĂNG KÝ</span></h1>
                            <div class="auth-form-body">
                                <div class="login-form-body">
                                <form accept-charset="UTF-8" action="/account" id="create_customer" method="post">
                                    <div class="form-group">
                                        <label for="register-last-name">Họ của bạn*</label>
                                        <input type="text" id="register-last-name" class="form-control" name="customer[last_name]" required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="register-first-name">Tên của bạn*</label>
                                        <input type="text" id="register-first-name" class="form-control" name="customer[first_name]" required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="register-phone">Số điện thoại</label>
                                        <input type="text" id="register-phone" class="form-control" name="customer[phone]" pattern="^\+?\d{0,10}">
                                    </div>
                                    <div class="form-group">
                                        <label>Giới tính</label>
                                        <div class="row">
                                            <div class="col-6">
                                                <input class="bg-color-black" type="radio" id="register-gender-0" value="0" name="customer[gender]" checked=""> 
                                                <label for="register-gender-0">Nữ</label>
                                            </div>
                                            <div class="col-6">
                                                <input type="radio" id="register-gender-1" value="1" name="customer[gender]"> 
                                                <label for="register-gender-1">Nam</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="register-email">Email*</label>
                                        <input type="email" id="register-email" class="form-control" name="customer[email]" required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="register-password">Mật khẩu*</label>
                                        <input type="password" id="register-password" class="form-control" name="customer[password]" required="">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">
                                            ĐĂNG KÝ
                                        </button>
                                    </div>
                                    <div class="auth-back-btn">
                                        <a href="/Fujifilm_Shop/page/account/login.php">Đăng nhập</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </main>
  <div id="footer-placeholder"></div>
  <script src="/Fujifilm_Shop/js/loadHeaderFooter.js"></script>
  <script src="/Fujifilm_Shop/js/main.js"></script>
  <script src="/Fujifilm_Shop/js/loadHeaderFooter.js"></script>
</body>

</html>
