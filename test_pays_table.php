<?php

// Simple test script to verify pays table structure
require 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

try {
    $columns = \Illuminate\Support\Facades\Schema::getColumnListing('pays');
    echo "Pays table columns:\n";
    foreach ($columns as $column) {
        echo "- $column\n";
    }
    
    echo "\nChecking specific columns:\n";
    echo "estado exists: " . (\Illuminate\Support\Facades\Schema::hasColumn('pays', 'estado') ? 'YES' : 'NO') . "\n";
    echo "fecha_pago exists: " . (\Illuminate\Support\Facades\Schema::hasColumn('pays', 'fecha_pago') ? 'YES' : 'NO') . "\n";
    echo "observaciones exists: " . (\Illuminate\Support\Facades\Schema::hasColumn('pays', 'observaciones') ? 'YES' : 'NO') . "\n";
    
    echo "\nTesting Pay model:\n";
    $pay = new \App\Models\Pay();
    echo "Pay model fillable fields:\n";
    foreach ($pay->getFillable() as $field) {
        echo "- $field\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
