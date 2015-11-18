#! /bin/bash
rm -r CONNECTIONresults
mkdir CONNECTIONresults
sh findPublicIP.sh
sh findGateway.sh
sh testConnection.sh results/gateway.log results/pubip.log >> CONNECTIONresults/connectionTest.log
whoami > CONNECTIONresults/user.log
