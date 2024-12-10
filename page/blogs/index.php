<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "camera_shop";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch blog data
$sql = "SELECT * FROM news ORDER BY published_date DESC";
$result = $conn->query($sql);
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>adiShop</title>
    <link rel="stylesheet" href="/Fujifilm_Shop/page/style.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <script script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
  <body>
    <div id="header-placeholder"></div>

    <div id="blog">
	
      <div style="padding: 10px 10px; margin-bottom: 20px;" class="breadcrumb-wrap container container-xl">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a style="color: #333; text-decoration: none;" href="/Fujifilm_Shop/page">Trang chủ</a></li>
          <li class="breadcrumb-item active"><span>Blog - Tin Tức</span></li>
        </ol>
      </div>
        <div class="blogMain">
            <div class="container"> 
                <div class="blogMainContent">
                    <div class="blogMainContentLeft">
                        <div class="blogBody"> 
                            <div class="blogListArticle">
                                <?php
                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        echo '<article class="blogLoop">';
                                        echo '<div class="blogWrapper">';
                                        echo '<div class="blogImage">';
                                        echo '<a href="/Fujifilm_Shop/page/blogs/' . $row["news_id"] . '.html" class="blogImageLink" title="' . $row["title"] . '" rel="nofollow">';
                                        echo '<img src="/Fujifilm_Shop/images/gallery/blog/' . $row["news_id"] . '.jpg" class="img-fluid ls-is-cached lazyloaded" alt="' . $row["title"] . '">';
                                        echo '</a>';
                                        echo '<div class="blogDetail">';
                                        echo '<div class="blogDetailPost">';
                                        echo '<span class="blogDetailAuthor"><i class="lni lni-user"></i> <span>Người viết: ' . $row["author"] . '</span></span>';
                                        echo '<span class="blogDetailDate"> / <i class="lni lni-calendar"></i><time datetime="' . $row["published_date"] . '">' . date("d.m.Y", strtotime($row["published_date"])) . '</time></span>';
                                        echo '</div>';
                                        echo '<h3 class="blogDetailName">';
                                        echo '<a href="/Fujifilm_Shop/page/blogs/' . $row["news_id"] . '.html" title="' . $row["title"] . '">' . $row["title"] . '</a>';
                                        echo '</h3>';
                                        echo '<p class="blogDetailDescription">' . substr($row["content"], 0, 150) . '...</p>';
                                        echo '<a class="blogDetailLink" href="/Fujifilm_Shop/page/blogs/' . $row["news_id"] . '.html">Xem chi tiết <i class="lni lni-arrow-right"></i></a>';
                                        echo '</div>';
                                        echo '</div>';
                                        echo '</div>';
                                        echo '</article>';
                                    }
                                } else {
                                    echo "No blogs found.";
                                }
                                $conn->close();
                                ?>
                            </div>

                              
                        </div>
                    </div>
                    <div class="blogMainContentRight">
                        <section id="blogSideBar">
                            <div style="margin-bottom: 25px;" class="blogSidebarMenu">
                                <h2>Tin tức</h2>
                                <ul>
                                    <li><a href="/blogs/bo-suu-tap">Bộ Sưu Tập</a></li>
                                    <li><a href="/blogs/news">Tin tức</a></li>
                                </ul>
                            </div>
                            <div class="blogSidebarRecent">
                                <h2>Tin tức khác</h2>
                                <article class="blogWrapper">
                                    <div class="blogImage">
                                        <a href="/blogs/news/gfx100sii-va-gf500mmf56rlmoiswr-chupanhthethao" class="blogImageLink" title="Khám phá thế giới thể thao cùng GFX100S II và GF500mmF5.6 R LM OIS WR với Russell Ord" rel="nofollow">
                                            <img src="//file.hstatic.net/200000396087/article/910_b7f83182009c42aab18c4875dcc3ae7b_grande.jpg" class="img-fluid ls-is-cached lazyloaded" data-src="//file.hstatic.net/200000396087/article/910_b7f83182009c42aab18c4875dcc3ae7b_grande.jpg" alt="Khám phá thế giới thể thao cùng GFX100S II và GF500mmF5.6 R LM OIS WR với Russell Ord">
                                        </a>
                                        <div class="blogDetail">
                                            <h3 class="blogDetailName">
                                                <a style="font-weight: bold;" href="/blogs/news/gfx100sii-va-gf500mmf56rlmoiswr-chupanhthethao" title="Khám phá thế giới thể thao cùng GFX100S II và GF500mmF5.6 R LM OIS WR với Russell Ord">Khám phá thế giới thể thao cùng GFX100S II và GF500mmF5.6 R LM OIS WR với Russell Ord</a>
                                            </h3>
                                            <div class="blogDetailPost">   
                                                <span class="blogDetailDate">24.06.2024</span>
                                            </div>
                                        </div>
                                    </div>						
                                </article>

                                <article class="blogWrapper">
                                    <div class="blogImage">
                                        <a href="/blogs/news/fujifilm-xsace-vn-hcm-thehallmark" class="blogImageLink" title="CHÀO ĐÓN SHOWROOM FUJIFILM X-SPACE VN TẠI HỒ CHÍ MINH - THE HALLMARK" rel="nofollow">
                                            <img src="//file.hstatic.net/200000396087/article/dscf9019_32510416d80e49289c9cd8671cff3504_grande.png" class="img-fluid ls-is-cached lazyloaded" data-src="//file.hstatic.net/200000396087/article/dscf9019_32510416d80e49289c9cd8671cff3504_grande.png" alt="CHÀO ĐÓN SHOWROOM FUJIFILM X-SPACE VN TẠI HỒ CHÍ MINH - THE HALLMARK">
                                        </a>
                                        <div class="blogDetail">
                                            <h3 class="blogDetailName">
                                                <a style="font-weight: bold;" href="/blogs/news/fujifilm-xsace-vn-hcm-thehallmark" title="CHÀO ĐÓN SHOWROOM FUJIFILM X-SPACE VN TẠI HỒ CHÍ MINH - THE HALLMARK">CHÀO ĐÓN SHOWROOM FUJIFILM X-SPACE VN TẠI HỒ CHÍ MINH - THE HALLMARK</a>
                                            </h3>
                                            <div class="blogDetailPost">   
                                                <span class="blogDetailDate">31.05.2024</span>
                                            </div>
                                        </div>
                                    </div>						
                                </article>

                                <article class="blogWrapper">
                                    <div class="blogImage">
                                        <a href="/blogs/news/cuoc-song-hang-ngay-cua-akipin-cung-x-t50" class="blogImageLink" title="CUỘC SỐNG HẰNG NGÀY CỦA AKIPIN CÙNG X-T50" rel="nofollow">
                                            <img src="//file.hstatic.net/200000396087/article/600_d0b6a912a6254d338299bcdf577836c3_grande.jpg" class="img-fluid ls-is-cached lazyloaded" data-src="//file.hstatic.net/200000396087/article/600_d0b6a912a6254d338299bcdf577836c3_grande.jpg" alt="CUỘC SỐNG HẰNG NGÀY CỦA AKIPIN CÙNG X-T50">
                                        </a>
                                        <div class="blogDetail">
                                            <h3 class="blogDetailName">
                                                <a style="font-weight: bold;" href="/blogs/news/cuoc-song-hang-ngay-cua-akipin-cung-x-t50" title="CUỘC SỐNG HẰNG NGÀY CỦA AKIPIN CÙNG X-T50">CUỘC SỐNG HẰNG NGÀY CỦA AKIPIN CÙNG X-T50</a>
                                            </h3>
                                            <div class="blogDetailPost">   
                                                <span class="blogDetailDate">20.06.2024</span>
                                            </div>
                                        </div>
                                    </div>						
                                </article>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="footer-placeholder"></div>
    <script src="/Fujifilm_Shop/js/main.js"></script>
    <script src="/Fujifilm_Shop/js/loadHeaderFooter.js"></script>
  </body>
</html>