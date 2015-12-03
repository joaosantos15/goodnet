#!/bin/bash

DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
cd ${DIR}
python sleeper.py
scp operations/results/connection_log.py pi1@192.168.2.104:/home/proxy/raw_data/pi1
scp operations/results/speed_log.py pi1@192.168.2.104:/home/proxy/raw_data/pi1