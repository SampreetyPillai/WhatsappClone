#!/bin/bash

echo "gnome-terminal needs to be install in order too run this project";

sudo apt-get install gnome-terminal;

sudo gnome-terminal -- bash -c "./VideoChat/runVideo.sh; exec bash" & 
sudo gnome-terminal -- bash -c "./runChat.sh; exec bash"

