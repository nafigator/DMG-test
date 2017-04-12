#!/usr/bin/env bash

. ../functions.sh

if [ -z $1 ]; then
	error "Not found required parameters!"
	return 1
fi
if [ -z $2 ]; then
	options="https://api.findface.pro/v0/$1"
else
	options="--data-binary $1 https://api.findface.pro/v0/$2"
fi

clear && \
curl -i \
	--request GET \
	--header "Authorization: Token OWwh0_FUQlxx8StEJAS8fO3IL84EdGI2" \
	--user-agent "Curl v.7.40.0" \
	"$options"
echo