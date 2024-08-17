Bước 1: 
	- Sau khi tải và giải nén file .zip thì folder sẽ chứa mục:
		+source (chứa toàn bộ source code)
		+database.sql (cơ sở dữ liệu)
	-Truy cập thư mục 'htdocs' (ở nơi mà bạn cài đặt Xampp, ví dụ: 'D:\Application Support\xampp\htdocs') và xóa toàn bộ các 
	file trong thư mục này.
	-Copy toàn bộ các file trong folder 'source' vào folder 'htdocs'
	-Chạy các câu lệnh trong file 'database.sql' để tạo cơ sở dữ liệu và các bảng dữ liệu
	

Bước 2: Truy cập folder controller và chỉnh sửa connectDB.php để thay đổi thông số kết nối tới database của bạn:
	$hostname= "localhost";
	$user = "root"; // thay tên kết nối của bạn
	$password = "123456";  // thay thế mật khẩu của bạn
	$db_name = "musicweb2"; // không cần thay đổi vì đoạn mã SQL sẽ tự tạo database này

Bước 3: Bật Xampp và Start Apache bà MySQL
	-Truy cập: 'http://localhost/' để sử dụng wep app
	-Tài khoản truy cập trang admin: admin mật khẩu: 123456
	-Tài khoản truy cập trang user: duynguyen mật khẩu: 123456