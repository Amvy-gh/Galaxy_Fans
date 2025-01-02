<?php
include '../includes/main.php';

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    // Hapus data berdasarkan ID
    $stmt = $pdo->prepare("DELETE FROM fans WHERE id = ?");
    $stmt->execute([$id]);

    if ($stmt->rowCount() > 0) {
        // Cek apakah tabel kosong setelah penghapusan
        $stmtCheck = $pdo->query("SELECT COUNT(*) AS total FROM fans");
        $totalFans = $stmtCheck->fetch()['total'];

        if ($totalFans == 0) {
            // Reset AUTO_INCREMENT jika tabel kosong
            $pdo->exec("ALTER TABLE fans AUTO_INCREMENT = 1");
        }

        $_SESSION['message'] = "Fan berhasil dihapus!";
    } else {
        $_SESSION['message'] = "Gagal menghapus fan atau fan tidak ditemukan.";
    }
} else {
    $_SESSION['message'] = "ID fan tidak ditemukan.";
}

header("Location: ../views/index.php");
exit;