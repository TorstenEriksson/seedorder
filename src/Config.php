<?php

    namespace sta;

    class Config
    {
        private static $settings;

        public function __construct()
        {
            if (!self::$settings) {
                self::$settings = parse_ini_file( "../seedorder_config.ini");
            }
        }

        public function getSetting(string $key)
        {
            if (isset(self::$settings[$key])) {
                return self::$settings[$key];
            }
            return null;
        }

    }