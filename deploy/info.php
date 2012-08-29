<?php

/////////////////////////////////////////////////////////////////////////////
// General information
/////////////////////////////////////////////////////////////////////////////

$app['basename'] = 'imap';
$app['version'] = '1.2.7';
$app['release'] = '1';
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
$app['subcategory'] = lang('base_subcategory_mail');

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
    'app-smtp >= 1:1.2.4',
);

$app['core_requires'] = array(
    'cyrus-imapd >= 2.3.16',
    'app-imap-plugin-core',
    'app-certificate-manager-core',
    'app-mail-extension-core >= 1:1.1.1',
    'app-mail-routing-core',
    'app-smtp-core',
    'app-tasks-core',
    'imapsync',
);

$app['core_directory_manifest'] = array(
    '/var/clearos/imap' => array(),
    '/var/clearos/imap/backup' => array(),
);

$app['core_file_manifest'] = array(
    'app-imap.cron' => array( 'target' => '/etc/cron.d/app-imap'),
    'cyrus-imapd.php'=> array('target' => '/var/clearos/base/daemon/cyrus-imapd.php'),
    'imap-ldap-aliases.cf'=> array('target' => '/var/clearos/ldap/synchronize/imap-ldap-aliases.cf'),
    'imap-ldap-groups.cf'=> array('target' => '/var/clearos/ldap/synchronize/imap-ldap-groups.cf'),
);
