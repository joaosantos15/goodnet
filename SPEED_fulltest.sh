#! /bin/bash
rm -r SPEEDresults
mkdir SPEEDresults
sh testSpeed.sh
python /home/pi/Documents/csf-master/operations/speed_logger.py
