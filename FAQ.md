* 如何统计代码行覆盖率?
> 目前可以通过unittest_run工具在Toast自动打印覆盖率信息。如果在你的单元测试脚本中自己做了单元测试覆盖率的生成，并自己保存了结果，可以在你的输出中包含下面的信息：
```bash
#覆盖率：
CODE COVERAGE RESULT WAS SAVED TO: http://xxxx/xxx
CODE COVERAGE RESULT OF LINES IS: xxx/xxxxx


#maven 运行中间结果：
RUNNING DATA WAS SAVED TO: http://xxxx/xxx/surefire-report.html
```
这样，Toast可以找到 http://xxxx/xxx 并作为这次单元测试覆盖率结果的link保留在运行结果中。