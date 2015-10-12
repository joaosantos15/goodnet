#! /bin/bash
speedtest-cli > results.tmp
cat results.tmp | grep "Download" >  results/download.log
cat results.tmp | grep "Upload"  > results/upload.log
