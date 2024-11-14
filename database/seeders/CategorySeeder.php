<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run():void
    {
        // Define path to CSV file
        $csvFilePath = database_path('seeders/job_categories_list.csv');

        // Check if file exists
        if (file_exists($csvFilePath)) {
            // Open the CSV file and read its content
            $file = fopen($csvFilePath, 'r');

            // Skip the header row
            $header = fgetcsv($file);

            // Loop through each row
            while (($row = fgetcsv($file)) !== false) {
                DB::table('categories')->insert([
                    'category' => $row[0],
                ]);
            }

            // Close the file
            fclose($file);
        } else {
            echo "CSV file not found: $csvFilePath";
        }
    }
}
