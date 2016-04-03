#!/bin/bash

root_path="/Users/Jason/Desktop/EveryThing/Graduation/web_debug"
if [[ $# == 2 ]];then
  command=$1
  param=$2
fi

if [[ $# == 3 ]];then
  command=$1
  param="&$2"
fi

if [[ $# == 1 ]];then
  command=$1
  param=" "
fi

command=${command}" "${param}

cat /dev/null > ${root_path}/public/output

echo ${command} >> ${root_path}/storage/files/gdb_in_file
