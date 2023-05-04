<?php 

namespace playbuff;

class Cache 
{
    use TSingletone;

    public static function set($key, $data, $seconds = TIME_CACHE) 
    {

        if ($seconds) {
            $content["data"] = $data;
            $content["end_time"] = time() + $seconds;
            $save = file_put_contents(CACHE . "/" . hash("ripemd128", $key) . ".tmp", serialize($content));
            if ($save) {
                return true;
            }
        }

        return false;
    }

    public static function get($key) 
    {
        $filepath = CACHE . "/" . hash("ripemd128", $key) . ".tmp";

        if (file_exists($filepath)) {
            $content = unserialize(file_get_contents($filepath));

            if (time() <= $content["end_time"]) {
                return $content["data"];
            }

            unlink($filepath);
        }

        return false;
    }

    public static function delete($key)
    {
        $filepath = CACHE . "/" . hash("ripemd128", $key) . ".tmp";

        if (file_exists($filepath)) { 
            unlink($filepath);
        }
    }
}

?>