<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>adiShop</title>
    <link rel="stylesheet" href="/Fujifilm_Shop/page/style.css" />
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet"> -->
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
                        <h3>Hi, <b>Thành Hải</b></h3>
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
                    <div class="account-content-header">
                        <h1>Address List</h1>
                    </div>
                    <div class="account-content-body">
                        <div class="account-address-list">
                            <div class="account-address-item">
                                <div class="account-address-item-header">
                                    <h3>Home</h3>
                                    <div class="account-address-item-action">
                                        <a href="/account/addresses/edit/1">Edit</a>
                                        <a href="/account/addresses/delete/1">Delete</a>
                                    </div>
                                </div>
                                <div class="account-address-item-body">
                                    <p>Thành Hải</p>
                                    <p>123 Đường 3/2, Phường 12, Quận 10, TP.HCM</p>
                                    <p>0123456789</p>
                                </div>
                            </div>
                            <div class="account-address-item">
                                <div class="account-address-item-header">
                                    <h3>Work</h3>
                                    <div class="account-address-item-action">
                                        <a href="/account/addresses/edit/2">Edit</a>
                                        <a href="/account/addresses/delete/2">Delete</a>
                                    </div>
                                </div>
                                <div class="account-address-item-body">
                                    <p>Thành Hải</p>
                                    <p>456 Đường 3/2, Phường 12, Quận 10, TP.HCM</p>
                                    <p>0123456789</p>
                                </div>
                            </div>
                        </div>
                        <div class="account-address-add">
                            <a href="/account/addresses/add" class="btn btn-primary">Add new address</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="footer-placeholder"></div>
    <script src="/Fujifilm_Shop/js/loadHeaderFooter.js"></script>
    
</body>

</html>