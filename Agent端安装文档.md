1. Agent仅需要编译出来的Toast可执行文件和配置文件AgentDaemon.conf,即可运行
2. 同时我们也提供了几个脚本:
   * toastdaemon将Agent添加到linux主机的服务中,这样在开机时就toast agent自动启动！
   * toastdaemon.py 相当于一个toast agent 的看门狗，会不停检查toast进程是否存在，不存在则重启
   * toastupdate.py 升级toast agent时运行的脚本，当要升级toast agent时，通过让toast agent 执行这个脚本来升级自己
   同时还有toastdaemon.py 看门狗的配置文件toastd.conf

这些脚本都基于RHEL，可能不适合你的平台，需要根据你的需要做相应修改！

建议您把toast agent需要的文件打包(AgentDaemon.conf 中server和port要配置好），这样方便在每台机器部署

