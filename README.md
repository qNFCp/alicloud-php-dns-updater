# 阿里云 PHP DDNS
一个可用于自动更新阿里云DNS域名记录的PHP脚本，本脚本可以在cron job中自动运行，非常简单即可进行DDNS更新.

代码须运行在PHP7.0及以上的环境中。

默认为 更新方式3（优先，上传HTTP Get请求中的IP参数）+ 更新方式2（上传服务器IP）。如需切换为更新方式1，请注释第32行并取消第31行注释。如需关闭更新方式3请注释34至36行

+ 更新方式1(上传客户端IP):

  记录客户端IP，并将其上传至阿里云。

+ 更新方式2（上传服务器IP）:

  调用ipv6-test的API获取服务器IP，并将其上传至阿里云。
  其中，28行为IPv6，29行为IPv4，可自行修改。

+ 更新方式3（上传HTTP Get请求中的IP参数）：

  访问的链接中有IP参数时，使用其进行更新。
  使用场景可为：
  A：拥有IPv4（非公网）+IPv6（公网）
  B（服务端）：拥有IPv4（公网）
  此时A可通过Shell脚本调用ipv6-test的API获取IPv6公网IP，并将其加入链接参数，发送至B。由B将A的IPv6地址发送给阿里云进行更新操作。
  
  供参考使用的Shell脚本见末尾。



# Alicloud PHP DNS Updater

PHP DNS auto-updater for Alicloud/Aliyun/Alidns. The script uses the Alicloud API to update a domains DNS. This script can be automated in a cron job to easily keep up to date the target IP in a given domain.

Code is meant to run on PHP 7.0+

Default is Method 3 (priority, upload IP parameter in HTTP Get request) + Method 2 (upload server IP). If you want to switch to Method 1, please comment line 32 and uncomment line 31. If you want to switch off update method 3, please comment lines 34 to 36.

+ Method 1 (upload client IP):

  Record the client IP and upload it to AliCloud.

+ Method 2 (upload server IP):

  Call the ipv6-test API to get the server IP and upload it to AliCloud.
  Among them,  line 28 is for IPv6, and line 29 is for IPv4.

+ Method 3 (uploading IP parameters from HTTP Get requests):

  Use the IP value of the links visited when they have it in them for updating.
  The usage scenarios can be:
  A: IPv4 (non-public network) + IPv6 (public network)
  B (server side): IPv4 (public network).
  At this point, A can call the API of ipv6-test.com via shell script to get the IPv6 public IP, and add it to the link parameter, then send it to B. B will send A's IPv6 address to Aliyun for update operation.


# Method 3 Sample Shell Script
+ update_ipv6.sh:

```
#!/bin/bash

# Function to get IPv6 address
get_ipv6_address() {
    ipv6=$(curl -s http://v6.ipv6-test.com/api/myip.php)
    echo "$ipv6"
}

# Main function
main() {
    ipv6=$(get_ipv6_address)
    if [ -n "$ipv6" ]; then
        curl "http://domain/index.php?ip=$ipv6"
        # curl -u qnfcp:vei4h1fiqe0jfpva "http://domain/index.php?ip=$ipv6" #If the website has password
    else
        echo "Failed to retrieve IPv6 address."
        exit 1
    fi
}

# Call main function
main
```


