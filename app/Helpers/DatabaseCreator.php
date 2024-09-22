<?php

namespace App\Helpers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class DatabaseCreator
{
    public function createDatabase($databaseName)
    {
        try {
            $uniqueDatabase = Str::replace(['@', '.'], '', $databaseName);
            $connection = DB::connection('mysql');
            $databaseExists = DB::table('INFORMATION_SCHEMA.SCHEMATA')
                ->where('SCHEMA_NAME', $uniqueDatabase)
                ->exists();
            if (empty($databaseExists)) {
                $connection->statement("CREATE DATABASE $uniqueDatabase");
                \Log::info("email created: .$uniqueDatabase");
            } else {
                \Log::info("email already exists: .$uniqueDatabase");
                return "exists";
            }
            $connection->statement("USE $uniqueDatabase");
            $this->runMigrations($connection);
        } catch (\Exception $e) {
            \Log::info($e);
        }
    }

    private function runMigrations($connection)
    {
        $connection->statement("CREATE TABLE users (
            id INT PRIMARY KEY AUTO_INCREMENT,
            name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            mobile VARCHAR(10) NOT NULL,
            address VARCHAR(255) NOT NULL,
            remember_token VARCHAR(100) NULL,
            created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
        )");
    }
}
