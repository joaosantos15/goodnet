#! /bin/bash
rm -r SPEEDresults
mkdir SPEEDresults
sh testSpeed.sh
cd /home/pi/Documents/csf-master/operations/
python /home/pi/Documents/csf-master/operations/speed_logger.py
