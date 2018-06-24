<?php

if (!function_exists('injectStringInFile')) {
    /**
     * Inject string in need position in the file.
     *
     * @param string $file     - path to file
     * @param string $string   - row for injection
     * @param int    $position - position in the file
     */
    function injectStringInFile($file, $string, $position)
    {
        $fpFile = fopen($file, "rw+");
        $fpTemp = fopen('php://temp', "rw+");

        stream_copy_to_stream($fpFile, $fpTemp);

        fseek($fpFile, $position);
        fseek($fpTemp, $position);

        fwrite($fpFile, $string . PHP_EOL);

        stream_copy_to_stream($fpTemp, $fpFile);

        fclose($fpFile);
        fclose($fpTemp);
    }
}

if (!function_exists('deleteStringFromFile')) {
    /**
     * Delete a string from the file.
     *
     * @param string $file     - path to file
     * @param string $string   - data for injection
     * @param int    $position - position in the file
     */
    function deleteStringFromFile($file, $string)
    {
        $rowNumber = 0;
        $array     = array();

        $read = fopen($file, "r");
        while (!feof($read)) {
            $array[$rowNumber] = fgets($read);
            ++$rowNumber;
        }
        fclose($read);

        $write = fopen($file, "w");
        foreach($array as $value) {
            if(!strstr($value, $string)) {
                fwrite($write, $value);
            }
        }
        fclose($write);
    }
}