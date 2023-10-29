<?php
// 最大ファイルサイズ（10MB）
$maxFileSize = 10 * 1024 * 1024; // バイト単位で指定

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    if ($_FILES['image']['size'] > $maxFileSize) {
        echo 'ファイルサイズが許容範囲を超えています。';
    } else {
        $format = $_POST['format']; // 選択された拡張子
        $uploadDir = 'uploads/';

        // アップロードされたファイルの情報を取得
        $uploadedFile = $_FILES['image'];
        $originalFileName = $uploadedFile['name'];
        $tmpFilePath = $uploadedFile['tmp_name'];

        // ファイルを指定のディレクトリに移動
        $newFileName = 'converted_image.' . $format;
        $newFilePath = $uploadDir . $newFileName;

        if (move_uploaded_file($tmpFilePath, $newFilePath)) {
            // 画像変換処理
            // ここで画像変換を行うコードを追加します

            // 生成した画像ファイルのパスを返す
            $newFileURL = '' . $newFilePath;


            // リダイレクト
            header('Location: ' . $newFileURL);
            exit;
        } else {
            echo 'ファイルのアップロードに失敗しました。';
        }
    }
} else {
    echo '無効なリクエストです.';
}
?>
