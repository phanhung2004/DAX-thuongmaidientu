<?php
// Hàm kiểm tra tam giác hợp lệ
function isValidTriangle($a, $b, $c) {
    return ($a + $b > $c) && ($a + $c > $b) && ($b + $c > $a);
}

// Nhập vào ba cạnh của tam giác
echo "Nhập độ dài cạnh a: ";
$a = trim(fgets(STDIN));
echo "Nhập độ dài cạnh b: ";
$b = trim(fgets(STDIN));
echo "Nhập độ dài cạnh c: ";
$c = trim(fgets(STDIN));

// Kiểm tra và hiển thị kết quả
if (isValidTriangle($a, $b, $c)) {
    echo "Đây là một tam giác hợp lệ.\n";
} else {
    echo "Đây không phải là một tam giác hợp lệ.\n";
}
?>
