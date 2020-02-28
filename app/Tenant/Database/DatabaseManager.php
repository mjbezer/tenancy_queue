<?php

namespace AtitudeAgenda\Tenant\Database;

use Illuminate\Support\Facades\DB;

class DatabaseManager
{
    static function newDatabase($database)
    {
        return DB::statement('
           CREATE DATABASE IF NOT EXISTS '.$database.' CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci
        ');

    } 
}