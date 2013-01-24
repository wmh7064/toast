来源于http://testing.etao.com/handbook/toast

**TOAST(Toast Open Automation System for Test)**
***

***
 是由阿里巴巴集团广告技术测试团队开发的自动化测试程序运行工具。

基本原理，TOAST Controller 可以调度远程测试机器(TOAST Agent)上的测试程序，由于测试程序一般是基于某种代码级别的测试框架（例如gtest/junit/selenium等），这些测试框架会格式化输出测试程序的运行结果，TOAST会得到测试机器上的运行结果，然后做输出日志解析并判断运行结果，最后以邮件或者报表方式展示测试结果。