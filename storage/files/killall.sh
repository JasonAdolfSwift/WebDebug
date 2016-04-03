#!/bin/bash

if [[ "$1" == "-k" ]];then
  ps -ef | grep gdb | awk '{print $2}' | xargs kill
fi
ps -ef | grep gdb
