<?php

function site_setting($key) {
    $setting = \App\Models\Setting::first();
    return $setting->$key;
}
