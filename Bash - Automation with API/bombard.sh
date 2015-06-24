#!/bin/bash

NOW=$(date +%Y%m%d%H%M%S)
DIRECTORY="bombardLogs"
LOGFILE=$DIRECTORY/"querylog-$NOW"
date > $LOGFILE
echo -e "\n" >> $LOGFILE



user="caroltest"
count=150



#Start Loop
while read line
do
        usleep 100
	thisQuery="query $line"
	thisUser="${user}${count}@INTEGRATION.COM"
	echo "$thisQuery using $thisUser" >> $LOGFILE

qshell -U $thisUser >> $LOGFILE 2>&1 << ! &
tworiver
$thisQuery
!
	
	count=$((count+1))
done < "thequerylist"



echo "all queries were submitted"



echo -e "\n" >> $LOGFILE
echo "Executed 36 Queries... Check the qserv log for even more details" >> $LOGFILE
echo -e "\n" >> $LOGFILE
