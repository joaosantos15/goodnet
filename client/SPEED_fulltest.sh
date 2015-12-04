#! /bin/bash
rm -r SPEEDresults
mkdir SPEEDresults
sh testSpeed.sh
cd /home/pi/Documents/goodnet/client/operations
python /home/pi/Documents/goodnet/client/operations/speed_logger.py
