<?php

if (!defined("IN_MYBB"))
{
    die("Direct initialization of this file is not allowed.");
}

$plugins->add_hook("index_start", "noteplus_index_start");

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
            "description"   => "The message to display on the homepage. (plaintext, html)",
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

    $templates = [
        "noteplus_index" => [
            "template"  => $db->escape_string('
<br />
    <table border="0" cellspacing="{$theme[\'borderwidth\']}" cellpadding="{$theme[\'tablespace\']}" class="tborder">
		<tbody>
			<tr>
				<td class="trow1">
					{$mybb->settings[\'noteplus_message\']}
				</td>
			</tr>
		</tbody>
	</table>
<br />
'),
            "sid"       => "-1",
            "version"   => ""
        ]
    ];

    foreach ($templates as $name => $template) {
        $template["title"]      = $name;
        $template["dateline"]   = time();

        $db->insert_query("templates", $template);
    }

    rebuild_settings();
}

/**
 * @function Plugin is installed
 * @return bool
 */
function noteplus_is_installed()
{
    global $mybb;

    return isset($mybb->settings['noteplus_enabled']);
}

/**
 * @function Plugin uninstall
 * @return mixed
 */
function noteplus_uninstall()
{
    global $db;

    $db->delete_query("settinggroups", "name=\"noteplus_sg\"");
    $db->delete_query("settings", "name LIKE \"noteplus_%\"");

    $db->delete_query("templates", "title LIKE \"noteplus_%\"");

    rebuild_settings();
}

/**
 * @function Plugin start
 * @return templates
 */
function noteplus_index_start()
{
    global $templates, $mybb, $noteplus;

    eval('$noteplus  = "' . $templates->get("noteplus_index") . '";');
}