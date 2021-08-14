# 阿里云 PHP DDNS
一个可用于自动更新阿里云DNS域名记录的PHP脚本，本脚本可以在cron job中自动运行，非常简单即可进行DDNS更新.

代码须运行在PHP7.0及以上的环境中。

更新方式1(上传客户端IP):
记录客户端IP，并将其上传至阿里云。

更新方式2（上传服务器IP）:
调用ipv6-test的API获取服务器IP，并将其上传至阿里云。
其中，28行为IPv6，29行为IPv4，可自行修改。

默认为更新方式2，如需切换为更新方式1请注释第28行并取消第27行注释。


# Alicloud PHP DNS Updater

PHP DNS auto-updater for Alicloud/Aliyun/Alidns. The script uses the Alicloud API to update a domains DNS. This script can be automated in a cron job to easily keep up to date the target IP in a given domain.

Code is meant to run on PHP 7.0+

Method 1 (upload client IP):
Record the client IP and upload it to AliCloud.

Method 2 (upload server IP):
Call the ipv6-test API to get the server IP and upload it to AliCloud.
Among them,  line 28 is for IPv6, and line 29 is for IPv4.

The default is update method 2, if you want to switch to update method 1, please comment out line 28 and uncomment line 27.


