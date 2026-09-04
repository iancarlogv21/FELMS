<?php
require_once __DIR__ . '/../vendor/autoload.php';

$vendorPath = __DIR__ . '/../vendor/autoload.php';
if (!file_exists($vendorPath)) {
    die("<h1>Configuration Error: Composer Dependencies Not Found</h1>" .
        "<p>The required libraries are missing. Please run <code>composer install</code> in your project's root directory from your terminal.</p>");
}

use Dotenv\Dotenv;
use MongoDB\Client;
use MongoDB\Database as MongoDatabase;
use MongoDB\Collection;

class Database {
    private static ?Database $instance = null;
    private Client $client;
    private MongoDatabase $db;

    private function __construct() {
        try {
            $dotenvPath = __DIR__ . '/../';
            if (file_exists($dotenvPath . '.env')) {
                $dotenv = Dotenv\Dotenv::createImmutable($dotenvPath);
                $dotenv->safeLoad();
            }

            $uri = $_ENV['MONGO_URI'] ?? $_SERVER['MONGO_URI'] ?? getenv('MONGO_URI') ?? "mongodb://localhost:27017";
            $dbName = $_ENV['MONGO_DB_NAME'] ?? $_SERVER['MONGO_DB_NAME'] ?? getenv('MONGO_DB_NAME') ?? "Library";

            $this->client = new Client($uri);
            $this->db = $this->client->selectDatabase($dbName);

        } catch (\Exception $e) {
            throw new \Exception("MongoDB Connection Error: " . $e->getMessage());
        }
    }

    public static function getInstance(): self {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getClient(): Client {
        return $this->client;
    }

    // --- COLLECTION GETTERS ---

    public function books(): Collection {
        return $this->db->selectCollection('AddBook');
    }

    public function students(): Collection {
        return $this->db->selectCollection('Students');
    }

    public function borrows(): Collection {
        return $this->db->selectCollection('borrow_book');
    }
    
    public function returns(): Collection {
        return $this->db->selectCollection('return_book');
    }
    
    public function users(): Collection {
        return $this->db->selectCollection('users');
    }

    public function notifications(): Collection {
        return $this->db->selectCollection('notifications');
    }

    public function activity_logs(): Collection {
        return $this->db->selectCollection('activity_logs');
    }

    public function attendance_logs(): Collection {
        return $this->db->selectCollection('attendance_logs');
    }

    public function admins(): Collection {
        return $this->db->selectCollection('admins');
    }

    public function login_history(): Collection {
        return $this->db->selectCollection('login_history');
    }

    private function __clone() { }
    public function __wakeup() { }
}