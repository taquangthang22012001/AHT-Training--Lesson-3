#Tips;
- Có thể khai báo phương thức là static để có thể gọi nó mà không cần tạo đối tượng của lớp đó, đặc biệt là khi tạo đối tượng từ dữ liệu như JSON.

- Không nên lạm dụng ném ngoại lệ, chỉ nên dùng khi có lỗi nghiêm trọng hoặc không tiếp tục trương trình được. Còn lại lỗi nhỏ nên xử lí luôn, ví dụ như trả về null hoặc false... tránh gián đoạn code.

- Toán tử instanceof sẽ trả về true kể cả khi một đối tượng được so sánh với lớp cha của nó