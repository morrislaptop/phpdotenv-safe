<?php

namespace DotenvSafe;

use Dotenv\Dotenv;
use Dotenv\Validator;

/**
 * This is the dotenv class.
 *
 * It's responsible for loading a `.env` file in the given directory and
 * setting the environment vars.
 */
class DotenvSafe extends Dotenv
{
    /**
     * The file path.
     *
     * @var string
     */
    protected $exampleFilePath;

    /**
     * Create a new dotenv instance.
     *
     * @param string $path
     * @param string $file
     *
     * @return void
     */
    public function __construct($path, $file = '.env', $example = false)
    {
        parent::__construct($path, $file);
        $this->exampleFilePath = $this->getExampleFilePath($path, $example);
        $this->arrayLoader = new ArrayLoader($this->exampleFilePath);
    }

    /**
     * Load environment file in given directory.
     *
     * @return array
     */
    public function load()
    {
        $data = $this->loadData();
        $this->check();

        return $data;
    }

    public function getExampleFilePath($path, $file)
    {
        if (!$file) {
          return $this->filePath . '.example';
        }

        $filePath = rtrim($path, DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR.$file;
    }

    public function check()
    {
        $data = $this->loadExampleData();
        
        return new Validator(array_keys($data), $this->loader);
    }

    public function loadExampleData()
    {
        return $this->arrayLoader->load();
    }
}