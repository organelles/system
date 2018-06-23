<?php

if (!function_exists('injectStringInFile')) {
    /**
     * Inject string in need position in the file.
     *
     * @param string $file     - path to file
     * @param string $data     - data for injection
     * @param int    $position - position in the file
     */
    function injectStringInFile($file, $data, $position)
    {
        $fpFile = fopen($file, "rw+");
        $fpTemp = fopen('php://temp', "rw+");

        stream_copy_to_stream($fpFile, $fpTemp);

        fseek($fpFile, $position);
        fseek($fpTemp, $position);

        fwrite($fpFile, $data . PHP_EOL);

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
     * @param string $data     - data for injection
     * @param int    $position - position in the file
     */
    function deleteStringFromFile($file, $position)
    {

    }
}