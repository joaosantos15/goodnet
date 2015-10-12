#! /bin/bash
rm ping.waste
gateway="$(cat "$1" )"
pubip="$(cat "$2" )"

ping -c 2 $gateway > ping.waste
if  [ $? = 0 ]; then
	echo "->Gateway OK"
else
	echo "xx BAD Gateway"
	sh logRouterError.sh
fi 

ping -c 2  $pubip > ping.wast
if  [ $? = 0 ]; then
        echo "->pubIP OK"
else
	echo "xx BAD PubInt"
	sh logPubError.sh
fi 
 
ping -c 2  www.google.pt > ping.wast
if  [ $? = 0 ]; then
        echo "->External OK"
else
	echo "xx BAD External Connection"
	sh logInternetError.sh
fi 

