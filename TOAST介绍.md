来源于http://testing.etao.com/handbook/toast

# 基本介绍
**TOAST(Toast Open Automation System for Test)** 是由阿里巴巴集团广告技术测试团队开发的自动化测试程序运行工具。

基本原理，TOAST Controller 可以调度远程测试机器(TOAST Agent)上的测试程序，由于测试程序一般是基于某种代码级别的测试框架（例如gtest/junit/selenium等），这些测试框架会格式化输出测试程序的运行结果，TOAST会得到测试机器上的运行结果，然后做输出日志解析并判断运行结果，最后以邮件或者报表方式展示测试结果。

## TOAST v1.0 的设计目标

* 测试程序调度工具，提供自动化任务的定时运行、手动运行、按照代码check in触发模式、api触发模式等方式的运行，通过不同的触发模式可以做持续集成后的自动化测试；
* 自动化测试运行公开、简单、高效地运行结果展示，提供多维度的报表，并以邮件的方式通知结果；
* 提供测试机的简单监控和管理功能，支持多测试机并行执行任务以及任务的分阶段执行；
* TOAST目前支持常用的测试框架，Junit, Google test, Selenium，phpunit, python unit等10余种测试框架；

TOAST的这种调度模式，可以支持以下两种典型的持续集成与自动化测试运行模式，
1. 代码check in 触发的单元测试，如下图:





