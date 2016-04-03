#!/bin/bash

exe_file=$1
output_file=$2
gdb_in_file=/Users/Jason/Desktop/EveryThing/Graduation/web_debug/storage/files/gdb_in_file

echo $1 $2 > /Users/Jason/Desktop/EveryThing/Graduation/web_debug/storage/files/testfile

cat /dev/null > ${output_file}
cat /dev/null > ${gdb_in_file}

tail -f ${gdb_in_file} | gdb ${exe_file} &> ${output_file} &
