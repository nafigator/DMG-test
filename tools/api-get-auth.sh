#!/usr/bin/env bash

. functions.sh

if [ -z $1 ]; then
	error "Not found required parameters!"
	return 1
fi
if [ -z $2 ]; then
	options="http://dmg-test.lo$1"
else
	options="--data-binary $1 http://dmg-test.lo$2"
fi

clear && \
curl -i \
	--request GET \
	--header "Authorization: Basic NjczMzcwOjdmYzBhNGY0MjNkMzNmMjEwMmE4NWY2N2UzNjZkNWJl" \
	--cookie "XDEBUG_SESSION=1" \
	--user-agent "Curl v.7.40.0" \
	"$options"
echo
