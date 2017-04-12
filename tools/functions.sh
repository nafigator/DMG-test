#!/usr/bin/env bash

# Function for error messages
error() {
	printf "[$(date +'%Y-%m-%d %H:%M:%S')]: \033[0;31mERROR:\033[0m $@\n" >&2
}

# Function for informational messages
inform() {
	printf "[$(date +'%Y-%m-%d %H:%M:%S')]: \033[0;32mINFO:\033[0m $@\n"
}

# Function for warning messages
warning() {
	printf "[$(date +'%Y-%m-%d %H:%M:%S')]: \033[0;33mWARNING:\033[0m $@\n" >&2
}

# Function for debug messages
debug() {
	[ ! -z ${DEBUG} ] && printf "[$(date +'%Y-%m-%d %H:%M:%S')]: \033[0;32mDEBUG:\033[0m $@\n"
}
