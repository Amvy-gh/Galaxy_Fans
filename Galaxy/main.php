<?php
session_start(); // Pastikan sesi dimulai

$host = 'localhost';
$db = 'rimuru_fans';
$user = 'root';
$pass = ''; 
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}

class Fans {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function saveData($data) {
        $stmt = $this->pdo->prepare("INSERT INTO fans (name, gender, interests, fandom_level, browser, ip_address) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute($data);
    }

    public function getData() {
        // Menangani error pada query
        try {
            $stmt = $this->pdo->query("SELECT * FROM fans ORDER BY created_at DESC");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return []; // Mengembalikan array kosong jika terjadi error
        }
    }
}

$fanData = new Fans($pdo);

// Menangani POST request untuk menyimpan data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mengambil data dari form
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $interests = isset($_POST['interests']) ? implode(', ', $_POST['interests']) : '';
    $fandomLevel = $_POST['fandom_level'];
    $browser = $_SERVER['HTTP_USER_AGENT'];
    $ip = $_SERVER['REMOTE_ADDR'];

    // Menyimpan data ke database
    $fanData->saveData([$name, $gender, $interests, $fandomLevel, $browser, $ip]);
    
    $_SESSION['message'] = "Welcome to the fan club! Your data has been recorded among the stars! ";
    $_SESSION['message'] = "Welcome to the fan club! Your data has been recorded among the stars! ✨";
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Mengambil data fans dari database
$fans = $fanData->getData();
if ($fans === false) {
    $fans = []; // Jika tidak ada data atau terjadi error, set fans sebagai array kosong
}
// Mengurutkan id dalam array
$fans = array_reverse($fans);
?>

