#!/usr/bin/env bash

. ../functions.sh

if [ -z $1 ] || [ -z $2 ]; then
	error "Not found required parameters!"
	return 1
fi

clear && \
curl -i \
	--request POST \
	--header "Authorization: Token OWwh0_FUQlxx8StEJAS8fO3IL84EdGI2" \
	--user-agent "Curl v.7.40.0" \
	-F "photo=@$1;filename=$2" \
	https://api.findface.pro/v0$3
echo
