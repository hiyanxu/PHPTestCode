#!/bin/bash
# 执行对已执行出来的统计数据做删除
cd /apps/home/rd/jinyou/src/core/app
echo $1
echo $2
if [ $1 == "paper" ]
	then
		/apps/srv/php-fpm/bin/php cli.php async_jinyou_statistics_data run $1 $2 > /tmp/behavior_paper_delete.txt
		echo 'complete paper'
	else
		/apps/srv/php-fpm/bin/php cli.php async_jinyou_statistics_data run video $2 > /tmp/behavior_video_delete.txt
		echo 'complete video'
fi
