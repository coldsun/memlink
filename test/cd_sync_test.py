#!/usr/bin/python
# coding: utf-8
import os, sys
home = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
sys.path.append(os.path.join(home, "client/python"))
import time
import subprocess
from memlinkclient import *
from synctest import *

def test():
    client2master = MemLinkClient('127.0.0.1', MASTER_READ_PORT, MASTER_WRITE_PORT, 30);
    client2slave  = MemLinkClient('127.0.0.1', SLAVE_READ_PORT, SLAVE_WRITE_PORT, 30);
    
    test_init()

    print 
    print '============================= test c  =============================='
    #start a new master
    x1 = start_a_new_master()
  
    #start a new slave
    x2 = start_a_new_slave()

    time.sleep(1)

    key = 'haha'
    maskstr = "8:1:1"
    ret = client2master.create_list(key , 12, "4:3:1")
    if ret != MEMLINK_OK:
        print 'create error:', ret, key
        return -1
    print 'create 1 key'

    #1 insert 999
    num = 999
    for i in xrange(0, num):
        val = '%012d' % i
        ret = client2master.insert(key, val, maskstr, i)
        if ret != MEMLINK_OK:
            print 'insert error!', key, val, maskstr, ret
            return -2;
    print 'insert %d val' % num

    time.sleep(1)

    #2 kill slave
    print 'kill slave'
    x2.kill()

    #3 insert 1000
    num2 = 1999
    for i in xrange(num, num2):
        val = '%012d' % i
        ret = client2master.insert(key, val, maskstr, i)
        if ret != MEMLINK_OK:
            print 'insert error!', key, val, maskstr, ret
            return -2;
    print 'insert %d val' % (num2 - num)

    time.sleep(1)
    x2 = restart_slave()
    time.sleep(2)
    
    if 0 != stat_check(client2master, client2slave):
        print 'test c error!'
        return -1

    print 'test c ok'

    x1.kill()
    x2.kill()

    client2master.close()
    client2slave.close()
    
    print 
    print '============================= test d  =============================='
    #start a new master
    x1 = start_a_new_master()   
    time.sleep(1)
    
    key = 'haha'
    maskstr = "8:1:1"
    ret = client2master.create_list(key, 12, "4:3:1")
    if ret != MEMLINK_OK:
        print 'create error:', ret, key
        return -1
    print 'create 1 key'

    #1 insert 999
    num = 999
    for i in xrange(0, num):
        val = '%012d' % i
        ret = client2master.insert(key, val, maskstr, i)
        if ret != MEMLINK_OK:
            print 'insert error!', key, val, maskstr, ret
            return -2;
    print 'insert %d val' % num

    print 'dump...'
    client2master.dump()
    
    #start a new slave
    x2 = start_a_new_slave()
    time.sleep(3)
    
    if 0 != stat_check(client2master, client2slave):
        print 'test d error!'
        return -1

    print 'test d ok'
    
    client2master.destroy()
    client2slave.destroy()

    return 0

if __name__ == '__main__':
    sys.exit(test())

