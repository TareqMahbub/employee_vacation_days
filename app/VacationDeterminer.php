<?php

namespace App;

use App\Models\Employee;
use Exception;

class VacationDeterminer
{
    /**
     * @throws Exception
     */
    public static function determine(int $input_year): array{
        $determine_vacations = [];

        foreach(config('employees') as $employee){
            if(!array_key_exists('contract_start_date', $employee)) continue;
            if(count($employee) < 3) continue;

            $contract_start_date_components = explode(".", $employee['contract_start_date']);
            if(count($contract_start_date_components) != 3) continue;
            if((int)$contract_start_date_components[2] > $input_year) continue;

            $employee = Employee::get_instance($employee['name'], $employee['date_of_birth'], $employee['contract_start_date'], array_key_exists('special_contract', $employee) ? $employee['special_contract'] : null);

            $determine_vacations[] = [
                'name' => $employee->get_name(),
                'vacation_days' => $employee->calculate_vacation_days($input_year)
            ];
        }

        return $determine_vacations;
    }
}
