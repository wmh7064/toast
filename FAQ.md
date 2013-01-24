* 如何统计代码行覆盖率?

> 目前可以通过unittest_run工具在Toast自动打印覆盖率信息。如果在你的单元测试脚本中自己做了单元测试覆盖率的生成，并自己保存了结果，可以在你的输出中包含下面的信息：
```bash
# 覆盖率：
CODE COVERAGE RESULT WAS SAVED TO: http://xxxx/xxx CODE COVERAGE RESULT OF LINES IS: xxx/xxxxx

# maven 运行中间结果：
RUNNING DATA WAS SAVED TO: http://xxxx/xxx/surefire-report.html 
```
这样，Toast可以找到 http://xxxx/xxx 并作为这次单元测试覆盖率结果的link保留在运行结果中。

* 如何统计分支覆盖率?

> 将分支覆盖率信息按照如下格式打印，Toast可以解析展现出分支覆盖率结果
```bash
# 分支覆盖率
CODE COVERAGE RESULT OF BRANCHES IS: xx/xxx
```

* 如何在任务运行结果中展示被测系统的版本信息?

> 测试过程中，如果需要在运行结果中显示被测系统的版本信息，可以按照下面的格式输出，Toast会捕获并将版本信息放在运行结果中
```
BUILD INFORMATION: toast-1.1.91
```

* 如何在任务运行结果中展示被测系统的SVN REVISION信息？

> 目前可以通过unittest_run工具输出SVN Revision信息。如果没有使用unittest_run，可以按照下面的格式输出，Toast会捕获并将SVN Revision信息放在运行结果中
```
REVISION IS:38456
```
这样，Toast可以找到 38456 并作为被测系统的SVN Revision信息展示在这次运行结果中。

* 如何在任务运行结果中展示用户自定义信息?

> 可以按照如下格式打印自定义信息到输出，TOAST将会把自定义信息展现在任务运行结果页面
```
CUSTOM INFO START
http://www.taobao.com
telnet connected.
test ok.
CUSTOM INFO END
```
其中的用户自定义信息会展现在运行结果页面，链接将会被转换为a标签

