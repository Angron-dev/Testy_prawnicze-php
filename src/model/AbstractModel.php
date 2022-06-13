<<<<<<< HEAD
<?php 

declare(strict_types=1);

namespace App\Model;

use PDO;
use PDOException;
use App\Exception\ConfigurationException;
use App\Exception\StorageException;

abstract class AbstractModel 
{
    protected PDO $conn;

    public function __construct(array $config)
    {
    try {
      $this->validateConfig($config);
      $this->createConn($config);
    } catch (PDOException $e) {
      throw new StorageException('Connection error');
    }
    }

    private function createConn(array $config):void
    {
        $dsn = "mysql:dbname={$config['database']};host={$config['host']}";
        $this->conn = new PDO(
        $dsn,
        $config['user'],
        $config['password'],
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
        );
    }
    private function validateConfig(array $config): void
    {
    if (
      empty($config['database'])
      || empty($config['host'])
      || empty($config['user'])
      || empty($config['password'])
    ) {
      throw new ConfigurationException('Storage configuration error');
    }
    }
}
=======
<?php 

declare(strict_types=1);

namespace App\Model;

use PDO;
use PDOException;
use App\Exception\ConfigurationException;
use App\Exception\StorageException;

abstract class AbstractModel 
{
    protected PDO $conn;

    public function __construct(array $config)
    {
    try {
      $this->validateConfig($config);
      $this->createConn($config);
    } catch (PDOException $e) {
      throw new StorageException('Connection error');
    }
    }

    private function createConn(array $config):void
    {
        $dsn = "mysql:dbname={$config['database']};host={$config['host']}";
        $this->conn = new PDO(
        $dsn,
        $config['user'],
        $config['password'],
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
        );
    }
    private function validateConfig(array $config): void
    {
    if (
      empty($config['database'])
      || empty($config['host'])
      || empty($config['user'])
      || empty($config['password'])
    ) {
      throw new ConfigurationException('Storage configuration error');
    }
    }

}
>>>>>>> a1b8dcf (Możliwość dodawania, usuwania i przeglądania pytań oraz możliwość rozwiązywania testów.)
