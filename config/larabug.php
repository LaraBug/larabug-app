<?php

return [

    /*
     * This is your authorization key which you get from your profile.
     * @ http://www.larabug.com
     */
    'login_key' => env('LB_KEY'),

    /*
     * This is your project key which you receive when creating a project
     * @ http://www.larabug.com/projects
     */
    'project_key' => ENV('LB_PROJECT_KEY'),

    /*
     * Environments where LaraBug should report
     */
    'environments' => [
        'production',
        'local',
    ],

    /*
     * How many lines to show near exception line.
     */
    'lines_count' => 12,

    /*
     * Set the sleep time between duplicate exceptions.
     */
    'sleep' => 0,

    /*
     * List of exceptions to skip sending.
     */
    'except' => [
        'Symfony\Component\HttpKernel\Exception\NotFoundHttpException',
    ],

    /**
     * Use minimal frontend mode
     */
    'minimal_frontend' => env('MINIMAL_FRONTEND', true),

    /*
    |--------------------------------------------------------------------------
    | Server setting
    |--------------------------------------------------------------------------
    |
    | This setting allows you to change the server.
    |
    */

    'server' => env('LB_SERVER', 'https://larabug.test/api/log'),

    /*
    |--------------------------------------------------------------------------
    | Verify SSL setting
    |--------------------------------------------------------------------------
    |
    | Enables / disables the SSL verification when sending exceptions to LaraBug
    | Never turn SSL verification off on production instances
    |
    */
    'verify_ssl' => env('LB_VERIFY_SSL', false),

];
