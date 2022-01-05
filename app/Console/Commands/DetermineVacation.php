<?php
/** @noinspection PhpUnused */

namespace App\Console\Commands;

use App\VacationDeterminer;
use Exception;
use Illuminate\Console\Command;
use Symfony\Component\Console\Command\Command as CommandAlias;

class DetermineVacation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vacation:determine';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Determines vacation days';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     * @throws Exception
     */
    public function handle(): int
    {
        $prompt = 'What is your "vacation year of interest"?';
        while(true){
            $input = $this->anticipate($prompt, [], now()->year);
            $input_year = intval($input);
            if($input_year >= now()->subYears(50)->year && $input_year <= now()->addYears(50)->year)
                break;

            $this->warn("invalid year");
            $prompt = 'Please enter a year between ' . now()->subYears(50)->year . ' - ' . now()->addYears(50)->year . ":";
        }

        $this->info("Your entered: $input_year");

        try{
            $determined_vacations = VacationDeterminer::determine($input_year);

            if(count($determined_vacations) == 0){
                $this->warn(PHP_EOL . '** All employees joined after year: ' . str_pad($input_year, "4", "0", STR_PAD_LEFT) . PHP_EOL);
                return CommandAlias::SUCCESS;
            }

            $this->line(PHP_EOL . '************* VACATION DAYS ****************');
            foreach($determined_vacations as $vacation){
                $this->line($vacation['name'] . ' --> ' . $vacation['vacation_days']);
            }
            $this->line(PHP_EOL);
        }catch (Exception $e){
            $this->warn(PHP_EOL . ' Sorry, an exception happened. Please try again' . PHP_EOL);
        }

        return CommandAlias::SUCCESS;
    }
}
