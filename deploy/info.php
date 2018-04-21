<?php

/////////////////////////////////////////////////////////////////////////////
// General information
/////////////////////////////////////////////////////////////////////////////

$app['basename'] = 'imap';
$app['version'] = '2.5.0';
$app['vendor'] = 'ClearFoundation';
$app['packager'] = 'ClearFoundation';
$app['license'] = 'GPLv3';
$app['license_core'] = 'LGPLv3';
$app['description'] = lang('imap_app_description');

/////////////////////////////////////////////////////////////////////////////
// App name and categories
/////////////////////////////////////////////////////////////////////////////

$app['name'] = lang('imap_app_name');
$app['category'] = lang('base_category_server');
$app['subcategory'] = lang('base_subcategory_messaging');

/////////////////////////////////////////////////////////////////////////////
// Controllers
/////////////////////////////////////////////////////////////////////////////

$app['controllers']['imap']['title'] = $app['name'];
$app['controllers']['settings']['title'] = lang('base_settings');
$app['controllers']['policy']['title'] = lang('base_app_policy');

/////////////////////////////////////////////////////////////////////////////
// Packaging
/////////////////////////////////////////////////////////////////////////////

$app['requires'] = array(
    'app-accounts',
    'app-smtp',
    'app-certificate-manager'
);

$app['core_requires'] = array(
    'cyrus-imapd >= 2.3.16',
    'app-accounts-core >= 1:2.1.0',
    'app-imap-plugin-core',
    'app-certificate-manager-core >= 1:2.3.2',
    'app-mail-extension-core >= 1:2.3.0',
    'app-mail-routing-core >= 1:2.3.0',
    'app-smtp-core >= 1:1.2.4',
    'app-tasks-core',
    'imapsync',
);

$app['core_directory_manifest'] = array(
    '/etc/clearos/imap.d' => array(),
    '/var/clearos/imap' => array(),
    '/var/clearos/imap/backup' => array(),
);

$app['core_file_manifest'] = array(
    'app-imap.cron' => array( 'target' => '/etc/cron.d/app-imap'),
    'cyrus-imapd.php'=> array('target' => '/var/clearos/base/daemon/cyrus-imapd.php'),
    'imap-ldap-aliases.cf'=> array('target' => '/var/clearos/ldap/synchronize/imap-ldap-aliases.cf'),
    'imap-ldap-groups.cf'=> array('target' => '/var/clearos/ldap/synchronize/imap-ldap-groups.cf'),
    'authorize' => array(
        'target' => '/etc/clearos/imap.d/authorize',
        'mode' => '0644',
        'owner' => 'root',
        'group' => 'root',
        'config' => TRUE,
        'config_params' => 'noreplace',
    ),
    'attack-detector-cyrus-imap.php' => array('target' => '/var/clearos/attack_detector/filters/cyrus-imap.php'),
    'clearos-cyrus-imap.conf' => array(
        'target' => '/etc/fail2ban/jail.d/clearos-cyrus-imap.conf',
        'config' => TRUE,
        'config_params' => 'noreplace'
    ),
);
$app['delete_dependency'] = array(
    'app-imap-core',
    'app-imap-plugin-core',
    'imapsync',
    'cyrus-imapd'
);
