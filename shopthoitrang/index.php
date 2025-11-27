<?php
session_start();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cham Collection - Thời trang nam nữ trẻ em</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<style>
        *{margin:0;padding:0;box-sizing:border-box;}
        body{font-family:Arial,Helvetica,sans-serif;background:#fff;color:#333;}
        img{width:100%;display:block;}

        /* Header & Banner giữ nguyên */
        .header{display:flex;justify-content:space-between;align-items:center;padding:15px 40px;background:#fff;position:sticky;top:0;z-index:1000;box-shadow:0 2px 10px rgba(0,0,0,.1);}
        .menu{display:flex;gap:30px;font-weight:600;font-size:15px;}
        /* Cập nhật link menu để trỏ đến section */
        .menu a{text-decoration:none; color:#333;}
        .menu a:hover{color:#b80000;}
        .search-bar{flex:1;max-width:400px;margin:0 40px;position:relative;}
        .search-bar input{width:100%;padding:10px 45px 10px 15px;border:1px solid #ddd;border-radius:25px;}
        .search-bar i{position:absolute;right:15px;top:50%;transform:translateY(-50%);}
        .right-icons a{margin-left:20px;font-size:20px; color:#333;}
        .banner{height:550px;background:url('https://badass.vn/wp-content/uploads/2025/03/BANNER-WEB-1350X490.jpg') center/cover no-repeat;color:#fff;display:flex;align-items:center;justify-content:center;text-align:center;}
        .banner h1{font-size:70px;font-weight:300;letter-spacing:5px;}
        .banner p{font-size:24px;margin-top:10px;}

        /* VOUCHER & Product giữ nguyên CSS cũ */
        .voucher-section {
            padding: 80px 20px 60px;
            text-align: center;
            background: #fff;
        }
        .voucher-title {
            font-size: 28px;
            font-weight: bold;
            color: #333;
            margin-bottom: 50px;
        }
        .voucher-list {
            display: flex;
            justify-content: center;
            gap: 30px;
            flex-wrap: wrap;
            max-width: 1400px;
            margin: 0 auto;
        }
        .voucher-card {
            width: 300px;
            height: 160px;
            background: #fef9e6;
            border-radius: 18px;
            overflow: hidden;
            display: flex;
            box-shadow: 0 10px 30px rgba(0,0,0,0.12);
            transition: all 0.3s ease;
        }
        .voucher-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.18);
        }
        .voucher-card.free-ship {
            background: #e8ecef;
        }
        .v-left {
            width: 24px;
            background: #ffcd00;
            flex-shrink: 0;
        }
        .voucher-card.free-ship .v-left {
            background: #333;
        }
        .v-content {
            flex: 1;
            padding: 20px 22px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .v-top h3 {
            font-size: 24px;
            font-weight: 900;
            color: #000;
            margin: 0 0 6px 0;
            line-height: 1;
        }
        .v-top p {
            font-size: 13.5px;
            color: #555;
            margin: 0;
            line-height: 1.4;
        }
        .v-code {
            font-size: 38px;
            font-weight: 900;
            color: #000;
            letter-spacing: 2px;
            margin: 8px 0;
        }
        .v-footer {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
        }
        .v-info {
            font-size: 12.8px;
            color: #666;
            line-height: 1.4;
        }
        .v-info span {
            display: block;
        }
        .copy-btn {
            background: #000;
            color: #fff;
            padding: 8px 18px;
            border-radius: 25px;
            font-size: 13px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }
        .copy-btn:hover {
            background: #333;
            transform: translateY(-2px);
        }

        .section-title{text-align:center;font-size:28px;color:#b80000;margin:60px 0 30px;position:relative;}
        .section-title::after{content:'';width:80px;height:3px;background:#b80000;position:absolute;bottom:-12px;left:50%;transform:translateX(-50%);}
        .product-grid{display:flex;justify-content:center;flex-wrap:wrap;gap:25px;padding:0 40px 60px;}
        .product{width:260px;background:#fff;border-radius:12px;overflow:hidden;box-shadow:0 4px 15px rgba(0,0,0,.1);transition:.3s;}
        /* Thêm hiệu ứng hover vào link để nó hoạt động khi hover vào sản phẩm */
        .product:hover{transform:translateY(-8px);}
        /* Đảm bảo link không làm thay đổi màu sắc và gạch chân chữ */
        .product a{text-decoration: none; color: inherit; display: block;} 

        .product-info{padding:15px;}
        .tag-new{background:#ff5722;color:#fff;padding:3px 8px;font-size:11px;border-radius:3px;display:inline-block;}
        .product-name{font-weight:bold;font-size:14px;height:48px;overflow:hidden;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;}
        .product-price{color:#b80000;font-size:18px;font-weight:bold;}
        .product-price del{color:#999;font-size:14px;margin-left:8px;}
        .voucher15k{background:#ffeb3b;color:#000;padding:4px 10px;border-radius:20px;font-size:12px;display:inline-block;margin:8px 0;}
        .add-cart{background:#000;color:#fff;padding:10px;text-align:center;border-radius:8px;cursor:pointer;margin-top:8px;}

        .footer{background:#111;color:#aaa;padding:70px 40px 30px;font-size:14px;}
        .footer-container{max-width:1200px;margin:auto;display:grid;grid-template-columns:2fr 1fr 1fr 1fr;gap:50px;}
        .footer h3{color:#ffd700;font-size:16px;font-weight:bold;text-transform:uppercase;margin-bottom:25px;letter-spacing:1px;}
        .footer ul li a{color:#aaa;display:block;margin-bottom:10px;transition:0.3s;}
        .footer ul li a:hover{color:#fff;padding-left:5px;}
        .footer .social{display:flex;gap:18px;margin-top:20px;font-size:26px;}
        .footer .social a{color:#ccc;transition:0.3s;}
        .footer .social a:hover{color:#ffd700;transform:translateY(-3px);}
        .footer .copyright{margin-top:60px;padding-top:25px;border-top:1px solid #333;text-align:center;color:#666;font-size:13px;}

        @media(max-width:768px){
            .voucher-list{flex-direction:column;align-items:center;}
            .voucher-item{width:90%;max-width:350px;}
            .header{flex-direction:column;gap:15px;}
            .search-bar{max-width:100%;margin:0 20px;}
            .product-grid{flex-direction:column;align-items:center;}
            .footer-container{grid-template-columns:1fr;text-align:center;}
            .footer .social{justify-content:center;}
        }
    </style>
</head>
<body>

<header class="header">
    <div class="menu">
        <a href="index.php">Trang chủ</a>
        <a href="#nam">Thời trang nam</a>
        <a href="#nu">Thời trang nữ</a>
        <a href="#treem">Đồ trẻ em</a>
        <a href="#phukien">Phụ kiện</a>
    </div>
    <div class="search-bar">
        <input type="text" placeholder="Tìm kiếm sản phẩm...">
        <i class="fas fa-search"></i>
    </div>
    <div class="right-icons">
        <a href="cart.php"><i class="fas fa-shopping-cart"></i></a> 
        <a href="user.php"><i class="fas fa-user"></i></a>
    </div>
</header>

<div class="banner">
    <div>
        </div>
</div>

<section class="voucher-section">
    <h2 class="voucher-title">ƯU ĐÃI DÀNH CHO BẠN</h2>
    <div class="voucher-list">

        <div class="voucher-card">
            <div class="v-left"></div>
            <div class="v-content">
                <div class="v-top">
                    <h3>GIẢM 40k</h3>
                    <p>đơn từ 599k (số lượng có hạn)</p>
                </div>
                <div class="v-code">NOV40</div>
                <div class="v-footer">
                    <div class="v-info">
                        <span>Mã: NOV40</span>
                        <span>HSD: 30/11/2025</span>
                    </div>
                    <div class="copy-btn" onclick="copyCode('NOV40')">Sao chép mã</div>
                </div>
            </div>
        </div>

        <div class="voucher-card free-ship">
            <div class="v-left"></div>
            <div class="v-content">
                <div class="v-top">
                    <h3>MIỄN PHÍ VẬN CHUYỂN</h3>
                    <p>đơn từ 399k (số lượng có hạn)</p>
                </div>
                <div class="v-code">NOV13</div>
                <div class="v-footer">
                    <div class="v-info">
                        <span>Mã: NOV13</span>
                        <span>HSD: 30/11/2025</span>
                    </div>
                    <div class="copy-btn" onclick="copyCode('NOV13')">Sao chép mã</div>
                </div>
            </div>
        </div>

        <div class="voucher-card">
            <div class="v-left"></div>
            <div class="v-content">
                <div class="v-top">
                    <h3>GIẢM 10k</h3>
                    <p>đơn từ 299k (số lượng có hạn)</p>
                </div>
                <div class="v-code">KOH15</div>
                <div class="v-footer">
                    <div class="v-info">
                        <span>Mã: KOH15</span>
                        <span>HSD: 30/11/2025</span>
                    </div>
                    <div class="copy-btn" onclick="copyCode('KOH15')">Sao chép mã</div>
                </div>
            </div>
        </div>

        <div class="voucher-card">
            <div class="v-left"></div>
            <div class="v-content">
                <div class="v-top">
                    <h3>GIẢM 20k</h3>
                    <p>đơn từ 299k (số lượng có hạn)</p>
                </div>
                <div class="v-code">MOY13</div>
                <div class="v-footer">
                    <div class="v-info">
                        <span>Mã: MOY13</span>
                        <span>HSD: 30/11/2025</span>
                    </div>
                    <div class="copy-btn" onclick="copyCode('MOY13')">Sao chép mã</div>
                </div>
            </div>
        </div>

    </div>
</section>
<h2 class="section-title" id="nam">Đồ Nam</h2>
<div class="product-grid">
    <?php
    // Đã thêm ID cho mỗi sản phẩm (id 1-10)
    $nam = [
        ["id" => 1, "img"=>"https://yame.vn/cdn/shop/files/No_Style_M42_Xanh_D_ng_Be.jpg?v=1761989645&width=750","name"=>"TRENDING SHORT WITH BUCKLE - QUẦN SHORT DÀI LƯNG KHOÁ K CLOSET Q3006","price"=>"650,000đ","old"=>"890,000đ"],
        ["id" => 2, "img"=>"https://yame.vn/cdn/shop/files/0024723.jpg?v=1761643536&width=823","name"=>"QUẦN JEAN ỐNG RỘNG TRƠN LƯNG CAO K CLOSET Q2010","price"=>"350,000đ","old"=>"690,000đ"],
        ["id" => 3, "img"=>"https://yame.vn/cdn/shop/files/0024407.jpg?v=1760783181&width=823","name"=>"QUẦN JEAN TÚI SAU ĐÍNH ĐÁ K CLOSET Q2005","price"=>"650,000đ","old"=>"890,000đ"],
        ["id" => 4, "img"=>"https://yame.vn/cdn/shop/files/0023563.jpg?v=1760786043&width=823","name"=>"QUẦN LỬNG XẾP LY GIỮA K CLOSET Q3003","price"=>"650,000đ","old"=>"890,000đ"],
        ["id" => 5, "img"=>"https://yame.vn/cdn/shop/files/0024647.jpg?v=1764129319&width=823","name"=>"QUẦN ỐNG RỘNG LƯNG CAO NẸP GỌNG - ĐI LĂM K CLOSET KC1235","price"=>"650,000đ","old"=>"890,000đ"],
        ["id" => 6, "img"=>"https://yame.vn/cdn/shop/files/0024722.jpg?v=1761643532&width=823","name"=>"QUẦN SHORT ỐNG RỘNG K CLOSET Q1007","price"=>"650,000đ","old"=>"890,000đ"],
        ["id" => 7, "img"=>"https://yame.vn/cdn/shop/files/0023217.jpg?v=1760777405&width=823","name"=>"ÁO THUN HEROIC AHR CLUB","price"=>"450,000đ","old"=>"690,000đ"],
        ["id" => 8, "img"=>"https://yame.vn/cdn/shop/files/0023244.jpg?v=1760774598&width=823","name"=>"ÁO POLO ĐEN CỔ TRẮNG","price"=>"550,000đ","old"=>"790,000đ"],
        ["id" => 9, "img"=>"https://yame.vn/cdn/shop/files/0024482.jpg?v=1760777151&width=823","name"=>"ÁO THUN HEROIC AHR CLUB","price"=>"450,000đ","old"=>"690,000đ"],
        ["id" => 10, "img"=>"https://yame.vn/cdn/shop/files/0024486.jpg?v=1760777369&width823","name"=>"ÁO POLO ĐEN CỔ TRẮNG","price"=>"550,000đ","old"=>"790,000đ"],
    ];
    foreach($nam as $p){ ?>
        <div class="product">
            <a href="chitiet.php?id=<?= $p['id'] ?>"> 
                <img src="<?= $p['img'] ?>" alt="<?= $p['name'] ?>">
                <div class="product-info">
                    <span class="tag-new">Hàng mới</span>
                    <div class="product-name"><?= $p['name'] ?></div>
                    <div class="product-price"><?= $p['price'] ?> <del><?= $p['old'] ?></del></div>
                    <div class="voucher15k">Voucher 15k</div>
                </div>
            </a>
            <div class="add-cart">Thêm vào giỏ</div>
        </div>
    <?php } ?>
</div>

<h2 class="section-title" id="nu">Đồ Nữ</h2>
<div class="product-grid">
    <?php
    // Đã thêm ID cho mỗi sản phẩm (id 11-20)
    $nu = [
        ["id" => 11, "img"=>"https://product.hstatic.net/200000588835/product/a3009q2005-6_5cad718158e7419f96aeb09649a4d248_master.jpg","name"=>"QUẦN JEAN ỐNG RỘNG TRƠN LƯNG CAO K CLOSET Q2010","price"=>"1,450,000đ","old"=>"2,110,000đ"],
        ["id" => 12, "img"=>"https://product.hstatic.net/200000588835/product/a4007q3002-1_1a1252e8bc78441982119f02bbd58f87_master.jpg","name"=>"QUẦN JEAN ỐNG RỘNG XẾP LY K CLOSET G3002","price"=>"650,000đ","old"=>"890,000đ"],
        ["id" => 13, "img"=>"https://product.hstatic.net/200000588835/product/b1_e632724ba1594e38ae0cc228f52ef367_master.jpg","name"=>"QUẦN JEAN PHỐI LƯNG SỌC K CLOSET Q1011","price"=>"650,000đ","old"=>"890,000đ"],
        ["id" => 14, "img"=>"https://product.hstatic.net/200000588835/product/a3006-1_af42f107563e497ca18ae794110b8ba4_master.jpg","name"=>"QUẦN JEAN ỐNG RỘNG KẾT CƯỜM K CLOSET Q1010","price"=>"650,000đ","old"=>"890,000đ"],
        ["id" => 15, "img"=>"https://product.hstatic.net/200000588835/product/a3009q3001-2_05f72e9335df429592f6e45a0de351e2_master.jpg","name"=>"QUẦN JEAN BAGGY ỐNG RỘNG K CLOSET G3001","price"=>"650,000đ","old"=>"890,000đ"],
        ["id" => 16, "img"=>"https://product.hstatic.net/200000588835/product/kv2025-6a_3dfb8d8dbaf04e2d9c1761c65d2b5651_master.jpg","name"=>"VÁY HOA TÍM DỰ TIỆC","price"=>"1,250,000đ","old"=>"1,890,000đ"],
        ["id" => 17, "img"=>"https://product.hstatic.net/200000588835/product/b30_d3e14116679e4f3c856d35535414d7ff_master.jpg","name"=>"ĐẦM TRẮNG XẾP LY","price"=>"950,000đ","old"=>"1,390,000đ"],
        ["id" => 18, "img"=>"https://product.hstatic.net/200000588835/product/kc1042-2_03b2845feed14bb3bb1559bae6827733_master.jpg","name"=>"VÁY HOA TÍM DỰ TIỆC","price"=>"1,250,000đ","old"=>"1,890,000đ"],
        ["id" => 19, "img"=>"https://product.hstatic.net/200000588835/product/d3009-4_43db6fec23a74f81b5b429df377ef3f5_master.jpg","name"=>"ĐẦM TRẮNG XẾP LY","price"=>"950,000đ","old"=>"1,390,000đ"],
        ["id" => 20, "img"=>"https://product.hstatic.net/200000588835/product/_d2008-1_5096ed9df7f14926a6216132973aea43_master.jpg","name"=>"ĐẦM TRẮNG XẾP LY","price"=>"950,000đ","old"=>"1,390,000đ"],
    ];
    foreach($nu as $p){ ?>
        <div class="product">
            <a href="chitiet.php?id=<?= $p['id'] ?>"> 
                <img src="<?= $p['img'] ?>" alt="<?= $p['name'] ?>">
                <div class="product-info">
                    <span class="tag-new">Hàng mới</span>
                    <div class="product-name"><?= $p['name'] ?></div>
                    <div class="product-price"><?= $p['price'] ?> <del><?= $p['old'] ?></del></div>
                    <div class="voucher15k">Voucher 15k</div>
                </div>
            </a>
            <div class="add-cart">Thêm vào giỏ</div>
        </div>
    <?php } ?>
</div>

<h2 class="section-title" id="treem">Trẻ em</h2>
<div class="product-grid">
    <?php
    // Đã thêm ID cho mỗi sản phẩm (id 21-25)
    $tre = [
        ["id" => 21, "img"=>"https://api.muji.com.vn/media/catalog/product/cache/2e9290695da361a7d6192a4c8c689807/4/5/4550584807473_01_org.jpg","name"=>"QUẦN SHORT HOA TIẾT NƠ CHỮ K Q1007","price"=>"650,000đ","old"=>"890,000đ"],
        ["id" => 22, "img"=>"https://api.muji.com.vn/media/catalog/product/cache/2e9290695da361a7d6192a4c8c689807/4/5/4550584817755_01_org.jpg","name"=>"QUẦN SHORT LƯNG CAO XẾP LY GIỮA K CLOSET Q1006","price"=>"650,000đ","old"=>"890,000đ"],
        ["id" => 23, "img"=>"https://api.muji.com.vn/media/catalog/product/cache/2e9290695da361a7d6192a4c8c689807/4/5/4550584811869_01_org.jpg","name"=>"QUẦN SHORT XẾP LY TRƯỚC KÈM BELT K CLOSET S4006","price"=>"650,000đ","old"=>"890,000đ"],
        ["id" => 24, "img"=>"https://api.muji.com.vn/media/catalog/product/cache/2e9290695da361a7d6192a4c8c689807/4/5/4547315746309_01_org.jpg","name"=>"BỘ ĐỒ KHỦNG LONG ĐỎ","price"=>"650,000đ","old"=>"890,000đ"],
        ["id" => 25, "img"=>"https://api.muji.com.vn/media/catalog/product/cache/2e9290695da361a7d6192a4c8c689807/4/5/4547315750009_01_org.jpg","name"=>"TRENDING SHORT WITH BUCKLE - QUẦN SHORT DÀI LƯNG KHOÁ K CLOSET Q3006","price"=>"650,000đ","old"=>"890,000đ"],
    ];
    foreach($tre as $p){ ?>
        <div class="product">
            <a href="chitiet.php?id=<?= $p['id'] ?>"> 
                <img src="<?= $p['img'] ?>" alt="<?= $p['name'] ?>">
                <div class="product-info">
                    <span class="tag-new">Hàng mới</span>
                    <div class="product-name"><?= $p['name'] ?></div>
                    <div class="product-price"><?= $p['price'] ?> <del><?= $p['old'] ?></del></div>
                    <div class="voucher15k">Voucher 15k</div>
                </div>
            </a>
            <div class="add-cart">Thêm vào giỏ</div>
        </div>
    <?php } ?>
</div>

<h2 class="section-title" id="phukien">Phụ kiện</h2>
<div class="product-grid">
    <?php
    // Đã thêm ID cho mỗi sản phẩm (id 26-30)
    $phukien = [
        ["id" => 26, "img"=>"https://api.muji.com.vn/media/catalog/product/cache/2e9290695da361a7d6192a4c8c689807/4/5/4550584745423_org.jpg","name"=>"Kính Mắt (Kính Râm) Unisex Hình Chữ Nhật","price"=>"750,000đ","old"=>"990,000đ"],
        ["id" => 27, "img"=>"https://api.muji.com.vn/media/catalog/product/cache/2e9290695da361a7d6192a4c8c689807/4/5/4550584745362_org.jpg","name"=>"Kính Mắt (Kính Râm) Unisex Hình Chữ Nhật","price"=>"750,000đ","old"=>"990,000đ"],
        ["id" => 28, "img"=>"https://api.muji.com.vn/media/catalog/product/cache/2e9290695da361a7d6192a4c8c689807/4/5/4550584053016_org.jpg","name"=>"DÂY NỊT NAM CEIBO","price"=>"750,000đ","old"=>"990,000đ"],
        ["id" => 29, "img"=>"https://api.muji.com.vn/media/catalog/product/cache/2e9290695da361a7d6192a4c8c689807/4/5/4550584099977_02_org.jpg","name"=>"MẮT KÍNH NAM BRAKNI","price"=>"750,000đ","old"=>"990,000đ"],
        ["id" => 30, "img"=>"https://api.muji.com.vn/media/catalog/product/cache/2e9290695da361a7d6192a4c8c689807/4/5/4547315968114_org.jpg","name"=>"ĐỒNG HỒ NỮ TIMELESS","price"=>"750,000đ","old"=>"990,000đ"],
    ];
    foreach($phukien as $p){ ?>
        <div class="product">
            <a href="chitiet.php?id=<?= $p['id'] ?>">
                <img src="<?= $p['img'] ?>" alt="<?= $p['name'] ?>">
                <div class="product-info">
                    <div class="product-name"><?= $p['name'] ?></div>
                    <div class="product-price"><?= $p['price'] ?> <del><?= $p['old'] ?></del></div>
                    <div class="voucher15k">Voucher 15k</div>
                </div>
            </a>
            <div class="add-cart">Thêm vào giỏ</div>
        </div>
    <?php } ?>
</div>
<footer class="footer">
    <div class="footer-container">
        <div>
            <h3>CHĂM SÓC KHÁCH HÀNG</h3>
            <p>CÔNG TY TNHH K-CLOSET<br>
            Số ĐKKD 0316566384 cấp ngày 04/05/2021 do Sở KHĐT TP.HCM cấp<br>
            Địa chỉ: 32 Nguyễn Trãi, P. Bến Thành, Q.1, TP.HCM</p>
        </div>
        <div>
            <h3>ABOUT K CLOSET</h3>
            <ul>
                <li><a href="#">Về chúng tôi</a></li>
                <li><a href="#">Hệ thống cửa hàng</a></li>
                <li><a href="#">Liên hệ hợp tác</a></li>
                <li><a href="#">Tuyển dụng</a></li>
            </ul>
        </div>
        <div>
            <h3>HỖ TRỢ KHÁCH HÀNG</h3>
            <ul>
                <li><a href="#">Chính sách đổi trả / trả hàng</a></li>
                <li><a href="#">Chính sách vận chuyển</a></li>
                <li><a href="#">Chính sách bảo mật</a></li>
                <li><a href="#">Khách hàng thân thiết</a></li>
            </ul>
        </div>
        <div>
            <h3>KẾT NỐI</h3>
            <div class="social">
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-tiktok"></i></a>
                <a href="#"><i class="fab fa-zalo" style="font-family:'Font Awesome 5 Brands';">Zalo</i></a>
            </div>
            <p style="margin-top:20px;">CHẤP NHẬN THANH TOÁN</p>
            <img src="https://i.imgur.com/creditcards.png" alt="Thanh toán" style="width:200px;margin-top:10px;">
        </div>
    </div>
    <div class="copyright">
        © 2025 K Closet. All rights reserved. Thiết kế & phát triển bởi bạn
    </div>
</footer>

<script>
function copyCode(code) {
    navigator.clipboard.writeText(code).then(() => {
        alert("Đã sao chép mã: " + code);
    });
}
</script>
</body>
</html>