<?php

namespace Tests\Unit;

use App\VacationDeterminer;
use Exception;
use Tests\TestCase;

class VacationDeterminerTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function test_determine_in_input_year_when_no_employee_existed()
    {
        $determined_vacations = VacationDeterminer::determine(1950);
        $this->assertEmpty($determined_vacations);
    }

    /**
     * @throws Exception
     */
    public function test_determine_in_input_year_when_2_employee_existed()
    {
        $determined_vacations = VacationDeterminer::determine(2001);

        $expected = 2;
        $actual = count($determined_vacations);

        $this->assertEquals($expected, $actual);
    }

    /**
     * @throws Exception
     */
    public function test_determine_in_input_year_when_all_employee_existed()
    {
        $determined_vacations = VacationDeterminer::determine(2022);

        $expected = 5;
        $actual = count($determined_vacations);

        $this->assertEquals($expected, $actual);
    }
}
