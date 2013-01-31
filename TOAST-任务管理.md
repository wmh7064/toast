## 任务介绍
任务（TOAST Job）是核心模块，TOAST作为一个自动化测试执行系统，其执行的自动化测试被定义成“任务”的形式。所有关于自动化程序的内容都在任务中做相应的描述。在任务中，有几个概念需要交代一下。
* 测试任务(Job)，是一个任务逻辑组合单元，可以包括一个或若干个测试阶段（Stage），测试阶段之间的运行逻辑是串行的线性关系，例如，如果一个任务包含3个阶段S1、S2、S3，那么在S1运行结束之后才会去运行S2，在S2运行结束之后会去运行S3；
* 测试阶段(Stage)，测试阶段可包含一个或若干个测试命令（Command），在同一个测试阶段里的测试命令，他们之间的运行关系是并行的，例如如果一个测试阶段包括C1、C2、C3这三个命令，在这个阶段运行的时候，C1、C2、C3会同时运行，只有在全部命令运行结束之后，本阶段才运行结束。
* 测试命令(Command)，测试命令是一个可执行单元，在TOAST中它包括测试机器信息及需要运行可执行命令（shell/batch）。可执行命令可以是任何Linux/Windows上的可执行程序。TOAST以插件的形式提供了在Linux上运行的2个python脚本，unittest_run 和 ci_run，增加一下参数就可以运行单元测试和持续集成的测试任务。这个插件，是可扩展的。

## 创建任务
登录TOAST界面之后，可以切换到“任务”标签下。通过“全部任务”、“由我创建”、“由我负责”可以切换到不同的任务视图下查看已有的任务。
<br>
如下图所示，
<br>
<img src="https://raw.github.com/wiki/taobao/toast/images/toast-job-mgmt/create-new.png" width="50%"/>
<br>
点击“新建”任务可以创建新的任务。在新建任务界面，需要输入关于任务的一些常规信息，例如：任务类型、名称、负责人、所属项目等，有几个字段需要着重说明一下，
* 任务类型，包括单元测试、功能测试、持续集成（测试）。选择不同的任务类型，在后面的添加“子任务”向导中出现的默认界面会略有不同。
* 定时运行，设置定时运行时间，可以设置常用的每日运行。
* SVN触发，设置svn 链接，在指定的svn url有代码变更的时候，会触发这个任务的运行。（这个依赖后端对svn服务器做配置，参见后端安装文档 <a href="https://github.com/taobao/toast/wiki/Controller%E5%90%8E%E7%AB%AF%E5%AE%89%E8%A3%85%E6%96%87%E6%A1%A3" target="_blank">Controll后端安装文档</a> )
<br>
如下图所示，
<br>
<img src="https://raw.github.com/wiki/taobao/toast/images/toast-job-mgmt/new-job.png" width="50%"/>

### 添加子任务
在上图上点击“添加子任务”，可以进入增加子任务的向导中，这TOAST中，我们把子任务也叫为命令（command），一个或者多个命令可以构成一个阶段（Stage）。在命令模式之下，命令视图可以和单元测试视图、持续集成视图之间做切换。
* 命令模式：命令视图
命令视图是在任务类型中选择“功能测试”之后的默认视图。
<br>
<img src="https://raw.github.com/wiki/taobao/toast/images/toast-job-mgmt/add-command-basic-view.png" width="50%"/>
* 命令模式：单元测试视图
单元测试视图是在任务类型中选择“单元测试”之后的默认视图。注意，单元测试视图需要在Agent端安装的“单元测试”插件(<a href="https://github.com/taobao/toast/wiki/unittest_run%E4%BD%BF%E7%94%A8%E6%89%8B%E5%86%8C" target="_blank">参见插件unittest_run使用手册</a>)才能使用。可以把单元测试视图切换到命令视图，从而可以查看真正在测试机器上运行的测试命令（实际上使用了单元测试插件中的unittest_run脚本）。
<br>
<img src="https://raw.github.com/wiki/taobao/toast/images/toast-job-mgmt/add-command-unittest-view.png" width="50%"/>
* 命令模式：持续集成视图
持续集成视图是在任务类型中选择“持续集成”之后的默认视图。注意，持续集成视图需要在Agent端安装的“持续集成”插件(<a href="https://github.com/taobao/toast/wiki/%E6%8C%81%E7%BB%AD%E9%9B%86%E6%88%90%E6%B5%8B%E8%AF%95ci_run%E7%9A%84%E4%BD%BF%E7%94%A8" target="_blank">参见插件ci_run使用手册</a>)才能运行。
<br>
<img src="https://raw.github.com/wiki/taobao/toast/images/toast-job-mgmt/add-command-ci-view.png" width="50%"/>
* 用例模式
用例模式，是指在定义一个任务需要指定这个任务由哪些用例组成，这里的前提条件是必须使用TOAST用例管理的功能，即把你的测试用例注册到用例系统中，才可以创建任务的时候选择已有的用例。<a href="https://github.com/taobao/toast/wiki/TOAST-%E7%94%A8%E4%BE%8B%E7%AE%A1%E7%90%86" target="_blank">参见用例管理使用手册</a>
<br>
<img src="https://raw.github.com/wiki/taobao/toast/images/toast-job-mgmt/add-command-testcase-view.png="50%"/>
## 运行任务
* 手动运行
* SVN触发运行
* 定时任务触发
* API 触发

## 查看运行结果