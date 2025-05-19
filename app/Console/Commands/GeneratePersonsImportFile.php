<?php
declare(strict_types=1);

namespace App\Console\Commands;

use Faker\Factory;
use Illuminate\Console\Command;
use Spatie\SimpleExcel\SimpleExcelWriter;

class GeneratePersonsImportFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'persons-import-file:generate
                            {rowsCount}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Генерирует тестовый файл импорта';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $rowsCount = (int)($this->argument('rowsCount'));

        $faker = Factory::create();

        $data = [];

        $writer = SimpleExcelWriter::create('output.xlsx', 'xlsx');

        for ($i = 1; $i <= $rowsCount; $i++) {
            $data[] = [
                'id' => rand(0, 1000000),
                'name' => $faker->firstName . ' ' . $faker->lastName,
                'date' => $faker->date('d.m.Y'),
            ];

            if (count($data) > 500) {
                $writer = $writer->addRows($data);
                $data = [];
            }
        }

        if (!empty($data)) {
            $writer = $writer->addRows($data);
        }

        $writer->close();
    }
}
