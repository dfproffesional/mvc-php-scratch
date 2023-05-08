<?php 

namespace Services;

class ErrorHandler
{
    const DISPLAY = [
        'development' => [
            'show' => 1,
            'report' => E_ALL,
            'startup' => 1,
        ],
        'production' => [
            'show' => 0,
            'report' => E_ERROR,
            'startup' => 0
        ]
    ];

    /**
     * @return void
     */
    public function displayErrors(){
        ini_set(
            'display_errors', 
            self::DISPLAY[getenv('ENV')]['show']
        );
        ini_set(
            'display_startup_errors', 
            self::DISPLAY[getenv('ENV')]['startup']
        );
        error_reporting(
            self::DISPLAY[getenv('ENV')]['report']
        );
    }
}