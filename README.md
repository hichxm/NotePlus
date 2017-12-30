# ![NotePlus](https://img15.hostingpics.net/pics/786668notepad3.png "Logo Title Text 1") NotePlus

NotePlus est un plugin MyBB qui vous permettra d'afficher des notes pour vos utilisateurs de votre forum.

![Image](https://img15.hostingpics.net/pics/146826Screenshot20171230DEVSFORUM.png "Example")

![Image](https://img15.hostingpics.net/pics/630434Screenshot20171230DEVSFORUM1.png "Example")

## Installation

Pour installer le plugin rien de plus simple.

- Deplacer le fichier ```noteplus.php``` vers le dossier ```\inc\plugins\```
- Rendez vous sur la page administration de votre forum.
- Installer le plugin disponible sur le lien suivant ```/admin/index.php?module=config-plugins```
- Rendez vous sur les templates de votre theme.
- Modifiez le template ```Index Page Templates\index``` pour y ajouter le tag ```{$noteplus}```

```html
<html>
<head>
<title>{$mybb->settings['bbname']}</title>
{$headerinclude}
<script type="text/javascript">
<!--
	lang.no_new_posts = "{$lang->no_new_posts}";
	lang.click_mark_read = "{$lang->click_mark_read}";
// -->
</script>
</head>
<body>
{$header}
{$noteplus}
{$forums}
{$boardstats}

<dl class="forum_legend smalltext">
	<dt><span class="forum_status forum_on" title="{$lang->new_posts}"></span></dt>
	<dd>{$lang->new_posts}</dd>

	<dt><span class="forum_status forum_off" title="{$lang->no_new_posts}"></span></dt>
	<dd>{$lang->no_new_posts}</dd>

	<dt><span class="forum_status forum_offlock" title="{$lang->forum_locked}"></span></dt>
	<dd>{$lang->forum_locked}</dd>

	<dt><span class="forum_status forum_offlink" title="{$lang->forum_redirect}"></span></dt>
	<dd>{$lang->forum_redirect}</dd>
</dl>
<br class="clear" />
{$footer}
</body>
</html>
```

## Configuration

Pour configurer le plugin rendez-vous sur la page d'administration est modifier les parametres du plugin.

La configuration du plugin est simple.

```php
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
```

