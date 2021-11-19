<?php

use PHPUnit\Framework\TestCase;

\Dotenv\Dotenv::createImmutable(__DIR__ . '/../../')->load();

use Rendi\Rframework\App\Core\Database\Database;

class DatabaseTest extends TestCase
{
    public function testcreateConnection()
    {
        $con = Database::getConnection(null);
        self::assertNotNull($con);
    }

    public function testsingleetonConnection()
    {
        $con1 = Database::getConnection(null);
        $con2 = Database::getConnection(null);

        self::assertSame($con1, $con2);
    }
}
