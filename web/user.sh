# Generate a random password
random_password="$(openssl rand -base64 32)"
email="email1@turbopanel.com"

# Create the new turboweb user
/usr/sbin/useradd "turboweb" -c "$email" --no-create-home

# do not allow login into turboweb user
echo turboweb:$random_password | sudo chpasswd -e

mkdir -p /etc/sudoers.d
cp -f /usr/local/turbo/web/sudo/turboweb /etc/sudoers.d/
chmod 440 /etc/sudoers.d/turboweb
