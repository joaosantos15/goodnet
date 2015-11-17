#! /bin/bash
rm -r results
mkdir results
sh findPublicIP.sh
sh findGateway.sh
sh testConnection.sh results/gateway.log results/pubip.log >> results/connectionTest.log
whoami > results/user.log
