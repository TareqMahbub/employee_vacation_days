<?php

namespace App\Models;

use Carbon\Carbon;
use Exception;

class Employee{
    private static int $YEARLY_MIN_VACATION_DAYS = 26;

    private string $name;
    private Carbon $date_of_birth;
    private Carbon $contract_start_date;
    private ?int $special_contract_days;

    /**
     * @param string $name
     * @param Carbon $date_of_birth
     * @param Carbon $contract_start_date
     * @param int|null $special_contract_days
     */
    private function __construct(string $name, Carbon $date_of_birth, Carbon $contract_start_date, ?int $special_contract_days = null)
    {
        $this->name = $name;
        $this->date_of_birth = $date_of_birth;
        $this->contract_start_date = $contract_start_date;
        $this->special_contract_days = $special_contract_days;
    }

    /**
     * @param string $name
     * @param string $date_of_birth
     * @param string $contract_start_date
     * @param int|null $special_contract_days
     * @return Employee
     *
     * @throws Exception
     */
    static function get_instance(string $name, string $date_of_birth, string $contract_start_date, ?int $special_contract_days = null): Employee
    {
        if(empty($name)) throw new Exception("name cannot be empty in func:" . __FUNCTION__);
        if(empty($date_of_birth)) throw new Exception("date_of_birth cannot be empty in func:" . __FUNCTION__);
        if(empty($contract_start_date)) throw new Exception("Empty contract_start_date found in func:" . __FUNCTION__);

        if(strlen($name) > 50) throw new Exception("Unusually large name: $name entered in func:" . __FUNCTION__);
        if(strlen($date_of_birth) > 10) throw new Exception("Unusually large date_of_birth: $date_of_birth entered in func:" . __FUNCTION__);
        if(strlen($contract_start_date) > 10) throw new Exception("Unusually large contract_start_date: $contract_start_date entered in func:" . __FUNCTION__);

        $dob_components = explode(".", $date_of_birth);
        if(count($dob_components) != 3) throw new Exception("Unknown date_of_birth format found in func:" . __FUNCTION__);

        $dob_day = intval($dob_components[0]);
        $dob_month = intval($dob_components[1]);
        $dob_year = intval($dob_components[2]);
        if($dob_day < 1 || $dob_day > 31) throw new Exception("Invalid day found in date_of_birth in func:" . __FUNCTION__);
        if($dob_month < 1 || $dob_month > 12) throw new Exception("Invalid month found in date_of_birth in func:" . __FUNCTION__);
        if($dob_year < 1 || $dob_year > now()->year) throw new Exception("Invalid year found in date_of_birth in func:" . __FUNCTION__);

        $contract_start_date_components = explode(".", $contract_start_date);
        if(count($contract_start_date_components) != 3) throw new Exception("Unknown contract_start_date format found in func:" . __FUNCTION__);

        $contract_start_day = intval($contract_start_date_components[0]);
        $contract_start_month = intval($contract_start_date_components[1]);
        $contract_start_year = intval($contract_start_date_components[2]);
        if($contract_start_day < 1 || $contract_start_day > 31) throw new Exception("Invalid day found in contract_start_date in func:" . __FUNCTION__);
        if($contract_start_month < 1 || $contract_start_month > 12) throw new Exception("Invalid month found in contract_start_date in func:" . __FUNCTION__);
        if($contract_start_year < 1) throw new Exception("Invalid year found in contract_start_date in func:" . __FUNCTION__);

        if(!empty($special_contract_days) && $special_contract_days < 0) throw new Exception("special_contract_days found less than ZERO in func:" . __FUNCTION__);
        if(!empty($special_contract_days) && $special_contract_days > 365) throw new Exception("special_contract_days crossed 365 in func:" . __FUNCTION__);

        $date_of_birth = Carbon::createFromFormat('d.m.Y', $date_of_birth);
        $contract_start_date = Carbon::createFromFormat('d.m.Y', $contract_start_date);

        if($contract_start_date->lessThan($date_of_birth)) throw new Exception("contract_start_date found earlier than date_of_birth in func:" . __FUNCTION__);

        return new Employee($name, $date_of_birth, $contract_start_date, $special_contract_days);
    }

    /**
     * @return string
     */
    function get_name(): string{
        return $this->name;
    }

    /**
     * @return bool
     */
    function has_special_contract(): bool{
        return !empty($this->special_contract_days);
    }

    /**
     * @param int $input_year
     * @return bool
     */
    function is_age_30_or_more_in_input_year(int $input_year): bool{
        return ($input_year - $this->date_of_birth->year + 1) >= 30;
    }

    /**
     * @param int $input_year
     * @return int
     */
    function years_of_service_upto_input_year(int $input_year): int{
        if($input_year < $this->contract_start_date->year) return 0;

        return $input_year - $this->contract_start_date->year;
    }

    /**
     * @return int
     */
    function number_of_full_months_served_in_joining_year(): int{
        return (12 - $this->contract_start_date->month) + ($this->contract_start_date->day == 1 ? 1 : 0);
    }

    /**
     * @param int $input_year
     * @return int
     */
    function calculate_vacation_days(int $input_year): int{
        $vacation_days =  $this->has_special_contract() ? $this->special_contract_days : self::$YEARLY_MIN_VACATION_DAYS;

        if($input_year == $this->contract_start_date->year){
            $vacation_days = (int)floor($vacation_days * $this->number_of_full_months_served_in_joining_year() / 12);
        }else{
            if($this->is_age_30_or_more_in_input_year($input_year)){
                $additional_years = (int)floor($this->years_of_service_upto_input_year($input_year) / 5);
                $vacation_days += $additional_years;
            }
        }

        return $vacation_days;
    }
}
