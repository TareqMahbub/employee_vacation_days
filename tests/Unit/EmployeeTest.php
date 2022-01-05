<?php

namespace Tests\Unit;

use App\Models\Employee;
use Exception;
use PHPUnit\Framework\TestCase;

class EmployeeTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function test_joined_same_year_at_year_start_without_contract_age_less_30(){
        $employee = Employee::get_instance("Test", "30.12.1980", "01.01.2001");

        $expected = 26;
        $actual = $employee->calculate_vacation_days(2001);

        $this->assertEquals($expected, $actual);
    }

    /**
     * @throws Exception
     */
    public function test_joined_same_year_at_a_month_start_without_contract_age_less_30(){
        $employee = Employee::get_instance("Test", "30.12.1980", "01.02.2001");

        $expected = 23;
        $actual = $employee->calculate_vacation_days(2001);

        $this->assertEquals($expected, $actual);
    }

    /**
     * @throws Exception
     */
    public function test_joined_same_year_middle_of_a_month_without_contract_age_less_30(){
        $employee = Employee::get_instance("Test", "30.12.1980", "15.02.2001");

        $expected = 21;
        $actual = $employee->calculate_vacation_days(2001);

        $this->assertEquals($expected, $actual);
    }

    /**
     * @throws Exception
     */
    public function test_joined_same_year_at_year_start_with_contract_age_less_30(){
        $employee = Employee::get_instance("Test", "30.12.1980", "01.01.2001", 24);

        $expected = 24;
        $actual = $employee->calculate_vacation_days(2001);

        $this->assertEquals($expected, $actual);
    }

    /**
     * @throws Exception
     */
    public function test_joined_same_year_at_a_month_start_with_contract_age_less_30(){
        $employee = Employee::get_instance("Test", "30.12.1980", "01.02.2001", 24);

        $expected = 22;
        $actual = $employee->calculate_vacation_days(2001);

        $this->assertEquals($expected, $actual);
    }

    /**
     * @throws Exception
     */
    public function test_joined_same_year_middle_of_a_month_with_contract_age_less_30(){
        $employee = Employee::get_instance("Test", "30.12.1980", "15.02.2001", 24);

        $expected = 20;
        $actual = $employee->calculate_vacation_days(2001);

        $this->assertEquals($expected, $actual);
    }

    /**
     * @throws Exception
     */
    public function test_joined_before_input_year_at_year_start_without_contract_age_less_30(){
        $employee = Employee::get_instance("Test", "30.12.1980", "01.01.1999");

        $expected = 26;
        $actual = $employee->calculate_vacation_days(2001);

        $this->assertEquals($expected, $actual);
    }

    /**
     * @throws Exception
     */
    public function test_joined_before_input_year_at_a_month_start_without_contract_age_less_30(){
        $employee = Employee::get_instance("Test", "30.12.1980", "01.02.1999");

        $expected = 26;
        $actual = $employee->calculate_vacation_days(2001);

        $this->assertEquals($expected, $actual);
    }

    /**
     * @throws Exception
     */
    public function test_joined_before_input_year_middle_of_a_month_without_contract_age_less_30(){
        $employee = Employee::get_instance("Test", "30.12.1980", "15.02.1999");

        $expected = 26;
        $actual = $employee->calculate_vacation_days(2001);

        $this->assertEquals($expected, $actual);
    }

    /**
     * @throws Exception
     */
    public function test_joined_before_input_year_at_year_start_without_contract_age_30_or_more_gets_extra_day(){
        $employee = Employee::get_instance("Test", "30.12.1965", "01.01.1999");

        $expected = 26 + 1;
        $actual = $employee->calculate_vacation_days(2005);

        $this->assertEquals($expected, $actual);
    }

    /**
     * @throws Exception
     */
    public function test_joined_before_input_year_at_a_month_start_without_contract_30_or_more_gets_extra_day(){
        $employee = Employee::get_instance("Test", "30.12.1965", "01.02.1999");

        $expected = 26 + 1;
        $actual = $employee->calculate_vacation_days(2005);

        $this->assertEquals($expected, $actual);
    }

    /**
     * @throws Exception
     */
    public function test_joined_before_input_year_middle_of_a_month_without_contract_30_or_more_gets_extra_day(){
        $employee = Employee::get_instance("Test", "30.12.1965", "15.02.1999");

        $expected = 26 + 1;
        $actual = $employee->calculate_vacation_days(2005);

        $this->assertEquals($expected, $actual);
    }

    /**
     * @throws Exception
     */
    public function test_joined_before_input_year_at_year_start_without_contract_age_30_or_more_gets_2extra_day(){
        $employee = Employee::get_instance("Test", "30.12.1965", "01.01.1999");

        $expected = 26 + 2;
        $actual = $employee->calculate_vacation_days(2010);

        $this->assertEquals($expected, $actual);
    }

    /**
     * @throws Exception
     */
    public function test_joined_before_input_year_at_a_month_start_without_contract_30_or_more_gets_2extra_day(){
        $employee = Employee::get_instance("Test", "30.12.1965", "01.02.1999");

        $expected = 26 + 2;
        $actual = $employee->calculate_vacation_days(2010);

        $this->assertEquals($expected, $actual);
    }

    /**
     * @throws Exception
     */
    public function test_joined_before_input_year_middle_of_a_month_without_contract_30_or_more_gets_2extra_day(){
        $employee = Employee::get_instance("Test", "30.12.1965", "15.02.1999");

        $expected = 26 + 2;
        $actual = $employee->calculate_vacation_days(2010);

        $this->assertEquals($expected, $actual);
    }

    /**
     * @throws Exception
     */
    public function test_joined_before_input_year_at_year_start_with_contract_age_less_30(){
        $employee = Employee::get_instance("Test", "30.12.1980", "01.01.1999", 24);

        $expected = 24;
        $actual = $employee->calculate_vacation_days(2001);

        $this->assertEquals($expected, $actual);
    }

    /**
     * @throws Exception
     */
    public function test_joined_before_input_year_at_a_month_start_with_contract_age_less_30(){
        $employee = Employee::get_instance("Test", "30.12.1980", "01.02.1999", 24);

        $expected = 24;
        $actual = $employee->calculate_vacation_days(2001);

        $this->assertEquals($expected, $actual);
    }

    /**
     * @throws Exception
     */
    public function test_joined_before_input_year_middle_of_a_month_with_contract_age_less_30(){
        $employee = Employee::get_instance("Test", "30.12.1980", "15.02.1999", 24);

        $expected = 24;
        $actual = $employee->calculate_vacation_days(2001);

        $this->assertEquals($expected, $actual);
    }

    /**
     * @throws Exception
     */
    public function test_joined_before_input_year_at_year_start_with_contract_age_30_or_more_gets_extra_day(){
        $employee = Employee::get_instance("Test", "30.12.1965", "01.01.1999", 24);

        $expected = 24 + 1;
        $actual = $employee->calculate_vacation_days(2005);

        $this->assertEquals($expected, $actual);
    }

    /**
     * @throws Exception
     */
    public function test_joined_before_input_year_at_a_month_start_with_contract_30_or_more_gets_extra_day(){
        $employee = Employee::get_instance("Test", "30.12.1965", "01.02.1999", 24);

        $expected = 24 + 1;
        $actual = $employee->calculate_vacation_days(2005);

        $this->assertEquals($expected, $actual);
    }

    /**
     * @throws Exception
     */
    public function test_joined_before_input_year_middle_of_a_month_with_contract_30_or_more_gets_extra_day(){
        $employee = Employee::get_instance("Test", "30.12.1965", "15.02.1999", 24);

        $expected = 24 + 1;
        $actual = $employee->calculate_vacation_days(2005);

        $this->assertEquals($expected, $actual);
    }


    /**
     * @throws Exception
     */
    public function test_joined_before_input_year_at_year_start_with_contract_age_30_or_more_gets_2extra_day(){
        $employee = Employee::get_instance("Test", "30.12.1965", "01.01.1999", 24);

        $expected = 24 + 2;
        $actual = $employee->calculate_vacation_days(2010);

        $this->assertEquals($expected, $actual);
    }

    /**
     * @throws Exception
     */
    public function test_joined_before_input_year_at_a_month_start_with_contract_30_or_more_gets_2extra_day(){
        $employee = Employee::get_instance("Test", "30.12.1965", "01.02.1999", 24);

        $expected = 24 + 2;
        $actual = $employee->calculate_vacation_days(2010);

        $this->assertEquals($expected, $actual);
    }

    /**
     * @throws Exception
     */
    public function test_joined_before_input_year_middle_of_a_month_with_contract_30_or_more_gets_2extra_day(){
        $employee = Employee::get_instance("Test", "30.12.1965", "15.02.1999", 24);

        $expected = 24 + 2;
        $actual = $employee->calculate_vacation_days(2010);

        $this->assertEquals($expected, $actual);
    }

    /**
     * @throws Exception
     */
    public function test_has_special_contract_where_contract_exists(){
        $employee = Employee::get_instance("Test", "30.12.1970", "01.01.2001", 22);

        $expected = true;
        $actual = $employee->has_special_contract();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @throws Exception
     */
    public function test_has_special_contract_where_no_contract_exists(){
        $employee = Employee::get_instance("Test", "30.12.1970", "01.01.2001");

        $expected = false;
        $actual = $employee->has_special_contract();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @throws Exception
     */
    public function test_is_age_30_or_more_in_input_year_before_30(){
        $employee = Employee::get_instance("Test", "30.12.1970", "01.01.2001", 22);

        $expected = true;
        $actual = $employee->is_age_30_or_more_in_input_year(1999);

        $this->assertEquals($expected, $actual);
    }

    /**
     * @throws Exception
     */
    public function test_is_age_30_or_more_in_input_year_on_30(){
        $employee = Employee::get_instance("Test", "30.12.1970", "01.01.2001", 22);

        $expected = true;
        $actual = $employee->is_age_30_or_more_in_input_year(2000);

        $this->assertEquals($expected, $actual);
    }

    /**
     * @throws Exception
     */
    public function test_is_age_30_or_more_in_input_year_after_30(){
        $employee = Employee::get_instance("Test", "30.12.1970", "01.01.2001", 22);

        $expected = true;
        $actual = $employee->is_age_30_or_more_in_input_year(2001);

        $this->assertEquals($expected, $actual);
    }

    /**
     * @throws Exception
     */
    public function test_years_of_service_upto_input_year_before_join(){
        $employee = Employee::get_instance("Test", "30.12.1970", "01.01.2001", 22);

        $expected = 0;
        $actual = $employee->years_of_service_upto_input_year(2000);

        $this->assertEquals($expected, $actual);
    }

    /**
     * @throws Exception
     */
    public function test_years_of_service_upto_input_year_after_join_with_0_year_diff(){
        $employee = Employee::get_instance("Test", "30.12.1970", "01.01.2001", 22);

        $expected = 0;
        $actual = $employee->years_of_service_upto_input_year(2001);

        $this->assertEquals($expected, $actual);
    }

    /**
     * @throws Exception
     */
    public function test_years_of_service_upto_input_year_after_join_with_1_year_diff(){
        $employee = Employee::get_instance("Test", "30.12.1970", "01.01.2001", 22);

        $expected = 1;
        $actual = $employee->years_of_service_upto_input_year(2002);

        $this->assertEquals($expected, $actual);
    }

    /**
     * @throws Exception
     */
    public function test_number_of_full_months_served_in_joining_year_with_jan_1st_start(){
        $employee = Employee::get_instance("Test", "30.12.1970", "01.01.2001", 22);

        $expected = 12;
        $actual = $employee->number_of_full_months_served_in_joining_year();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @throws Exception
     */
    public function test_number_of_full_months_served_in_joining_year_with_jan_15_start(){
        $employee = Employee::get_instance("Test", "30.12.1970", "15.01.2001", 22);

        $expected = 11;
        $actual = $employee->number_of_full_months_served_in_joining_year();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @throws Exception
     */
    public function test_number_of_full_months_served_in_joining_year_with_jan_31_start(){
        $employee = Employee::get_instance("Test", "30.12.1970", "31.01.2001", 22);

        $expected = 11;
        $actual = $employee->number_of_full_months_served_in_joining_year();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @throws Exception
     */
    public function test_number_of_full_months_served_in_joining_year_with_dec_1st_start(){
        $employee = Employee::get_instance("Test", "30.12.1970", "01.12.2001", 22);

        $expected = 1;
        $actual = $employee->number_of_full_months_served_in_joining_year();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @throws Exception
     */
    public function test_number_of_full_months_served_in_joining_year_with_dec_15_start(){
        $employee = Employee::get_instance("Test", "30.12.1970", "15.12.2001", 22);

        $expected = 0;
        $actual = $employee->number_of_full_months_served_in_joining_year();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @throws Exception
     */
    public function test_number_of_full_months_served_in_joining_year_with_dec_31_start(){
        $employee = Employee::get_instance("Test", "30.12.1970", "31.12.2001", 22);

        $expected = 0;
        $actual = $employee->number_of_full_months_served_in_joining_year();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @throws Exception
     */
    public function test_years_of_service_upto_input_year_before_after(){
        $employee = Employee::get_instance("Test", "30.12.1970", "01.01.2001", 22);

        $expected = 1;
        $actual = $employee->years_of_service_upto_input_year(2002);

        $this->assertEquals($expected, $actual);
    }

    public function test_employee_creation_with_empty_name()
    {
        $this->expectException(Exception::class);
        Employee::get_instance("", "30.12.1970", "01.01.2001");
    }

    public function test_employee_creation_with_empty_dob()
    {
        $this->expectException(Exception::class);
        Employee::get_instance("Test", "", "01.01.2001");
    }

    public function test_employee_creation_with_empty_contract_start_date()
    {
        $this->expectException(Exception::class);
        Employee::get_instance("Test", "30.12.1970", "");
    }

    public function test_employee_creation_with_large_name()
    {
        $this->expectException(Exception::class);
        Employee::get_instance("asdlfjasl;dfjaksldfjsa;dfjsakdfjadslkfjadslkfjsadfjaldsfjaslkdfjaldsfjadslfjadsl;fjadlkfjsadfjsal;dfjakdsfjasdlfjaskdfjsa", "30.12.1970", "01.01.2001");
    }

    public function test_employee_creation_with_large_dob()
    {
        $this->expectException(Exception::class);
        Employee::get_instance("Test", "asdlfjasl;dfjaksldfjsa;dfjsakdfjadslkfjadslkfjsadfjaldsfjaslkdfjaldsfjadslfjadsl;fjadlkfjsadfjsal;dfjakdsfjasdlfjaskdfjsa", "01.01.2001");
    }

    public function test_employee_creation_with_large_contract_start_date()
    {
        $this->expectException(Exception::class);
        Employee::get_instance("Test", "30.12.1970", "asdlfjasl;dfjaksldfjsa;dfjsakdfjadslkfjadslkfjsadfjaldsfjaslkdfjaldsfjadslfjadsl;fjadlkfjsadfjsal;dfjakdsfjasdlfjaskdfjsa");
    }

    public function test_employee_creation_without_dot_in_dob()
    {
        $this->expectException(Exception::class);
        Employee::get_instance("Test", "30121970", "");
    }

    public function test_employee_creation_with_dash_in_dob()
    {
        $this->expectException(Exception::class);
        Employee::get_instance("Test", "30-12-1970", "");
    }

    public function test_employee_creation_with_bad_dob()
    {
        $this->expectException(Exception::class);
        Employee::get_instance("Test", "xx.xx.xxxx", "");
    }

    public function test_employee_creation_with_bad_day_in_dob()
    {
        $this->expectException(Exception::class);
        Employee::get_instance("Test", "xx.11.1970", "");
    }

    public function test_employee_creation_with_bad_month_in_dob()
    {
        $this->expectException(Exception::class);
        Employee::get_instance("Test", "12.11.1970", "");
    }

    public function test_employee_creation_with_bad_year_in_dob()
    {
        $this->expectException(Exception::class);
        Employee::get_instance("Test", "12.11.xxxx", "12.11.1970");
    }

    public function test_employee_creation_without_dot_in_contract_start_date()
    {
        $this->expectException(Exception::class);
        Employee::get_instance("Test", "12.11.1970", "30121970");
    }

    public function test_employee_creation_with_dash_in_contract_start_date()
    {
        $this->expectException(Exception::class);
        Employee::get_instance("Test", "12.11.1970", "30-12-1970");
    }

    public function test_employee_creation_with_bad_contract_start_date()
    {
        $this->expectException(Exception::class);
        Employee::get_instance("Test", "12.11.1970", "xx.xx.xxxx");
    }

    public function test_employee_creation_with_bad_day_in_contract_start_date()
    {
        $this->expectException(Exception::class);
        Employee::get_instance("Test", "12.11.1970", "xx.11.1970");
    }

    public function test_employee_creation_with_bad_month_in_contract_start_date()
    {
        $this->expectException(Exception::class);
        Employee::get_instance("Test", "12.11.1970", "12.xx.1970");
    }

    public function test_employee_creation_with_bad_year_in_contract_start_date()
    {
        $this->expectException(Exception::class);
        Employee::get_instance("Test", "12.11.1970", "12.11.xxxx");
    }

    public function test_employee_creation_with_special_contract_days_less_than_zero()
    {
        $this->expectException(Exception::class);
        Employee::get_instance("Test", "30.12.1970", "01.01.2001", -1);
    }

    /**
     * @throws Exception
     */
    public function test_employee_creation_with_special_contract_days_equals_to_zero()
    {
        $employee = Employee::get_instance("Test", "30.12.1970", "01.01.2001", 0);
        $this->assertNotEmpty($employee);
    }

    public function test_employee_creation_with_special_contract_days_greater_than_365()
    {
        $this->expectException(Exception::class);
        Employee::get_instance("Test", "30.12.1970", "01.01.2001", 366);
    }

    /**
     * @throws Exception
     */
    public function test_employee_creation_with_join_date_earlier_than_dob()
    {
        $this->expectException(Exception::class);
        Employee::get_instance("Test", "01.01.2005", "01.01.2001", 0);
    }
}
