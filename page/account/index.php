<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>adiShop</title>
    <link rel="stylesheet" href="/Fujifilm_Shop/page/style.css" />
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div id="header-placeholder"></div>
    <div id="account-page">
        <div class="container">
            <div class="account-page-wrap mt-5">
                <div class="account-page-sidebar">
                    <div class="account-sidebar-header">
                        <div class="account-sidevar-avatar">
                            <img src="/Fujifilm_Shop/img/avatar.png" alt="avatar" />
                        </div>
                        <h3>Hi, <b id="user-name"></b></h3>
                    </div>
                    <div class="mt-5 account-sidebar-menu">
                        <ul>
                            <li><a href="/account" class="active">Account information</a></li>
                            <li><a href="/account?view=orders">Purchase history</a></li>
                            <li><a href="/account/addresses">Address List</a></li>
                            <li><a href="/account/logout">Log out</a></li>
                        </ul>
                    </div>
                </div>
                <div class="account-page-content">
                    <h1>
                        <span>Thông tin tài khoản</span>
                        <a href="/Fujifilm_Shop/page/account/update_user.php" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                    </h1>
                    <div class="account-page-detail account-page-info">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Họ tên</td>
                                        <td id="full_name"></td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td id="email"></td>
                                    </tr>
                                    <tr>
                                        <td>Số điện thoại</td>
                                        <td id="phone_number"></td>
                                    </tr>
                                    <tr>
                                        <td>Địa chỉ</td>
                                        <td id="address"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="footer-placeholder"></div>
    <script src="/Fujifilm_Shop/js/loadHeaderFooter.js"></script>
    <script>
        // Fetch user data from the server
        fetch('/Fujifilm_Shop/api/get_user_data.php')
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    // Update the HTML with the user data
                    document.getElementById('user-name').textContent = data.data.username;
                    document.getElementById('full_name').textContent = data.data.full_name;
                    document.getElementById('email').textContent = data.data.email;
                    document.getElementById('phone_number').textContent = data.data.phone_number;
                    document.getElementById('address').textContent = data.data.address;
                } else {
                    // Display error message
                    document.getElementById('error-message').textContent = data.message;
                    document.getElementById('error-message').style.display = 'block';
                }
            })
            .catch(error => {
                console.error('Error fetching user data:', error);
                document.getElementById('error-message').textContent = 'An error occurred while fetching user data.';
                document.getElementById('error-message').style.display = 'block';
            });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>