#!/bin/bash
# 执行金囿行为数据脚本
cd /apps/home/rd/jinyou/src/core/app
echo $1
echo $2
echo $3
if [ $1 == "paper" ]
	then
		#/apps/srv/php-fpm/bin/php cli.php user_behavier_paper_statistics run $2 $3 > behavior_paper.txt
		echo 'complete paper'
	else
		#/apps/srv/php-fpm/bin/php cli.php user_behavior_video_statistics run $2 $3 > behavior_video.txt
		echo 'complete video'
fi
