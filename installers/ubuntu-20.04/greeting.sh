#!/bin/bash

CURRENT_IP=$(hostname -I | awk '{print $1}')

echo " \
 _____ _   _ ____  ____   ___  ____   _    _   _ _____ _     
|_   _| | | |  _ \| __ ) / _ \|  _ \ / \  | \ | | ____| |    
  | | | | | | |_) |  _ \| | | | |_) / _ \ |  \| |  _| | |    
  | | | |_| |  _ <| |_) | |_| |  __/ ___ \| |\  | |___| |___ 
  |_|  \___/|_| \_\____/ \___/|_| /_/   \_\_| \_|_____|_____|
 WELCOME TO TURBO PANEL!
 OS: Ubuntu 20.04
 You can login at: http://$CURRENT_IP:8443
"

# File can be saved at: /etc/profile.d/greeting.sh
