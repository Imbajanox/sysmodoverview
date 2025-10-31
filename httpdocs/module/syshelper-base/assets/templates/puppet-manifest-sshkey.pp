ssh_authorized_key {'%%RESOURCENAME%%':
    ensure  => present,
    name    => '%%TITLE%%',
    user    => '%%USER%%',
    type    => '%%KEYTYPE%%',
    options => [ 'environment="REMOTEUSER=%%TITLE%%"' ],
    key     => '%%KEYDATA%%',
}
