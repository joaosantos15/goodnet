sh /storage/csf/CONNECTION_fulltest.sh #uptime and downti
sh /storage/csf/SPEED_fulltest.sh #speed test
python /storage/csf/csfparser/csfparser.py
scp /storage/csf/SEND.txt diogo@192.168.1.80:/var/www/html
