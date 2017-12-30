<?php

/**
 * @function Return plugin information
 * @return array
 */
function noteplus_info()
{
    return [
        "name"          => "NotePlus",
        "description"   => "Display note for all user.",
        "author"        => "",
        "authotsite"    => "",
        "version"       => "1.0",
        "compatibility" => "18*"
    ];
}

/**
 * @function Plugin installation
 * @return mixed
 */
function noteplus_install()
{
    global $db;

    $gid = $db->insert_query("settinggroups", [
        "name"          => "noteplus_sg",
        "title"         => "NotePlus",
        "description"   => "Configuration of NotePlus",
        "disporder"     => 1,
        "isdefault"     => 0
    ]);

    $settings = [
        "noteplus_enabled" => [
            "title"         => "Enabled",
            "description"   => "If the yes box is checked, the plugin will be activated.",
            "optionscode"   => "yesno",
            "value"         => 1,
            "disporder"     => 1
        ],
        "noteplus_message" => [
            "title"         => "Message",
            "description"   => "The message to display on the homepage.",
            "optionscode"   => "textarea",
            "value"         => "My message :)",
            "disporder"     => 2
        ]
    ];

    foreach ($settings as $name => $setting) {
        $setting["name"] = $name;
        $setting["gid"]  = $gid;

        $db->insert_query("settings", $setting);
    }

    rebuild_settings();
}