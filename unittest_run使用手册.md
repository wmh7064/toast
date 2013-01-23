## 一、	Unittest_run功能   
### 1、功能：   
###### unittest_run是python实现的根据相关命令执行单元测试，并根据需求收集相应代码覆盖率的工具。其执行单元测试以及收集覆盖率的过程为：   
###### （1）	svn co项目代码；   
###### （2）	执行用户指定的命令（一般是编译项目、执行用例等命令，由-u选项指定）   
###### （3）	收集代码覆盖率信息（在有选项-y的情况下才会进行收集）   
###### （4）	覆盖率数据保存，包括保存至本地和服务器   
###### （5）	数据清理   
###### 目前unittest_run能够对以下几种类型的语言进行覆盖率的收集：  
###### C/C++,通过maven执行的java项目，PHP，Python，Perl，Shell，Lua
###2、代码结构：    
    
图1.Unittest_run代码结构   
######（1）	common目录包括command.py和svn.py两个公共脚本供其他脚本调用。    
######•	command.py主要功能：通过DoCmd和DoCmd1执行命令以及通过WriteFile和ReadFile记录和读取任务执行log；   
######•	svn.py用于执行svn相关命令：svn co/update/log等   
######（2）	test目录是处理各种语言单元测试的脚本：    
######Test.py是基类，包含环境准备、svn co、安装依赖包、执行用例、清理数据等功能。ctest.py,jtest.py,phptest.py等均继承至Test。   
######（3）unittest_run为各种类型任务的执行入口。  
      
##二、unittest_run使用   
###1、配置文件unittest_run.conf    
######unittest_run在执行任务时需要从配置文件中读取相关数据，其中配置文件默认内容如下，用户需要对各选项的值修改为有效值。   
[UnitTest]   
SvnAccount = 【svn账号】   
SvnPwd = 【svn密码】   
BasePath =/tmp/unittest/ 【单元测试运行临时目录】   
Htdocs = /home/a/share/htdocs/ 【htdoc目录，若本地需要保存覆盖率，则将数据拷贝至此】   
ServerIp = xxx.xxx.xxx.xxx 【公用服务器ip，用于保存覆盖率数据】   
ServerHtdocs =/home/admin/htdocs/ 【Server上的Htdocs目录】    
ServerAccount =admin 【server公用账号】    
ServerPassword =admin 【Server密码】    
JavaHome  =/usr/lib/jvm/java-1.6.0-openjdk    
Lcov = /home/a/bin/lcov    
Genhtml = /home/a/bin/genhtml    
MvnMerge = /home/a/bin/toast/script/cobertura-1.9.4.1/cobertura-merge.sh    
MvnReport = /home/a/bin/toast/script/cobertura-1.9.4.1/cobertura-report.sh    
MvnPath   = /home/a/bin/toast/script/apache-maven-2.2.1/bin:    
    


###2、怎样使用unittest_run    
######（1）基本命令：    
/directory/unittest_run –s “svnurl” –u “command” –y [–M/-s/--python/--php/--shell/--perl/--lua]    
表示从svn上checkout代码到本地再执行command，执行完command后收集覆盖率数据，若没有-y选项则不进行覆盖率的收集。其中[]中的选项代表单元测试的类型，会影响覆盖率数据的收集，-M为maven执行的java项目，-s为scons编译执行的c/c++项目。若没有执行单元测试类型，则默认为make编译执行的c/c++项目。    
其中-s选项可替换为-l选项，表示执行本地的项目，对应的选项值设为本地项目的directory。     

######（2）其他选项说明
Msic:     
  -h, --help                          Print this for help,then exit    
Operation:     
  -s, --svn                           to supply svn path for checkout. Couldn't use with -l at the same time    
  -l, --localdir                      Specify the project's local directory which must be a absolute path.Couldn't use with -s    
  -u, --unitestcommands               run the unitest by these commands    
Options:     
  -c, --configfile                    Specify configfile for this script    
  -d, --debug                         Print details for every step    
  -D, --dependency                    Specify packages that the program dependence on     
  -m, --makefilepath                  for c or c++ specify relative path for make; for java specify the ratetivve path for run mvn     
  -M, --mvn                           for java project. Needn't -k     
  -y, --yes                           Generate coverage data for the project     
  -e, --extract                       do not show the coverage data of the standard library files     
  -w, --workplace                     save workplace and we can update code next time     
  -i, --ignore                        ignore build error check, only effective on c/c++     
  -r, --require                       Specify the spec file that we can install the dependecies for the project     
  -n, --scons                         Compile the project by scons    
  -I, --ignore_dirs                   Need not capture the coverage information for the ignore_dirs      
  -a, --onecommand                    Look at commands in -u option as just one command,will not popen multi-processes.     
  --python  				         support python project     
  --php  				         support php project     
  --perl                                         support perl project      
  --lua                                          support lua project     

###3、	各语言项目的覆盖率收集     
#####（1）c/c++项目    
unittest_run对c/c++的覆盖率收集是基于gcov/lcov的。      
*  为了能够收集到覆盖率信息，根据gcov的原理需要在编译阶段加入2个编译选项: -fprofile-arcs和-ftest-coverage或者--coverage（makefile里面可以加在CFLAGS和LINKERCXX上）；    
*  建议去掉-O2以上级别的代码优化选项；    
*  如果连接的时候出现undefined reference to ‘__gcov_init’错误，则还要加上-lgocv(makefile里面可以加在LDFLAGS上)
 详见http://sdet.org/?p=212     
       事例：    
unittest_run –s “http://xxxx/trunk/”-u “makecommand;runcase command” -y 

###（2）maven构建的java项目：
*  unittest_run是基于cobertura-maven-plugin插件来获取maven项目的覆盖率的。
*  在pom.xml中进行相应的配置，然后通过maven clean cobertura:cobertura命令执行用例并产生覆盖率数据：
\<project\>  
    <reporting>  
        <plugins>  
            <plugin>  
                <groupId>org.codehaus.mojo</groupId>  
                <artifactId>cobertura-maven-plugin</artifactId>  
                <version>2.5.1</version>  
            </plugin>  
        </plugins>  
    </reporting>  
</project>

* 执行命令：maven clean cobertura:cobertura unittest_run在执行完命令后会调用cobertua-merge.bat插件合并maven cobertura:cobertura产生的.ser覆盖率数据文件并生成html形式的覆盖率报告。       
* 示例（-M指定该任务是maven项目）     
unittest_run -s “http://xxxx/trunk/”-u “maven clean cobertura:cobertura” -y -M    

###（3）python项目：    
* 单元测试框架，建议使用PyUnit，也是Python2.4以上版本默认内置的单元测试框架；     
* 关于代码覆盖率，最流行的是 coverage.py，unittest_run目前仅仅支持这一种代码覆盖率的收集与展示；coverage安装：     http://nedbatchelder.com/code/coverage/install.html#install     
*示例：     
unittest_run -s “http://xxxx/trunk/” -u “coverage run testcase.py” -y --python    

###（4）php项目：    
* 安装phpunit：这也是unittest_run唯一支持的php单元测试运行方式；     
* 运行时刻，使用--coverage-html 保存测试覆盖率数据；    
* 示例：    
unittest_run -s “http://xxxx/trunk/” -u “phpunit --coverage-html ./report TestScript” -y --php    

###（5）perl项目：       
建议使用Test::Class 做单元测试。       
* 安装Test::Class和Devel::Cover这个非标准模块，可以使用下面命令安装：     
sudo perl -MCPAN -e'install Test::Class';     
sudo  perl -MCPAN -e 'install Devel::Cover';     
若Devel::Cover如果安装不成功，则下载源码：     
 http://search.cpan.org/~pjcj/Devel-Cover-0.92/lib/Devel/Cover.pm#___top    
源码安装：    
perl MakeFile.PL     
make install      
关于Can't locate CGI.pm in @INC的解决办法：    
#perl -e shell -MCPAN     
>install CGI    

* 运行：    
使用cover –delete;perl -MDevel::Cover yourprog args.pl; cover html; 运行并产品html格式覆盖率结果；    
* 示例：    
unittest_run –s “http://xxxx/trunk/” –u “perl -MDevel::Cover yourprogram args; cover -report html” –y ––perl;     

###（6）shell项目；    
* 支持shUnit2 + shcov的单元测试和覆盖率收集。shcov相关：http://code.google.com/p/shcov/    
    http://code.google.com/p/shcov/wiki/Usage    
##三、	如何扩展其他类型语言的单元测试及覆盖率收集
###1、任务执行过程：    
 1）环境准备：before_run     
 2）执行命令: runing    
 3）覆盖率收集    
 4）数据清理：clean_data    
###2、新语言单元测试的支持：    
其中步骤1）2）4）都可直接继承至Test.py,只需实现步骤3）完成覆盖率的收集和保存即可。    