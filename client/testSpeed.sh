#! /bin/bash
speedtest-cli > results.tmp
cat results.tmp | grep "Download" >  SPEEDresults/download.log
cat results.tmp | grep "Upload"  > SPEEDresults/upload.log
cat results.tmp | grep "Testing from" > SPEEDresults/isp.log
cat results.tmp | grep "Hosted by" > SPEEDresults/latency.log
rm results.tmp
