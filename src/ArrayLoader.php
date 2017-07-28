<?php

namespace DotenvSafe;

use Dotenv\Loader;

class ArrayLoader extends Loader
{
    /**
     * Returns an array of key, value pairs instead of loading them 
     * into the environment.
     *
     * @return array
     */
    public function load()
    {
        $this->ensureFileIsReadable();
        $filePath = $this->filePath;
        $data = [];

        $lines = $this->readLinesFromFile($filePath);
        
        foreach ($lines as $line) {
            if (!$this->isComment($line) && $this->looksLikeSetter($line)) {
                list($name, $value) = $this->normaliseEnvironmentVariable($line, null);
                $data[$name] = $value;
            }
        }

        return $data;
    }
}