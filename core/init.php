<?php

use core\Log;

require_once "core/functions.php";

$_ENV = parse_ini_file(".env");

spl_autoload_register(function ($class) {
    $class = ltrim($class, '\\');

    // 1) Прямое сопоставление FQCN -> файл
    $root = dirname(__DIR__); // корень проекта (на уровень выше core/)
    $direct = $root . '/' . str_replace('\\', '/', $class) . '.php';
    if (is_file($direct)) {
        require_once $direct;
    } else {
        // 2) Рекурсивный фолбэк по models/bot (по имени файла)
        static $byBasename = null; // кэш: 'ButtonTrigger.php' => '/abs/path/.../ButtonTrigger.php'
        if ($byBasename === null) {
            $byBasename = [];
            $baseDir = $root . '/models/bot';
            if (is_dir($baseDir)) {
                $it = new RecursiveIteratorIterator(
                    new RecursiveDirectoryIterator($baseDir, FilesystemIterator::SKIP_DOTS)
                );
                foreach ($it as $file) {
                    if ($file->isFile() && strtolower($file->getExtension()) === 'php') {
                        $byBasename[$file->getBasename()] ??= $file->getPathname();
                    }
                }
            }
        }

        $basename = basename(str_replace('\\', '/', $class)) . '.php';
        if (!empty($byBasename[$basename]) && is_file($byBasename[$basename])) {
            require_once $byBasename[$basename];

            // Если запрашивали короткое имя (без namespace) — создаём алиас к фактическому FQCN по пути
            if (strpos($class, '\\') === false) {
                $prefix = rtrim($root . '/models/bot', '/\\') . DIRECTORY_SEPARATOR;
                $rel = substr($byBasename[$basename], strlen($prefix));              // напр. 'triggers/ButtonTrigger.php'
                $fqcn = 'models\\bot\\' . str_replace(['/', '\\'], '\\', substr($rel, 0, -4)); // -> 'models\bot\triggers\ButtonTrigger'
                if (class_exists($fqcn, false) && !class_exists($class, false)) {
                    class_alias($fqcn, $class);
                }
            }
        }
    }

    // 3) Авто-инициализация — только если класс реально загружен/алиаснут
    if (class_exists($class, false) && method_exists($class, 'init')) {
        $class::init();
    }
});
