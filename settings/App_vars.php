<?php
    // This file handles all Application variables
    
    // Tamaño máximo de archivo (en bytes)
    if(!defined('MAX_FILE_SIZE'))
        define('MAX_FILE_SIZE', 3 * (1024 ** 2));

    // Switch para mantenimiento
    if(!defined('IS_IN_MAINTENANCE'))
        define('IS_IN_MAINTENANCE', false);
?>  