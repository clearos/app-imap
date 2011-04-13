<?php

/////////////////////////////////////////////////////////////////////////////
// General information
/////////////////////////////////////////////////////////////////////////////

$app['basename'] = 'imap';
$app['version'] = '6.0';
$app['release'] = '0.2';
$app['vendor'] = 'ClearFoundation';
$app['packager'] = 'ClearFoundation';
$app['license'] = 'GPLv3';
$app['license_core'] = 'LGPLv3';
$app['summary'] = 'POP and IMAP Server';
$app['description'] = 'The POP and IMAP servers provide standard messaging... blah blah blah.';  // FIXME

/////////////////////////////////////////////////////////////////////////////
// App name and categories
/////////////////////////////////////////////////////////////////////////////

$app['name'] = lang('imap_imap_and_pop_server');
$app['category'] = lang('base_category_server');
$app['subcategory'] = lang('base_subcategory_mail');

/////////////////////////////////////////////////////////////////////////////
// Controllers
/////////////////////////////////////////////////////////////////////////////

$app['controllers']['imap']['title'] = $app['name'];
$app['controllers']['imap']['tooltip'] = 'Using secure protocols is a good security practice and one that we strongly recommend.'; // FIXME translate

/////////////////////////////////////////////////////////////////////////////
// Packaging
/////////////////////////////////////////////////////////////////////////////

$app['core_dependencies'] = array(
    'cyrus-imapd >= 2.3.16',
);
