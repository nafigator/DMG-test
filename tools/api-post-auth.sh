#!/usr/bin/env bash

. functions.sh

if [ -z $1 ] || [ -z $2 ]; then
	error "Not found required parameters!"
	return 1
fi

clear && \
curl -i \
	--cookie "XDEBUG_SESSION=1" \
	--header "Authorization: Basic NjczMzcwOjdmYzBhNGY0MjNkMzNmMjEwMmE4NWY2N2UzNjZkNWJl" \
	--user-agent "Curl v.7.40.0" \
	--data "$1" \
	http://dmg-test.lo$2
echo
