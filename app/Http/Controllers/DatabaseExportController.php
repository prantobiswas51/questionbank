<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class DatabaseExportController extends Controller
{
    public function index(): JsonResponse
    {
        set_time_limit(0);

        $connection = DB::connection();
        $schemaBuilder = $connection->getSchemaBuilder();
        $tablesMeta = $schemaBuilder->getTables();

        $tables = [];

        foreach ($tablesMeta as $tableMeta) {
            $tableName = $tableMeta['name'];
            $rows = DB::table($tableName)->get();

            $tables[$tableName] = [
                'meta' => $tableMeta,
                'columns' => $schemaBuilder->getColumns($tableName),
                'indexes' => $schemaBuilder->getIndexes($tableName),
                'row_count' => $rows->count(),
                'rows' => $rows,
            ];
        }

        return response()->json([
            'success' => true,
            'exported_at' => now()->toIso8601String(),
            'database' => [
                'connection' => $connection->getName(),
                'driver' => $connection->getDriverName(),
                'database' => $connection->getDatabaseName(),
            ],
            'table_count' => count($tables),
            'tables' => $tables,
        ]);
    }
}
