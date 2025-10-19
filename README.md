# Shop Thú Cưng

## 👤 Thông tin nhóm sinh viên

- **Nguyễn Mai Anh** - Mã sinh viên: 23010490  
- **Bạch Phương Linh** - Mã sinh viên: 23010562  
- **Nguyễn Dương Ngọc Ánh** - Mã sinh viên: 23011500  

---

## 📝 Mô tả ứng dụng

**SHOP_THU_CUNG** là nền tảng mua sắm trực tuyến dành riêng cho thú cưng, nơi bạn có thể dễ dàng tìm thấy mọi thức ăn dinh dưỡng cho các “boss” đáng yêu của mình. Với giao diện thân thiện, dễ sử dụng và hình ảnh sinh động, website mang đến trải nghiệm mua sắm tiện lợi, nhanh chóng và đầy cảm hứng cho người nuôi.

**Ý nghĩa của dự án:**

- Chăm sóc thú cưng toàn diện  
- Tăng cường nhận thức về quyền lợi thú cưng  
- Thúc đẩy thương mại điện tử ngành thú cưng  
- Kết nối cộng đồng  

Ứng dụng web được xây dựng bằng **Laravel Framework**, thực hiện theo mô hình MVC. Ứng dụng gồm ít nhất 3 đối tượng chính:

- **User**: Người dùng hệ thống (có đăng ký/đăng nhập)  
- **Product**: Sản phẩm đang bán  
- **Category**: Danh mục phân loại thức ăn  
- **Cart**: Giỏ hàng (liên kết User & Product)  
- **Favorite**: Sản phẩm yêu thích (liên kết User & Product)  

---

## ⚙️ Các chức năng chính

1. **Xác thực và định danh**  
   - Sử dụng `Auth` để bảo vệ route và phân quyền  

2. **CRUD cho đối tượng `Order`**  
   - Thêm / Sửa / Xoá / Hiển thị danh sách đơn hàng  
   - Liên kết với bảng `users` và `products`  

3. **Áp dụng Eloquent ORM**  
   - Sử dụng model để truy vấn dữ liệu thay vì raw SQL  
   - Quan hệ:  
     - `User` hasMany `Cart`  
     - `User` hasMany `Favorite`  
     - `Product` belongsTo `Category`  
     - `Cart` belongsTo `User`  
     - `Cart` belongsTo `Product`  
     - `Favorite` belongsTo `User`  
     - `Favorite` belongsTo `Product`  

4. **Đảm bảo bảo mật (Security)**  
   - CSRF protection (`@csrf`)  
   - Escape dữ liệu đầu ra tránh XSS (`{{ $var }}`)  
   - Xác thực & phân quyền (`Auth`, middleware)  
   - Validation dữ liệu đầu vào (`FormRequest`, `validate`)  
   - Sử dụng query builder / Eloquent (tránh SQL Injection)  
   - Sử dụng session & cookies an toàn theo chuẩn Laravel  

5. **Triển khai cơ sở dữ liệu trên Cloud**  
   - Sử dụng dịch vụ database cloud  
   - Sử dụng `.env` để cấu hình kết nối cloud database  
   - Migrate và seed dữ liệu trực tiếp bằng lệnh:  
     ```bash
     php artisan migrate --seed
     ```

---

## 🚀 Cách chạy dự án

```bash
# Clone repo
git clone [link repo]
cd [tên thư mục]

# Cài đặt dependencies
composer install

# Copy file môi trường và chỉnh sửa thông tin DB
cp .env.example .env
# Chỉnh sửa .env theo thông tin database

# Tạo key ứng dụng
php artisan key:generate

# Migrate & seed database
php artisan migrate --seed

# Chạy ứng dụng
php artisan serve
