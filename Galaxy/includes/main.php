<?php
session_start();

$host = 'localhost';
$db = 'galaxy_db';
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
        try {
            $stmt = $this->pdo->query("SELECT * FROM fans ORDER BY created_at DESC");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }
}

$fanData = new Fans($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $interests = isset($_POST['interests']) ? implode(', ', $_POST['interests']) : '';
    $fandomLevel = $_POST['fandom_level'];
    $browser = $_SERVER['HTTP_USER_AGENT'];
    $ip = $_SERVER['REMOTE_ADDR'];

    $fanData->saveData([$name, $gender, $interests, $fandomLevel, $browser, $ip]);
    
    $_SESSION['message'] = "Welcome to the Galaxy, $name! 🌌 Your data has been recorded among the stars! ✨";
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

$fans = $fanData->getData() ?: [];
$fans = array_reverse($fans);
?>