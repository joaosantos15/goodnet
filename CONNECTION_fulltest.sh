#! /bin/bash
#rm -r CONNECTIONresults
mkdir CONNECTIONresults
sh findPublicIP.sh > CONNECTIONresults/pubip.log #ver IP publico
sh findGateway.sh > CONNECTIONresults/gateway.log #ver Gateway
sh testConnection.sh CONNECTIONresults/gateway.log CONNECTIONresults/pubip.log >> CONNECTIONresults/connectionTest.log
whoami > CONNECTIONresults/user.log #Piusername
