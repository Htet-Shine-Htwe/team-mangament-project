<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cache;

trait CacheModify
{
    /**
     * Method clearCache
     *
     * @param int $id [the name workspace name]
     * @param string $name [name of cache to clear]
     * @param string $type [ the type of cache to clear]
     * @return void
     */
    public function clearCache(int $id,string $name,string $type):void
    {
        $name = $this->getCacheName($id,$name,$type);

        Cache::forget($name);
    }

    public function getCacheName(int $id,string $name,string $type) :string
    {
        return 'ws-'. $id . $type . '-' . $name;
    }
}
