#!/usr/bin/env python2.6
#
#   Copyright (C) 2007-2013 Alibaba Group Holding Limited
#
#   This program is free software;you can redistribute it and/or modify
#   it under the terms of the GUN General Public License version 2 as
#   published by the Free Software Foundation.
#
import unittest
import string
import os
from util import *


class UtilTest(unittest.TestCase):
	def test_Example(self):
		sayhello = 'hello world'
		assert sayhello == 'hello world'

	def test_run_single_command(self):
		run_dir = '/tmp'
		run_cmd = 'pwd'
		res, out = util.run_single_command(run_cmd, run_dir)
		self.assertTrue(string.find(out, 'tmp'))
		self.assertTrue(res == 0)

	def test_run_single_command_subprocess(self):
		run_dir = '/tmp'
		run_cmd = 'pwd'
		out, err = util.run_single_command_subprocess(run_cmd, run_dir)
		self.assertTrue(string.find(out, 'tmp'))

	def test_scp_file(self):
		hostname = 'hostname_or_ip'
		username = 'user'
		password = 'pwd'
		file = '/home/user/.bash_profile'
		util.scp_file(file, hostname, '/tmp', username, password)

		file = '/home/user/logs'
		util.scp_file(file, hostname, '/tmp', username, password)

	def test_ssh_run(self):
		hostname = 'hostname_or_ip'
		username = 'user'
		password = 'Pwd'
		command  = 'hostname'

		out, err = util.ssh_run_command(command, hostname, username, password)
		logger.debug('out is:#'+ out + '#')
		self.assertTrue(out.find("v132194") == 0)

	def test_ssh_sudo_run(self):
		hostname = 'hostname_or_ip'
		username = 'user'
		password = 'Pwd'
		command  = 'whoami'

		out, err = util.ssh_sudo_run_command(command, hostname, username, password)
		logger.debug('out is:#'+ out + '#')
		self.assertTrue(out.find('root') == 0)

	def test_ssh_run_return(self):
		hostname = 'hostname_or_ip'
		username = 'user'
		password = 'Pwd'
		command  = 'xxxx'
		out, err, return_code = util.ssh_run_command_return(command, hostname, username, password)
		self.assertTrue(len(err) > 0)
		self.assertTrue(return_code != 0)

		command  = 'cd /tmp; pwd'
		out, err, return_code = util.ssh_run_command_return(command, hostname, username, password)
		self.assertTrue(return_code == 0)
		self.assertTrue(len(err) == 0)

	def test_remote_co(self):
		tar_dir = '/tmp/pythontest/'
		svn_url = 'http://xxx/svn/trunk/rpm/'
		svn_usr = 'usr'
		svn_pwd = 'pwd'
		host = 'hostname_or_ip'
		ssh_usr = 'user'
		ssh_pwd = 'Pwd'

		util.remote_check_out_code(host, ssh_usr, ssh_pwd, tar_dir, svn_url, svn_usr, svn_pwd)


def setUp():
	file = os.path.abspath(__file__)
	util.init_logger(file)

def tearDown():
	pass

if __name__ == "__main__":
	setUp()
	unittest.main()
	tearDown()
