<?php

use Modules\Base\Models\Setting;

function getTable(string $model): string
{
    return app($model)->getTable();
}


// Test database connection
try {
    if (! function_exists('setting')) {
        function setting($key)
        {
            $value = Setting::query()
                ->where('name', $key)
                ->first('payload');

            return ! is_null($value->payload) ? $value->payload : FALSE;
        }
    }
    if (! function_exists('dollar')) {
        function dollar($total)
        {
            $getDollar = setting('site_currency');
            if ($getDollar) {
                return "<b>" . number_format($total, 2) . "</b><small>$getDollar</small>";
            }
            else {
                return FALSE;
            }
        }
    }

}
catch (\Exception $e) {
    if (! function_exists('setting')) {
        function setting($key)
        {
            return $key;
        }
    }
}
