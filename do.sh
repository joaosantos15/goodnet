#! /bin/bash
rm -r results
mkdir results
sh findPublicIP.sh
sh findGateway.sh
sh testConnection.sh results/gateway.log results/pubip.log > results/connectionTest.log
sh testSpeed.sh
rm -r /var/www/files
mkdir /var/www/files
cp results/download.log /var/www/files
cp results/upload.log /var/www/files
cp results/gateway.log /var/www/files
cp results/pubip.log /var/www/files
cp results/connectionTest.log /var/www/files
