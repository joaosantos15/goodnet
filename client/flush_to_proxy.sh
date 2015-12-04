#!/bin/bash

DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
cd ${DIR}
python /home/pi/Documents/goodnet/client/sleeper.py
scp /home/pi/Documents/goodnet/client/operations/results/connection_log.json pi1@192.168.2.104:/home/proxy/raw_data/pi1
scp /home/pi/Documents/goodnet/client/operations/results/speed_log.json pi1@192.168.2.104:/home/proxy/raw_data/pi1
