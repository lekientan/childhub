<?php
session_start();

// --- 1. CẤU HÌNH VÀ HÀM CƠ BẢN ---
// File dùng để lưu trữ dữ liệu người dùng (tạm coi như Database)
$users_file = 'users.json';
$message = '';

// Hàm tải dữ liệu người dùng từ file JSON
function get_users($file) {
    if (!file_exists($file)) {
        return [];
    }
    $content = file_get_contents($file);
    return json_decode($content, true) ?? [];
}

// Hàm lưu dữ liệu người dùng vào file JSON
function save_users($file, $users) {
    file_put_contents($file, json_encode($users, JSON_PRETTY_PRINT));
}

$users = get_users($users_file);

// Xác định chế độ hiện tại: 'login' (mặc định) hoặc 'register'
$mode = $_GET['mode'] ?? 'login';
if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in']) {
    $mode = 'profile';
}

// --- 2. XỬ LÝ ĐĂNG KÝ (REGISTER) ---
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'register') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $name = trim($_POST['name']);
    
    // Kiểm tra dữ liệu đầu vào
    if (empty($email) || empty($password) || empty($name)) {
        $message = '<div class="error">Vui lòng điền đầy đủ thông tin.</div>';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = '<div class="error">Email không hợp lệ.</div>';
    } elseif (strlen($password) < 6) {
        $message = '<div class="error">Mật khẩu phải có ít nhất 6 ký tự.</div>';
    } else {
        // Kiểm tra Email đã tồn tại chưa
        $email_exists = false;
        foreach ($users as $user) {
            if ($user['email'] === $email) {
                $email_exists = true;
                break;
            }
        }

        if ($email_exists) {
            $message = '<div class="error">Email này đã được đăng ký.</div>';
        } else {
            // Mã hóa mật khẩu trước khi lưu trữ
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
            // Thêm người dùng mới vào mảng
            $new_user = [
                'name' => $name,
                'email' => $email,
                'password' => $hashed_password,
                'registered_at' => date('Y-m-d H:i:s')
            ];
            $users[] = $new_user;
            save_users($users_file, $users);

            $message = '<div class="success">Đăng ký thành công! Vui lòng đăng nhập.</div>';
            $mode = 'login'; // Chuyển sang form đăng nhập
        }
    }
}

// --- 3. XỬ LÝ ĐĂNG NHẬP (LOGIN) ---
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'login') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $found_user = null;
    foreach ($users as $user) {
        if ($user['email'] === $email) {
            $found_user = $user;
            break;
        }
    }

    if ($found_user && password_verify($password, $found_user['password'])) {
        // Đăng nhập thành công
        $_SESSION['is_logged_in'] = true;
        $_SESSION['user_email'] = $found_user['email'];
        $_SESSION['user_name'] = $found_user['name'];
        header('Location: user.php'); // Chuyển hướng về trang profile
        exit();
    } else {
        $message = '<div class="error">Email hoặc mật khẩu không chính xác.</div>';
    }
}

// --- 4. XỬ LÝ ĐĂNG XUẤT (LOGOUT) ---
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    session_destroy();
    header('Location: user.php?mode=login');
    exit();
}

// Lấy dữ liệu người dùng hiện tại cho trang profile
$current_user_data = [];
if ($mode == 'profile') {
    foreach ($users as $user) {
        if ($user['email'] === $_SESSION['user_email']) {
            $current_user_data = $user;
            break;
        }
    }
}

?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tài khoản - Cham Collection</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        *{margin:0;padding:0;box-sizing:border-box;}
        body{font-family:Arial,Helvetica,sans-serif;background:#fafafa;color:#333;line-height:1.6;}
        
        .header{display:flex;justify-content:space-between;align-items:center;padding:15px 40px;background:#fff;position:sticky;top:0;z-index:1000;box-shadow:0 2px 10px rgba(0,0,0,.1);}
        .menu{display:flex;gap:30px;font-weight:600;font-size:15px;}
        .menu a{text-decoration:none; color:#333;}
        .menu a:hover{color:#b80000;}
        .right-icons a{margin-left:20px;font-size:20px;color:#333;}
        
        /* User Container */
        .user-container{max-width:450px;margin:50px auto;padding:40px;background:#fff;border-radius:12px;box-shadow:0 4px 15px rgba(0,0,0,.08);}
        .user-title{font-size:32px;margin-bottom:30px;font-weight:bold;color:#222;text-align:center;}

        /* Form Style */
        .auth-form input{width:100%;padding:12px 15px;margin-bottom:15px;border:1px solid #ddd;border-radius:6px;font-size:16px;}
        .auth-form button{width:100%;padding:15px;background:#000;color:#fff;border:none;border-radius:6px;font-size:18px;font-weight:bold;cursor:pointer;transition:.3s;}
        .auth-form button:hover{background:#333;}
        .switch-link{text-align:center;margin-top:20px;font-size:14px;}
        .switch-link a{color:#b80000;text-decoration:none;font-weight:bold;}

        /* Message */
        .message{padding:10px;margin-bottom:20px;border-radius:6px;text-align:center;font-weight:bold;}
        .error{background:#fdd;color:#d00;border:1px solid #d00;}
        .success{background:#dfd;color:#0a0;border:1px solid #0a0;}

        /* Profile Style */
        .profile-header{display:flex;align-items:center;margin-bottom:30px;padding-bottom:20px;border-bottom:1px solid #eee;}
        .profile-icon{font-size:40px;margin-right:20px;color:#000;}
        .profile-name{font-size:24px;font-weight:bold;}
        .profile-details div{display:flex;justify-content:space-between;padding:12px 0;border-bottom:1px dashed #eee;font-size:15px;}
        .profile-details span:first-child{font-weight:bold;color:#555;}
        .profile-actions{margin-top:30px;display:flex;gap:15px;}
        .profile-actions a{flex:1;text-align:center;padding:12px;border-radius:6px;font-weight:bold;text-decoration:none;transition:.3s;}
        .action-edit{background:#555;color:#fff;}
        .action-edit:hover{background:#777;}
        .action-logout{background:#b80000;color:#fff;}
        .action-logout:hover{background:#d00;}

        @media(max-width:600px){
            .user-container{margin:30px 15px;padding:25px;}
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

<div class="user-container">
    <?php 
    // Hiển thị thông báo nếu có
    if (!empty($message)) {
        echo '<div class="message-wrapper">' . $message . '</div>';
    }
    
    // --- 1. PROFILE (ĐÃ ĐĂNG NHẬP) ---
    if ($mode == 'profile'): 
    ?>
        <div class="profile">
            <div class="profile-header">
                <i class="fas fa-user-circle profile-icon"></i>
                <div class="profile-name">Xin chào, **<?= htmlspecialchars($_SESSION['user_name']) ?>**</div>
            </div>

            <h2 class="user-title" style="margin-bottom:15px;">Thông tin Tài khoản</h2>
            
            <div class="profile-details">
                <div><span>Tên khách hàng:</span> <span><?= htmlspecialchars($current_user_data['name'] ?? 'Chưa cập nhật') ?></span></div>
                <div><span>Email:</span> <span><?= htmlspecialchars($current_user_data['email'] ?? 'Không rõ') ?></span></div>
                <div><span>Ngày tham gia:</span> <span><?= htmlspecialchars(date('d/m/Y', strtotime($current_user_data['registered_at'] ?? ''))) ?></span></div>
            </div>

            <div class="profile-actions">
                <a href="#" class="action-edit">Quản lý Đơn hàng</a>
                <a href="?action=logout" class="action-logout">Đăng xuất</a>
            </div>
        </div>

    <?php 
    // --- 2. ĐĂNG KÝ (REGISTER FORM) ---
    elseif ($mode == 'register'): 
    ?>
        <h2 class="user-title">Đăng ký Tài khoản mới</h2>

        <form method="POST" action="user.php?mode=register" class="auth-form">
            <input type="hidden" name="action" value="register">
            <input type="text" name="name" placeholder="Họ và Tên" required value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">
            <input type="email" name="email" placeholder="Địa chỉ Email" required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
            <input type="password" name="password" placeholder="Mật khẩu (>= 6 ký tự)" required>
            <button type="submit">Đăng ký</button>
        </form>

        <div class="switch-link">
            Đã có tài khoản? <a href="user.php?mode=login">Đăng nhập ngay</a>
        </div>

    <?php 
    // --- 3. ĐĂNG NHẬP (LOGIN FORM) ---
    else: 
    ?>
        <h2 class="user-title">Đăng nhập</h2>

        <form method="POST" action="user.php?mode=login" class="auth-form">
            <input type="hidden" name="action" value="login">
            <input type="email" name="email" placeholder="Địa chỉ Email" required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
            <input type="password" name="password" placeholder="Mật khẩu" required>
            <button type="submit">Đăng nhập</button>
        </form>

        <div class="switch-link">
            Chưa có tài khoản? <a href="user.php?mode=register">Đăng ký ngay</a>
        </div>

    <?php endif; ?>
</div>

</body>
</html>