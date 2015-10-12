#! bin/bash
route -n | grep 'UG[ \t]' | awk '{print $2}' > results/gateway.log
