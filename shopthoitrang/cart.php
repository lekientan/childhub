<?php
session_start();

// Khởi tạo giỏ hàng nếu chưa có
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Hàm để định dạng tiền tệ
function format_price($price_str) {
    // Loại bỏ tất cả ký tự không phải số (trừ dấu phẩy/chấm)
    $cleaned_price = str_replace(['.', 'đ'], '', $price_str);
    $cleaned_price = str_replace(',', '', $cleaned_price);
    return (int)$cleaned_price;
}

// Tính tổng tiền giỏ hàng
$total_price = 0;
foreach ($_SESSION['cart'] as $item) {
    $price_value = format_price($item['price']);
    $total_price += $price_value * $item['quantity'];
}

// Xử lý XÓA sản phẩm
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['key'])) {
    $key_to_delete = $_GET['key'];
    if (isset($_SESSION['cart'][$key_to_delete])) {
        unset($_SESSION['cart'][$key_to_delete]);
        // Sắp xếp lại khóa mảng sau khi xóa
        $_SESSION['cart'] = array_values($_SESSION['cart']); 
    }
    header('Location: cart.php'); // Chuyển hướng lại
    exit();
}

?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng của bạn - Cham Collection</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        *{margin:0;padding:0;box-sizing:border-box;}
        body{font-family:Arial,Helvetica,sans-serif;background:#fafafa;color:#333;line-height:1.6;}
        
        /* Header giống index.php */
        .header{display:flex;justify-content:space-between;align-items:center;padding:15px 40px;background:#fff;position:sticky;top:0;z-index:1000;box-shadow:0 2px 10px rgba(0,0,0,.1);}
        .menu{display:flex;gap:30px;font-weight:600;font-size:15px;}
        .menu a{text-decoration:none; color:#333;}
        .menu a:hover{color:#b80000;}
        .right-icons a{margin-left:20px;font-size:20px;color:#333;}
        
        /* Giỏ hàng chính */
        .cart-container{max-width:1200px;margin:30px auto;padding:20px;display:flex;gap:30px;}
        .cart-items{flex:3;}
        .cart-summary{flex:1;background:#fff;padding:20px;border-radius:8px;box-shadow:0 4px 10px rgba(0,0,0,.05);height:fit-content;}
        
        .cart-title{font-size:28px;margin-bottom:20px;border-bottom:2px solid #ddd;padding-bottom:10px;font-weight:bold;}

        .cart-item{display:flex;border:1px solid #eee;margin-bottom:15px;padding:15px;background:#fff;border-radius:8px;position:relative;}
        .item-image img{width:100px;height:100px;object-fit:cover;border-radius:4px;}
        .item-details{flex:1;padding-left:15px;}
        .item-name{font-weight:bold;font-size:16px;margin-bottom:5px;}
        .item-info{font-size:14px;color:#666;margin-bottom:5px;}
        .item-price{font-size:18px;color:#d00;font-weight:bold;}
        .item-quantity{width:80px;text-align:center;}
        
        .item-remove{position:absolute;top:10px;right:10px;color:#999;cursor:pointer;}
        .item-remove:hover{color:#d00;}

        /* Tóm tắt đơn hàng */
        .summary-title{font-size:20px;font-weight:bold;margin-bottom:15px;border-bottom:1px solid #eee;padding-bottom:10px;}
        .summary-line{display:flex;justify-content:space-between;margin-bottom:10px;}
        .summary-total{font-size:22px;font-weight:bold;color:#d00;margin-top:20px;padding-top:15px;border-top:1px solid #eee;}
        .checkout-btn{display:block;width:100%;text-align:center;background:#000;color:#fff;padding:15px;border-radius:8px;font-weight:bold;margin-top:20px;text-decoration:none;}
        .checkout-btn:hover{background:#333;}
        
        .empty-cart{text-align:center;padding:50px;font-size:18px;color:#666;background:#fff;border-radius:8px;}
        .empty-cart a{color:#d00;text-decoration:none;font-weight:bold;}

        @media(max-width:768px){
            .cart-container{flex-direction:column;}
            .cart-summary{margin-top:20px;}
            .item-image img{width:80px;height:80px;}
            .cart-item{flex-wrap:wrap;}
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
        <a href="#"><i class="fas fa-user"></i></a>
    </div>
</header>

<div class="cart-container">
    <div class="cart-items">
        <h2 class="cart-title">Giỏ hàng của bạn (<?= count($_SESSION['cart']) ?> sản phẩm)</h2>

        <?php if (empty($_SESSION['cart'])): ?>
            <div class="empty-cart">
                Giỏ hàng trống. Vui lòng <a href="index.php">quay lại trang chủ</a> để mua sắm.
            </div>
        <?php else: ?>
            <?php foreach ($_SESSION['cart'] as $key => $item): ?>
                <div class="cart-item">
                    <div class="item-image">
                        <img src="<?= $item['image'] ?>" alt="<?= $item['name'] ?>">
                    </div>
                    <div class="item-details">
                        <div class="item-name"><?= $item['name'] ?></div>
                        <div class="item-info">Kích thước: <?= $item['size'] ?></div>
                        <div class="item-info">Số lượng: <?= $item['quantity'] ?></div>
                        <div class="item-price"><?= $item['price'] ?></div>
                    </div>
                    <a href="cart.php?action=delete&key=<?= $key ?>" class="item-remove" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">
                        <i class="fas fa-trash"></i>
                    </a>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

    </div>
    <div class="cart-summary">
        <div class="summary-title">Tóm tắt đơn hàng</div>
        <div class="summary-line">
            <span>Tạm tính (<?= count($_SESSION['cart']) ?> SP)</span>
            <span><?= number_format($total_price, 0, ',', '.') ?>đ</span>
        </div>
        <div class="summary-line">
            <span>Phí vận chuyển</span>
            <span>Miễn phí</span>
        </div>
        
        <div class="summary-total">
            <span>Tổng cộng</span>
            <span><?= number_format($total_price, 0, ',', '.') ?>đ</span>
        </div>
        
        <a href="#" class="checkout-btn">TIẾN HÀNH THANH TOÁN</a>
    </div>
</div>

</body>
</html>