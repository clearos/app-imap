
Name: app-imap
Epoch: 1
Version: 2.2.1
Release: 1%{dist}
Summary: IMAP and POP Server
License: GPLv3
Group: ClearOS/Apps
Source: %{name}-%{version}.tar.gz
Buildarch: noarch
Requires: %{name}-core = 1:%{version}-%{release}
Requires: app-base
Requires: app-smtp >= 1:1.2.4

%description
The IMAP and POP server provides a standard set of services for mail clients (Thunderbird, Mail, Evolution, Outlook/Express etc.) to connect to the server and retrieve/display email.

%package core
Summary: IMAP and POP Server - Core
License: LGPLv3
Group: ClearOS/Libraries
Requires: app-base-core
Requires: cyrus-imapd >= 2.3.16
Requires: app-accounts >= 1:2.1.0
Requires: app-imap-plugin-core
Requires: app-certificate-manager
Requires: app-mail-extension-core >= 1:1.1.1
Requires: app-mail-routing-core
Requires: app-smtp-core
Requires: app-tasks-core
Requires: imapsync

%description core
The IMAP and POP server provides a standard set of services for mail clients (Thunderbird, Mail, Evolution, Outlook/Express etc.) to connect to the server and retrieve/display email.

This package provides the core API and libraries.

%prep
%setup -q
%build

%install
mkdir -p -m 755 %{buildroot}/usr/clearos/apps/imap
cp -r * %{buildroot}/usr/clearos/apps/imap/

install -d -m 0755 %{buildroot}/etc/clearos/imap.d
install -d -m 0755 %{buildroot}/var/clearos/imap
install -d -m 0755 %{buildroot}/var/clearos/imap/backup
install -D -m 0644 packaging/app-imap.cron %{buildroot}/etc/cron.d/app-imap
install -D -m 0644 packaging/attack-detector-cyrus-imap.php %{buildroot}/var/clearos/attack_detector/filters/cyrus-imap.php
install -D -m 0644 packaging/authorize %{buildroot}/etc/clearos/imap.d/authorize
install -D -m 0644 packaging/clearos-cyrus-imap.conf %{buildroot}/etc/fail2ban/jail.d/clearos-cyrus-imap.conf
install -D -m 0644 packaging/cyrus-imapd.php %{buildroot}/var/clearos/base/daemon/cyrus-imapd.php
install -D -m 0644 packaging/imap-ldap-aliases.cf %{buildroot}/var/clearos/ldap/synchronize/imap-ldap-aliases.cf
install -D -m 0644 packaging/imap-ldap-groups.cf %{buildroot}/var/clearos/ldap/synchronize/imap-ldap-groups.cf

%post
logger -p local6.notice -t installer 'app-imap - installing'

%post core
logger -p local6.notice -t installer 'app-imap-core - installing'

if [ $1 -eq 1 ]; then
    [ -x /usr/clearos/apps/imap/deploy/install ] && /usr/clearos/apps/imap/deploy/install
fi

[ -x /usr/clearos/apps/imap/deploy/upgrade ] && /usr/clearos/apps/imap/deploy/upgrade

exit 0

%preun
if [ $1 -eq 0 ]; then
    logger -p local6.notice -t installer 'app-imap - uninstalling'
fi

%preun core
if [ $1 -eq 0 ]; then
    logger -p local6.notice -t installer 'app-imap-core - uninstalling'
    [ -x /usr/clearos/apps/imap/deploy/uninstall ] && /usr/clearos/apps/imap/deploy/uninstall
fi

exit 0

%files
%defattr(-,root,root)
/usr/clearos/apps/imap/controllers
/usr/clearos/apps/imap/htdocs
/usr/clearos/apps/imap/views

%files core
%defattr(-,root,root)
%exclude /usr/clearos/apps/imap/packaging
%dir /usr/clearos/apps/imap
%dir /etc/clearos/imap.d
%dir /var/clearos/imap
%dir /var/clearos/imap/backup
/usr/clearos/apps/imap/deploy
/usr/clearos/apps/imap/language
/usr/clearos/apps/imap/libraries
/etc/cron.d/app-imap
/var/clearos/attack_detector/filters/cyrus-imap.php
%config(noreplace) /etc/clearos/imap.d/authorize
%config(noreplace) /etc/fail2ban/jail.d/clearos-cyrus-imap.conf
/var/clearos/base/daemon/cyrus-imapd.php
/var/clearos/ldap/synchronize/imap-ldap-aliases.cf
/var/clearos/ldap/synchronize/imap-ldap-groups.cf
