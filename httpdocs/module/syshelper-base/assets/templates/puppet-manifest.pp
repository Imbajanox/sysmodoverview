class j77_ssh_keys_v2::import_hostspecific_keys {

    %%FORALLHOSTS%%

    case $facts['networking']['fqdn'] {
        %%HOSTCASE%%
        default: {
#            notify { "There are no custom SSH-Keys defined for ${facts['networking']['fqdn']}!":
#            withpath => false,
#            }
        }
    }

}
