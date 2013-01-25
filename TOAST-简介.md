

# 基本概念
**TOAST(Toast Open Automation System for Test)** 是由阿里巴巴集团广告技术测试团队开发的自动化测试程序运行工具。

基本原理，TOAST Controller 可以调度远程测试机器(TOAST Agent)上的测试程序，由于测试程序一般是基于某种代码级别的测试框架（例如gtest/junit/selenium等），这些测试框架会格式化输出测试程序的运行结果，TOAST会得到测试机器上的运行结果，然后做输出日志解析并判断运行结果，最后以邮件或者报表方式展示测试结果。

# TOAST 设计目标

* 测试程序调度工具，提供自动化任务的定时运行、手动运行、按照代码check in触发模式、api触发模式等方式的运行，通过不同的触发模式可以做持续集成后的自动化测试；
* 自动化测试运行公开、简单、高效地运行结果展示，提供多维度的报表，并以邮件的方式通知结果；
* 提供测试机的简单监控和管理功能，支持多测试机并行执行任务以及任务的分阶段执行；
* TOAST目前支持常用的测试框架，Junit, Google test, Selenium，phpunit, python unit等10余种测试框架；

TOAST的这种调度模式，可以支持以下两种典型的持续集成与自动化测试运行模式。

1. 代码check in 触发的单元测试，如下图:

![check-in](http://testing.etao.com/sites/default/files/check-in_0.png)

2. Build触发自动化功能回归测试，如下图：
![](http://testing.etao.com/sites/default/files/regression_0.png)

# 测试任务管理

为了支持测试的分布式执行，TOAST 将测试分为三个概念: Task, Stage, Job

* Task
仅在单台机器上执行，但可以在不同的机器上执行，相当于一个测试任务库，在TOAST中可以复用，在UI上显示为”命令集”，任务执行过程中的输出(stdout,stderr)有测试Agent传给Controller，并保存下来。
* Stage
是一个逻辑上Task的组合，Stage分为两种，串行和并行(serial&parallel)，串行Stage中的任务按时间顺序执行，只有前一个任务结束后续任务才会执行；并行Stage中的任务会一次全部发送到Agent，同时执行, Stage 是控制分布式执行任务的关键概念。
* Job 
Job是Stage的组合，Job中的每个Stage顺序执行。
通常我们的测试任务分为3个阶段，开始(setup)，执行(run)，清理(clean up)， TOAST通过任务的划分可以清晰的定义测试执行中的各阶段。
下面是一个典型的TOAST测试Job：
![test_job](http://testing.etao.com/sites/default/files/test_job.jpg)


在应用上需要彻底理解TOAST测试任务划分，将测试任务合理分解，便于测试后分析问题！
同时，测试任务的分布式执行为分布式压力测试提供了有力支持。

# 设计概要
TOAST由Web端、Controller端和Agent端三部分构成，通过Web端定制任务，Controller端分发任务，Agent端执行任务。
![toast_design](http://testing.etao.com/sites/default/files/toast_design.jpg)

自动化任务会经过以下步骤执行：
* 1. Web端接受用户的输入定制自动化任务，并与Controller端通信告知需要执行的任务。
* 2. Controller端将任务分发给指定的Agent执行。
* 3. Agent端将执行任务过程中的stdout和stderr传递给Controller端。
* 4. 由Controller端将stdout和stderr保存在指定的位置
* 5. Web端分析stdout和stderr，将结果反馈给用户。

# 前端Web端设计
Web端基于PHP+MySQL架构，采用Yii框架实现MVC。
![toast_web](http://testing.etao.com/sites/default/files/toast_web.jpg)
>Web端提供View层给用户，同时提供API给第三方应用。

>任务执行的过程
![kkk](https://lh4.googleusercontent.com/jB0es4jxGUHRWlUafYdZa06UnWB8l3RhyVShbOSm6Fb1Apwuc-Eov61tNvfUr0S_YlDgI1EguSh80dPClFrNHpapu3muYlNcWggOkfu3ZbSO_dpgmlI)

通过用户手动出发或者第三方应用API触发运行自动化任务，Task Controller调用Task Model创建一个新的Task Run，Task Run将自动化任务命令告知TOAST Controller端。

# 后端设计
后端主要起到任务分发和收集任务执行结果的功能，后端接收前端发送的任务，发送到指定的Agent执行，并将任务执行结果发送给前端。后端在一定条件下触发指定的任务执行，目前仅实现定时触发功能，即在指定的时间触发任务执行。
![bbb](https://docs.google.com/drawings/image?id=scABq1es1EoY9NA_vIlBk_2ud&w=617&h=387&rev=126&ac=1)
## Controller端设计
前端通过文件向Controller 发送要执行的任务，通过HTTP 接口通报任务执行的状态，同时通过HTTP接口获取系统其它信息，如定时任务列表，Agent列表。
Controller同时管理所有Agent，Controller通过Socket与Agent通信，通过与每个Agent建立一个TCP链接，在该链接上发送命令，接收命令执行结果。
Agent需要定时向Controller发送Heartbeat 信息，在实现上将Heartbeat 信息与机器信息结合，Agent会定时向Controller报告机器CPU、内存、磁盘、网络利用率信息，这些信息同时作为Agent的Heartbeat。

## Agent端设计
Agent功能相对简单，它接收Controller发送的命令，执行命令，并将命令的输出信息(stdout, stderr)发送给Controller和一个远程的Shell相同。

来源于http://testing.etao.com/handbook/toast，本文档尚待更新。
2013.1.25