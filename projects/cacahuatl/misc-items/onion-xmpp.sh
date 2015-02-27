#!/bin/bash
# #nottor's united federated onion states of xmpp
# Based on https://gist.github.com/xnyhps/33f7de50cf91a70acf93

if [[ $UID != "0" ]]; then
	echo "This script requires root permissions to run."
	exit 1
fi

CODENAME="$(lsb_release -sc)"

# Add prosody repo
cat >> /etc/apt/sources.list << EOF
deb http://packages.prosody.im/debian $CODENAME main
EOF
wget https://prosody.im/files/prosody-debian-packages.key -O- | apt-key add -
apt-get update

# Install prosody, tor and lua-bitop for mod_onions
# If we're on wheezy install lua-sec-prosody instead of lua-sec
if [[ "$CODENAME" == "wheezy" ]]; then
	apt-get -y install prosody tor lua-bitop lua-sec-prosody
else
	apt-get -y install prosody tor lua-bitop lua-sec
fi

# Setup the hidden service, remove the directory creation step, tor does this for us and doesn't like it if we do
cat >> /etc/tor/torrc << EOF
HiddenServiceDir /var/lib/tor/onion_xmpp/
HiddenServicePort 5222 127.0.0.1:5222
HiddenServicePort 5269 127.0.0.1:5269
EOF

# Reload tor, generate and fetch our onion hostname
service tor reload
ONION=`sudo cat /var/lib/tor/onion_xmpp/hostname`

# Fetch mod_onions for prosody
curl -o "/usr/lib/prosody/modules/mod_onions.lua" "https://prosody-modules.googlecode.com/hg/mod_onions/mod_onions.lua"

# Add self-signed certs
openssl req -sha256 -x509 -nodes -days 365 -subj "/C=US/ST=Fear/L=Loathing/CN=$ONION" -newkey rsa:2048 -keyout "/etc/prosody/certs/$ONION.key" -out "/etc/prosody/certs/$ONION.crt"

# Add our onion as VirtualHost to our prosody config, set it to only talk to other onions.
cat > /etc/prosody/prosody.cfg.lua << EOF
modules_enabled = {
		"roster";
		"saslauth";
		"tls";
		"dialback";
		"disco";
		"posix";
		"ping";
		"register";
};
allow_registration = true;
c2s_require_encryption = true;
s2s_secure_auth = false;
pidfile = "/var/run/prosody/prosody.pid";
authentication = "internal_hashed";
VirtualHost "$ONION"
	modules_enabled = { "onions"; };
	onions_only = true;
	ssl = {
		key = "/etc/prosody/certs/$ONION.key";
		certificate = "/etc/prosody/certs/$ONION.crt";
	}
EOF

# Restart prosody
service prosody restart
