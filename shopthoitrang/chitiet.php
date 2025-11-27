<?php
session_start();
$id = $_GET['id'] ?? 1;

// --- 1. DỮ LIỆU TỔNG HỢP CỦA TẤT CẢ SẢN PHẨM (Mở rộng để có nhiều ảnh) ---
function get_all_products() {
    $generic_desc = 'Sản phẩm được làm từ chất liệu cao cấp, thoáng mát, mang lại sự thoải mái tối đa cho người mặc. Thiết kế hiện đại, dễ dàng phối hợp với nhiều phong cách khác nhau.';

    $products_all = [
        // Sản phẩm MẪU (Sản phẩm hiện đang được hiển thị trong ảnh)
        ["id" => 1, "sku" => "D3012-1", "img"=>"https://yame.vn/cdn/shop/files/0024723.jpg?v=1761643536&width=823","name"=>"K Closet Mesh Crochet Knit Top with Collar","price"=>"650,000đ","old"=>"990,000đ", 
         "images" => [ 
            "https://yame.vn/cdn/shop/files/0023563.jpg?v=1760786043&width=823", // Ảnh chính
            "https://yame.vn/cdn/shop/files/0024486.jpg?v=1760777369&width=823",
            "https://yame.vn/cdn/shop/files/0024486.jpg?v=1760777369&width=823",
            "https://yame.vn/cdn/shop/files/0024486.jpg?v=1760777369&width=823"
            
         ],
         "desc" => 'Áo dệt kim móc phối lưới có cổ K Closet là sản phẩm lý tưởng cho mùa hè. Chất liệu thoáng khí, kiểu dáng nữ tính, trẻ trung.<br><br>→ CHẤT LIỆU COTTON – TỐI ƯU SỰ THOẢI MÁI VÀ ĐỘ BỀN'
        ],
        ["id" => 2, "sku" => "Q3006-A", "img"=>"https://yame.vn/cdn/shop/files/No_Style_M42_Xanh_D_ng_Be.jpg?v=1761989645&width=750","name"=>"TRENDING SHORT WITH BUCKLE - QUẦN SHORT DÀI LƯNG KHOÁ K CLOSET Q3006","price"=>"650,000đ","old"=>"890,000đ",
         "images" => ["https://yame.vn/cdn/shop/files/No_Style_M42_Xanh_D_ng_Be.jpg?v=1761989645&width=750"], "desc" => $generic_desc],
        ["id" => 3, "sku" => "Q2010-B", "img"=>"https://yame.vn/cdn/shop/files/0024723.jpg?v=1761643536&width=823","name"=>"QUẦN JEAN ỐNG RỘNG TRƠN LƯNG CAO K CLOSET Q2010","price"=>"350,000đ","old"=>"690,000đ",
         "images" => [
            "https://yame.vn/cdn/shop/files/0024407.jpg?v=1760783181&width=823", // Ảnh chính
            "https://yame.vn/cdn/shop/files/qu-n-jean-seventy-seven-51-xanh-tr-ng-1174882555.jpg?v=1760783169&width=823",
            "https://yame.vn/cdn/shop/files/qu-n-jean-seventy-seven-51-xanh-tr-ng-1174882556.jpg?v=1760783171&width=823",   
            "https://yame.vn/cdn/shop/files/TheOriginal009002440800244090024407_f49d2a40-efbf-4a4b-ae3e-1cd9a8a44535.jpg?v=1762224852&width=823"
         ],
         "desc" => $generic_desc],

        ["id" => 4, "sku" => "Q2005-C", "img"=>"https://yame.vn/cdn/shop/files/0024407.jpg?v=1760783181&width=823","name"=>"QUẦN JEAN TÚI SAU ĐÍNH ĐÁ K CLOSET Q2005","price"=>"650,000đ","old"=>"890,000đ",
         "images" => [
            "https://yame.vn/cdn/shop/files/0023563.jpg?v=1760786043&width=823", // Ảnh chính
            "https://yame.vn/cdn/shop/files/qu-n-short-the-original-m84-xanh-nh-t-1174881845.jpg?v=1760786034&width=823",
            "https://yame.vn/cdn/shop/files/qu-n-short-the-original-m84-xanh-nh-t-1174881849.jpg?v=1760786039&width=823",
            "https://yame.vn/cdn/shop/files/0023565_0023564_0023563.jpg?v=1760786045&width=823"
            ], 
         "desc" => $generic_desc],
        ["id" => 5, "sku" => "Q3003-D", "img"=>"https://yame.vn/cdn/shop/files/0023563.jpg?v=1760786043&width=823","name"=>"QUẦN LỬNG XẾP LY GIỮA K CLOSET Q3003","price"=>"650,000đ","old"=>"890,000đ", 
        "images" => ["https://yame.vn/cdn/shop/files/0023563.jpg?v=1760786043&width=823",
        "https://yame.vn/cdn/shop/files/0024647_thumb_1.jpg?v=1760796619&width=823",
        "https://yame.vn/cdn/shop/files/0024647_thumb_2.jpg?v=1760796620&width=823",
        "https://yame.vn/cdn/shop/files/0024647_thumb_3.jpg?v=1760796622&width=823"
        ], 
        "desc" => $generic_desc],
        ["id" => 6, "sku" => "KC1235-E", "img"=>"https://yame.vn/cdn/shop/files/0024647.jpg?v=1764129319&width=823","name"=>"QUẦN ỐNG RỘNG LƯNG CAO NẸP GỌNG - ĐI LĂM K CLOSET KC1235","price"=>"650,000đ","old"=>"890,000đ",
        "images" => ["https://yame.vn/cdn/shop/files/0024647.jpg?v=1764129319&width=823"

        ],
         "desc" => $generic_desc],
        ["id" => 7, "sku" => "Q1007-F", "img"=>"https://yame.vn/cdn/shop/files/0024722.jpg?v=1761643532&width=823","name"=>"QUẦN SHORT ỐNG RỘNG K CLOSET Q1007","price"=>"650,000đ","old"=>"890,000đ", 
        "images" => ["https://yame.vn/cdn/shop/files/0024722.jpg?v=1761643532&width=823"

        ],
         "desc" => $generic_desc],
        ["id" => 8, "sku" => "AHR-G", "img"=>"https://yame.vn/cdn/shop/files/0023217.jpg?v=1760777405&width=823","name"=>"ÁO THUN HEROIC AHR CLUB","price"=>"450,000đ","old"=>"690,000đ",
         "images" => ["https://yame.vn/cdn/shop/files/0023217.jpg?v=1760777405&width=823"
         ],
         "desc" => $generic_desc],
        ["id" => 9, "sku" => "POLO-H", "img"=>"https://yame.vn/cdn/shop/files/0023244.jpg?v=1760774598&width=823","name"=>"ÁO POLO ĐEN CỔ TRẮNG","price"=>"550,000đ","old"=>"790,000đ", 
        "images" => ["https://yame.vn/cdn/shop/files/0023244.jpg?v=1760774598&width=823"
        ], 
        "desc" => $generic_desc],
        ["id" => 10, "sku" => "AHR-I", "img"=>"https://yame.vn/cdn/shop/files/0024482.jpg?v=1760777151&width=823","name"=>"ÁO THUN HEROIC AHR CLUB","price"=>"450,000đ","old"=>"690,000đ",
         "images" => ["https://yame.vn/cdn/shop/files/0024482.jpg?v=1760777151&width=823"
         ], 
         "desc" => $generic_desc],
        ["id" => 11, "sku" => "POLO-J", "img"=>"https://yame.vn/cdn/shop/files/0024486.jpg?v=1760777369&width=823","name"=>"ÁO POLO ĐEN CỔ TRẮNG","price"=>"550,000đ","old"=>"790,000đ", 
        "images" => ["https://yame.vn/cdn/shop/files/0024486.jpg?v=1760777369&width=823"
        ],
         "desc" => $generic_desc],
        // ĐỒ NỮ (ID 12-21)
        ["id" => 12, "sku" => "Q2010-K", "img"=>"https://product.hstatic.net/200000588835/product/a3009q2005-6_5cad718158e7419f96aeb09649a4d248_master.jpg","name"=>"QUẦN JEAN ỐNG RỘNG TRƠN LƯNG CAO K CLOSET Q2010","price"=>"1,450,000đ","old"=>"2,110,000đ", 
        "images" => [
            "https://product.hstatic.net/200000588835/product/a3009q2005-6_5cad718158e7419f96aeb09649a4d248_master.jpg"
        ],
         "desc" => $generic_desc],
        ["id" => 13, "sku" => "G3002-L", "img"=>"https://product.hstatic.net/200000588835/product/a4007q3002-1_1a1252e8bc78441982119f02bbd58f87_master.jpg","name"=>"QUẦN JEAN ỐNG RỘNG XẾP LY K CLOSET G3002","price"=>"650,000đ","old"=>"890,000đ", 
        "images" => ["https://product.hstatic.net/200000588835/product/a4007q3002-1_1a1252e8bc78441982119f02bbd58f87_master.jpg"
        ], 
        "desc" => $generic_desc],
        ["id" => 14, "sku" => "Q1011-M", "img"=>"https://product.hstatic.net/200000588835/product/b1_e632724ba1594e38ae0cc228f52ef367_master.jpg","name"=>"QUẦN JEAN PHỐI LƯNG SỌC K CLOSET Q1011","price"=>"650,000đ","old"=>"890,000đ", "images" => ["https://product.hstatic.net/200000588835/product/b1_e632724ba1594e38ae0cc228f52ef367_master.jpg"], "desc" => $generic_desc],
        ["id" => 15, "sku" => "Q1010-N", "img"=>"https://product.hstatic.net/200000588835/product/q2001_883c3ae08a824237a7a424963eab9c5e_master.jpg","name"=>"QUẦN JEAN ỐNG RỘNG KẾT CƯỜM K CLOSET Q1010","price"=>"650,000đ","old"=>"890,000đ", "images" => ["https://product.hstatic.net/200000588835/product/q2001_883c3ae08a824237a7a424963eab9c5e_master.jpg"], "desc" => $generic_desc],
        ["id" => 16, "sku" => "G3001-O", "img"=>"https://product.hstatic.net/200000588835/product/a3009q3001-2_05f72e9335df429592f6e45a0de351e2_master.jpg","name"=>"QUẦN JEAN BAGGY ỐNG RỘNG K CLOSET G3001","price"=>"650,000đ","old"=>"890,000đ", "images" => ["https://product.hstatic.net/200000588835/product/a3009q3001-2_05f72e9335df429592f6e45a0de351e2_master.jpg"], "desc" => $generic_desc],
        ["id" => 17, "sku" => "VAY-P", "img"=>"https://product.hstatic.net/200000588835/product/kv2025-6a_3dfb8d8dbaf04e2d9c1761c65d2b5651_master.jpg","name"=>"VÁY HOA TÍM DỰ TIỆC","price"=>"1,250,000đ","old"=>"1,890,000đ", "images" => ["https://product.hstatic.net/200000588835/product/kv2025-6a_3dfb8d8dbaf04e2d9c1761c65d2b5651_master.jpg"], "desc" => $generic_desc],
        ["id" => 18, "sku" => "DAM-Q", "img"=>"https://product.hstatic.net/200000588835/product/b30_d3e14116679e4f3c856d35535414d7ff_master.jpg","name"=>"ĐẦM TRẮNG XẾP LY","price"=>"950,000đ","old"=>"1,390,000đ", "images" => ["https://product.hstatic.net/200000588835/product/b30_d3e14116679e4f3c856d35535414d7ff_master.jpg"], "desc" => $generic_desc],
        ["id" => 19, "sku" => "VAY-R", "img"=>"https://product.hstatic.net/200000588835/product/kc1042-2_03b2845feed14bb3bb1559bae6827733_master.jpg","name"=>"VÁY HOA TÍM DỰ TIỆC","price"=>"1,250,000đ","old"=>"1,890,000đ", "images" => ["https://product.hstatic.net/200000588835/product/kc1042-2_03b2845feed14bb3bb1559bae6827733_master.jpg"], "desc" => $generic_desc],
        ["id" => 20, "sku" => "DAM-S", "img"=>"https://product.hstatic.net/200000588835/product/d3009-4_43db6fec23a74f81b5b429df377ef3f5_master.jpg","name"=>"ĐẦM TRẮNG XẾP LY","price"=>"950,000đ","old"=>"1,390,000đ", "images" => ["https://product.hstatic.net/200000588835/product/d3009-4_43db6fec23a74f81b5b429df377ef3f5_master.jpg"], "desc" => $generic_desc],
        ["id" => 21, "sku" => "DAM-T", "img"=>"https://product.hstatic.net/200000588835/product/_d2008-1_5096ed9df7f14926a6216132973aea43_master.jpg","name"=>"ĐẦM TRẮNG XẾP LY","price"=>"950,000đ","old"=>"1,390,000đ", "images" => ["https://product.hstatic.net/200000588835/product/_d2008-1_5096ed9df7f14926a6216132973aea43_master.jpg"], "desc" => $generic_desc],
        // ... (Bạn có thể thêm các sản phẩm Trẻ em và Phụ kiện khác vào đây, đảm bảo có đủ ID)
    ];
    return $products_all;
}

// Hàm lấy sản phẩm gợi ý
function get_related_products($current_id, $all_products, $limit = 4) {
    $related = [];
    $candidate_keys = array_keys($all_products);
    
    // Loại bỏ sản phẩm hiện tại khỏi danh sách ứng viên
    foreach ($candidate_keys as $key => $index) {
        if ($all_products[$index]['id'] == $current_id) {
            unset($candidate_keys[$key]);
            break;
        }
    }
    
    // Đảm bảo có đủ sản phẩm để chọn
    if (count($candidate_keys) < $limit) {
        $limit = count($candidate_keys);
    }
    
    // Chọn ngẫu nhiên
    $random_keys = array_rand(array_flip($candidate_keys), $limit);
    if (!is_array($random_keys)) {
         $random_keys = [$random_keys];
    }

    foreach ($random_keys as $key) {
        $related[] = $all_products[$key];
    }
    return $related;
}


// --- 2. LOGIC TÌM KIẾM SẢN PHẨM & XỬ LÝ GIỎ HÀNG & GỢI Ý ---
$products_all = get_all_products();

// Tìm sản phẩm dựa trên ID từ URL
$found_product = null;
foreach ($products_all as $p) {
    if ($p['id'] == $id) { 
        $found_product = $p;
        break;
    }
}

// Xử lý nếu không tìm thấy sản phẩm
if (!$found_product) {
    die("Sản phẩm có ID #$id không tồn tại."); 
}

// Gán dữ liệu sản phẩm tìm được vào biến $product để hiển thị
$product = $found_product;
$product['image'] = $product['images'][0]; // Lấy ảnh đầu tiên làm ảnh chính
$product['desc'] = $product['desc']; 

// Lấy 4 sản phẩm gợi ý (có thể thay đổi số lượng)
$related_products = get_related_products($id, $products_all, 4);


// Xử lý khi người dùng nhấn nút "Thêm vào giỏ hàng"
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $size = $_POST['size'];
    $quantity = 1; 

    $product_to_add = $found_product; 

    $item = [
        'id' => $product_id,
        'name' => $product_to_add['name'],
        'price' => $product_to_add['price'],
        'image' => $product_to_add['images'][0], // Lấy ảnh chính
        'size' => $size,
        'quantity' => $quantity
    ];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $cart_exists = false;
    foreach ($_SESSION['cart'] as $key => $cart_item) {
        if ($cart_item['id'] == $product_id && $cart_item['size'] == $size) {
            $_SESSION['cart'][$key]['quantity'] += $quantity;
            $cart_exists = true;
            break;
        }
    }

    if (!$cart_exists) {
        $_SESSION['cart'][] = $item;
    }

    header('Location: cart.php');
    exit();
}
// --- 3. BẮT ĐẦU PHẦN HTML/CSS/JS ---
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $product['name'] ?> - Cham Collection</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        *{margin:0;padding:0;box-sizing:border-box;}
        body{font-family:Arial,Helvetica,sans-serif;background:#fafafa;color:#333;line-height:1.6;}
        
        /* Header */
        .header{display:flex;justify-content:space-between;align-items:center;padding:15px 40px;background:#fff;position:sticky;top:0;z-index:1000;box-shadow:0 2px 10px rgba(0,0,0,.1);}
        .menu a{margin:0 15px;text-decoration:none;color:#333;font-weight:600;}
        .menu a:hover{color:#b80000;}
        .right-icons a{margin-left:20px;font-size:20px;color:#333;}

        /* Container chi tiết */
        .container{max-width:1200px;margin:30px auto;padding:0 20px;display:flex;gap:40px;flex-wrap:wrap;}
        
        /* Gallery MỚI: Thêm cột cho ảnh nhỏ */
        .gallery-wrapper{flex:1;min-width:300px;display:flex;gap:15px;}
        .thumbnails{width:90px;display:flex;flex-direction:column;gap:10px;order: -1;} /* Đẩy ảnh nhỏ sang trái */
        .thumbnail-item img{width:100%;height:auto;object-fit:cover;border:1px solid #eee;border-radius:8px;cursor:pointer;transition:.2s;}
        .thumbnail-item img.active, .thumbnail-item img:hover{border-color:#000;box-shadow:0 2px 5px rgba(0,0,0,0.1);}

        .main-image{flex:1;}
        .main-image img{width:100%;border-radius:12px;box-shadow:0 8px 25px rgba(0,0,0,.1);}
        
        .info{flex:1;min-width:300px;}
        .info h1{font-size:28px;font-weight:bold;margin-bottom:10px;color:#222;}
        .sku{color:#888;font-size:14px;margin-bottom:15px;}
        .price{font-size:32px;color:#d00;font-weight:bold;margin:20px 0;}
        
        .size-label{margin:20px 0 10px;font-weight:bold;}
        .sizes{display:flex;gap:12px;}
        .size-btn{padding:10px 18px;border:2px solid #ddd;border-radius:8px;cursor:pointer;transition:.3s;font-weight:bold;}
        .size-btn:hover,.size-btn.active{border-color:#000;background:#000;color:#fff;}
        
        .actions{display:flex;gap:15px;margin-top:30px;}
        .add-cart-btn{background:#555;color:#fff;padding:14px 30px;border-radius:8px;font-size:15px;font-weight:bold;cursor:pointer;display:flex;align-items:center;gap:10px;}
        .buy-now-btn{background:#e00000;color:#fff;padding:14px 40px;border-radius:8px;font-size:16px;font-weight:bold;cursor:pointer;text-align:center;}
        
        .desc{margin-top:50px;border-top:1px solid #eee;padding-top:30px;}
        .desc-tabs{display:flex;margin-bottom:20px;}
        .tab-btn{padding:10px 20px;cursor:pointer;border:none;background:#fff;border-bottom:3px solid transparent;font-weight:bold;font-size:16px;color:#555;}
        .tab-btn.active{border-bottom-color:#000;color:#000;}

        /* Gợi ý cho bạn */
        .related-products{max-width:1200px;margin:50px auto;padding:0 20px 80px;}
        .related-products h2{font-size:24px;text-align:center;margin-bottom:30px;font-weight:bold;color:#222;}
        .related-grid{display:flex;justify-content:center;flex-wrap:wrap;gap:20px;}
        .related-product-item{width:220px;background:#fff;border-radius:8px;overflow:hidden;box-shadow:0 4px 10px rgba(0,0,0,.08);transition:.3s;text-decoration:none;color:#333;}
        .related-product-item:hover{transform:translateY(-5px);}
        .related-img-container{height:280px;overflow:hidden;}
        .related-img-container img{width:100%;height:100%;object-fit:cover;}
        .related-info{padding:10px;}
        .related-name{font-size:14px;height:40px;overflow:hidden;line-height:1.4;margin-bottom:5px;}
        .related-price{font-weight:bold;color:#b80000;font-size:16px;}

        @media(max-width:768px){
            .container{flex-direction:column;}
            .gallery-wrapper{flex-direction:column-reverse;gap:10px;}
            .thumbnails{flex-direction:row;width:100%;height:80px;}
            .thumbnail-item{flex:1;max-width:80px;}
            .actions{flex-direction:column;}
            .buy-now-btn{width:100%;text-align:center;}
        }
    </style>
</head>
<body>

<header class="header">
    <div class="menu">
        <a href="index.php">Trang chủ</a>
        <a href="index.php#nam">Thời trang nam</a>
        <a href="index.php#nu">Thời trang nữ</a>
        <a href="index.php#treem">Đồ trẻ em</a>
        <a href="index.php#phukien">Phụ kiện</a>
    </div>
    <div class="right-icons">
        <a href="cart.php"><i class="fas fa-shopping-cart"></i></a>
        <a href="user.php"><i class="fas fa-user"></i></a>
    </div>
</header>

<div class="container">
    <div class="gallery-wrapper">
        <div class="thumbnails">
            <?php foreach ($product['images'] as $index => $img_url): ?>
                <div class="thumbnail-item">
                    <img src="<?= $img_url ?>" alt="Thumbnail <?= $index + 1 ?>" 
                         class="<?= $index === 0 ? 'active' : '' ?>" 
                         onclick="changeMainImage('<?= $img_url ?>', this)">
                </div>
            <?php endforeach; ?>
        </div>
        <div class="main-image">
            <img id="mainProductImage" src="<?= $product['image'] ?>" alt="<?= $product['name'] ?>">
        </div>
    </div>

    <div class="info">
        <h1><?= $product['name'] ?></h1>
        <div class="sku">SKU: <?= $product['sku'] ?></div>
        <div class="price"><?= $product['price'] ?></div>

        <form method="POST" action="chitiet.php?id=<?= $product['id'] ?>">
            <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
            
            <input type="hidden" name="size" id="selected-size" value="S"> 

            <div class="size-label">Kích thước:</div>
            <div class="sizes" id="size-options">
                <div class="size-btn active" data-size="S">S</div>
                <div class="size-btn" data-size="M">M</div>
                <div class="size-btn" data-size="L">L</div>
            </div>

            <div class="actions">
                <button type="submit" name="add_to_cart" value="1" class="add-cart-btn" style="border:none;">
                    <i class="fas fa-cart-plus"></i> Thêm vào giỏ hàng
                </button>
                <div class="buy-now-btn">Mua ngay</div>
            </div>
        </form>
        
        <div class="desc">
            <div class="desc-tabs">
                 <button class="tab-btn active">Mô tả sản phẩm</button>
            </div>
            <div><?= nl2br($product['desc']) ?></div>
        </div>
    </div>
</div>

<div class="related-products">
    <h2>GỢI Ý CHO BẠN</h2>
    <div class="related-grid">
        <?php foreach ($related_products as $rp): ?>
            <a href="chitiet.php?id=<?= $rp['id'] ?>" class="related-product-item">
                <div class="related-img-container">
                    <img src="<?= $rp['img'] ?>" alt="<?= $rp['name'] ?>">
                </div>
                <div class="related-info">
                    <div class="related-name"><?= $rp['name'] ?></div>
                    <div class="related-price"><?= $rp['price'] ?></div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</div>

<script>
// --- CHỨC NĂNG 1: Đổi ảnh chính khi click ảnh nhỏ ---
function changeMainImage(imageURL, clickedElement) {
    // 1. Đổi ảnh chính
    document.getElementById('mainProductImage').src = imageURL;
    
    // 2. Cập nhật trạng thái active cho ảnh nhỏ
    document.querySelectorAll('.thumbnail-item img').forEach(img => {
        img.classList.remove('active');
    });
    clickedElement.classList.add('active');
}

// --- CHỨC NĂNG 2: Chọn size & Cập nhật input ẩn ---
document.querySelectorAll('.size-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.size-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        
        // Cập nhật giá trị size vào trường ẩn
        document.getElementById('selected-size').value = this.getAttribute('data-size');
    });
});

// Khởi tạo giá trị ban đầu cho trường ẩn (nếu chưa có click)
// Đảm bảo có nút size được chọn ban đầu
const initialSizeBtn = document.querySelector('.size-btn.active');
if (initialSizeBtn) {
    document.getElementById('selected-size').value = initialSizeBtn.getAttribute('data-size');
}
</script>

</body>
</html>