<?php

if (!function_exists('DummyFunction')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function DummyFunction()
    {
    }
}
function coba()
{
    return database_path();
}
function tgl($tgl)
{
    return date('d/m/Y', strtotime($tgl));
}
