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

* 如何按照TOAST任务自定义测试用例格式输出?

> 如果你没有使用测试框架或者使用的框架不在TOAST目前支持的范围之内，你可以按照下面的JSON样式定义你的程序输出，并选择“Toast”测试工具，这样TOAST同样可以解析你的测试用例的执行情况：<br/>
含Test Suite时：
```
##TESTCASE START##
{
    "testsuite": [
        {
            "name": "SUITE1",
            "testcase": [
                {
                    "id": "101",
                    "name": "PASSED CASE",
                    "result": "PASS",
                    "info": "empty"
                },
                {
                    "id": "102",
                    "name": "FAILED CASE",
                    "result": "FAIL",
                    "info": "failed result"
                },
                {
                    "id": "103",
                    "name": "SKIPPED CASE",
                    "result": "SKIP",
                    "info": "skipped result"
                },
                {
                    "id": "104",
                    "name": "BLOCKED CASE",
                    "result": "BLOCK",
                    "info": "empty"
                }
            ]
        },
        {
            "name": "SUITE2",
            "testsuite": [
                {
                    "name": "SUITE INSIDE",
                    "testcase": [
 
                    ]
                }
            ]
        }
    ],
    "testcase": [
        {
            "id": "105",
            "name": "PASSED CASE",
            "result": "PASS",
            "info": "empty"
        }
    ]
}
##TESTCASE END##
```
不含Test Suite时：
```
##TESTCASE START##
{
    "testcase": [
        {
            "id": "103",
            "name": "CASE3",
            "result": "FAIL",
            "info": "failed result"
        },
        {
            "id": "104",
            "name": "CASE4",
            "result": "PASS",
            "info": "empty"
        }
    ]
}
##TESTCASE END##
```
注意：开头和结尾的##TESTCASE START##和##TESTCASE END##是必须的,内容中包含中文时请使用UTF-8编码！

* Toast任务为什么不能结束？

>toast agent 通过获取用户任务的命令的STDOUT,STDERR来获取命令输出信息，同时会根据STDOUT，STDERR的结束来判断任务，如果您的脚本中有启动后台程序(daemon)的，并且这些后台程序(daemon)没有对STDOUT, STDERR进行处理， 由于子进程默认继承父进程的打开文件句柄，就会导致这个任务的STDOUT,STDERR一直处于打开状态，进而导致toast任务结束不了！ 后台程序(daemon)一般都会关闭STDOUT，STDERR。
如何判断这种情况：
假如你的任务出现这个现象，请找出您启动的后台程序，并把这些后台程序给关掉，这时toast任务就应该结束。
如何处理这种情况：
如果无法修改后台程序，那么就在你的脚本里启动后台程序的地方添加
```
 >/dev/null 2>&1 &
```
解决这个问题，如果可以修改后台程序，那么就对程序进行修改，使其正确daemonize。