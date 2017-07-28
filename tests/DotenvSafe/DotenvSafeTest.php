<?php

use DotenvSafe\DotenvSafe;
use Dotenv\Exception\ValidationException;

class DotenvSafeTest extends PHPUnit\Framework\TestCase
{
    /**
     * @var string
     */
    private $fixturesFolder;

    public function setUp()
    {
        $this->fixturesFolder = dirname(__DIR__).'/fixtures';
    }

    /**
     * @test
     */
    public function it_throws_an_exception_if_a_variable_is_missing()
    {
        $this->expectException(ValidationException::class);

        $dotenv = new DotenvSafe($this->fixturesFolder, 'missing.env');
        $dotenv->load();
    }

    /**
     * @test
     */
    public function it_loads_vars_if_no_variables_are_missing()
    {
        $dotenv = new DotenvSafe($this->fixturesFolder, 'working.env');
        $dotenv->load();

        $this->assertSame('Laravel', getenv('APP_NAME'));
    }

}