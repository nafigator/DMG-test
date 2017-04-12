#!/usr/bin/env bash

. functions.sh

if [ -z $1 ] || [ -z $2 ]; then
	error "Not found required parameters!"
	return 1
fi

clear && \
curl -i \
	--cookie "XDEBUG_SESSION=1" \
	--user-agent "Curl v.7.40.0" \
	-F "file=@$1;filename=$2" \
	http://dmg-test.lo$3
echo
