#!/bin/bash
#NOTE: This script will clear out all of your LAN Sources and Job Definitions!
#Make a copy of your crawldb before proceeding...



#first clear everything out
cd /opt/ie/var/crawl
sqlite3 crawldb << EOF
DELETE FROM hosts WHERE id>0;
DELETE FROM mounts WHERE id>0;
DELETE FROM dirs WHERE id>0;
DELETE FROM jobdefs WHERE id>0;
EOF
sleep 2



i=1
j=1
k=1

#repeat creating a host and a mount for that host
while [ $i -le 6 ]
do
sqlite3 crawldb << EOF
INSERT INTO hosts (id,hostname,capmask,maxjobs) VALUES ('$i','192.168.17.$i','2','16');
EOF
sqlite3 crawldb << EOF
INSERT INTO mounts (id,hostid,netpath,canpath,type,mopts,wsize,rsize) VALUES ('$i','$i','Corpus$i','','2','0','16384','16384');
EOF



#for each mount create a number of dirs
temp1=$(( $j + 2 ))
while [ $j -le $temp1 ]
do
sqlite3 crawldb << EOF
INSERT INTO dirs (id,mountid,path,canpath,fname_encoding,dflags) VALUES ('$j','$i','Directory $j','','2','6');
EOF

temp2=$(( $k + 5 ))
#for each dir create a number of jobs
while [ $k -le $temp2 ]
do
sqlite3 crawldb << EOF
INSERT INTO jobdefs (id,dirid,name,dumplevel,filter,jdflags) VALUES ('$k','$j','My New Job $k','102','null','1');
EOF
sleep .5
(( k++ ))
done


(( j++ ))
done



((i++))
done

