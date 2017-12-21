#!/bin/bash
DIR=....
count=60
while [ $count -gt 0 ]
do
	main_counts=`ps aux | grep -v grep | grep -c 'php deploy.php'`
	if [ $main_counts -lt 1 ]
		then
		echo "not found"
		`cd $DIR;f nohup php deploy.php > /dev/null &`
	fi
	echo $count
	sleep 1
	count=$(($count-1))
done
