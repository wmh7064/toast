## 1. 编译代码

   参考 https://github.com/taobao/toast/blob/master/backend/README.markdown

## 2. 安装
   * Agent仅需要编译出来的toast可执行文件和配置文件AgentDaemon.conf, 可将编译出来的可执行文件和配置文件拷贝到你的运行目录，执行，建议将配置文件和可执行文件打包，然后安装，打包前注意配置文件修改，运行请用sudo权限

   * windows版agent， 我们提供了windows agent的工程文件，用vcexpress编译出可执行文件，然后在机器上执行，你也可以将配置文件和windows agent打成安装包

## 3. 检查运行情况
   agent执行起来通过AgentDaemon.log 检查运行情况

我们也提供了几个脚本:
   * toastdaemon将Agent添加到linux主机的服务中,这样在开机时就toast agent自动启动！
   * toastdaemon.py 相当于一个toast agent 的看门狗，会不停检查toast进程是否存在，不存在则重启
   * toastupdate.py 升级toast agent时运行的脚本，当要升级toast agent时，通过让toast agent 执行这个脚本来升级自己
   同时还有toastdaemon.py 看门狗的配置文件toastd.conf
   这些脚本都基于RHEL，可能不适合你的平台，需要根据你的需要做相应修改！

建议您把toast agent需要的文件打包(AgentDaemon.conf 中server和port要配置好），方便部署
