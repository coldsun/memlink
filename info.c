/**
 * memlink统计信息
 * @file info.c
 * @author lanwenhong
 * ingroup memlink
 * @{
 */
#include <string.h>
#include <stdlib.h>
#include <unistd.h>
#include "logfile.h"
#include "mem.h"
#include "info.h"
#include "serial.h"
#include "utils.h"

int
info_sys_stat(MemLinkStatSys *stat)
{
	int i;
	unsigned int bcount = 0;
	unsigned int psize  = 0;
	int pid;
	char buf[256];
	MemPool *mp = g_runtime->mpool;
	HashTable *ht = g_runtime->ht;
	
	memset(stat, 0x0, sizeof(MemLinkStatSys));	
	DINFO("get hash table mem size.\n");
	hashtable_stat_sys(ht, stat);
	
	if (mp == NULL || stat == NULL) {
		return -1;
	}
	DINFO("get mem pool mem size.\n");	
	psize += sizeof(MemPool);	
	for (i = 0; i < mp->used; i++) {
		bcount += mp->freemem[i].block_count;	
		DNOTE("block_count: %d\n", mp->freemem[i].block_count);
		psize += sizeof(MemItem);
		DNOTE("memsize: %d\n", mp->freemem[i].memsize);
		psize += mp->freemem[i].block_count * mp->freemem[i].memsize;
	}
	stat->pool_mem = psize;
	stat->pool_blocks = mp->blocks;

	DNOTE("pool_mem: %d\n", stat->pool_mem);
	DNOTE("pool_mem: %d\n", stat->pool_blocks);
	
	DINFO("get pid.\n");	
	pid = getpid();
	sprintf(buf, "/proc/%d/status", pid);
	
	FILE *fp;
	fp = (FILE *)fopen64(buf, "r");
	if (fp == NULL) {
		DERROR("open file %s error! \n", buf);
		return -1;
	}
	
	DINFO("get memlink mem size.\n");	
	char line[512];
	char num[512] = {0};
	while (fgets(line, 512, fp)) {
		if (strncmp(line, "VmRSS", 5) == 0) {
			DINFO("line: %s", line);
			char *ptr = line;
			char *ptrnum = num;

			while (*ptr != '\0') {
				if (*ptr >= '0' && *ptr <= '9')
					break;
				ptr++;
			}
			while (*ptr >= '0' && *ptr <= '9')
				*ptrnum++ = *ptr++;
			break;
		}
	}
	fclose(fp);
	if (num[0] != '\0') {
		stat->all_mem = atoi(num) * 1024;
		DINFO("all mem: %d\n", stat->all_mem);
	}
	
	DINFO("get net info.\n");	
	MainServer *ms = g_runtime->server;
	WThread *wt = g_runtime->wthread;
	SThread *st = g_runtime->sthread;
	unsigned short rconns = 0;
	for (i = 0; i < MEMLINK_MAX_THREADS; i++) {
		rconns += ms->threads[i].conns;
	}
	stat->conn_read = rconns;
	stat->conn_write = wt->conns;
	if (g_cf->role == 1)
		stat->conn_sync = st->conns;
	stat->threads = g_cf->thread_num;
	stat->pid = getpid();
	stat->bit = sizeof(long) * 8;
	stat->last_dump = (unsigned int)g_runtime->last_dump;
	stat->uptime = time(NULL) - g_runtime->memlink_start;

	return 0;
}

int
pack_unpack_check(char *data, int len)
{
	int count = 0;
	char *rdata = data + CMD_REPLY_HEAD_LEN;
	int fd;

	int size = 0;
	memcpy(&size, data, sizeof(int));
	DINFO("-----------------size: %d\n", size);
	short ret;
	memcpy(&ret, data + sizeof(int), sizeof(short));
	DINFO("-----------------ret: %d\n", ret);

	count = 0;
	while (count < size - sizeof(short)) {
		memcpy(&fd, rdata + count, sizeof(int));
		DINFO("------------------fd: %d\n", fd);
		count += sizeof(int);
		unsigned char clen;
		memcpy(&clen, rdata + count, sizeof(char));
		DINFO("-----------------clen: %d\n", clen);
		count += sizeof(char);
		char ip[16] = {0};
		memcpy(ip, rdata + count , clen);
		count += clen;
		int port;
		memcpy(&port, rdata + count, sizeof(int));
		DINFO("------------------port: %d\n", port);
		count += sizeof(int);
		//long time;
		//memcpy(&time, rdata + count, sizeof(long));
		//DINFO("------------------time: %ld\n", time);
		//count += sizeof(long);
		//int cmd_count;
		//memcpy(&cmd_count, rdata + count, sizeof(int));
		//DINFO("------------------cmd_count: %d\n", cmd_count);
		break;	
	}	
	return 1;	

}
int read_conn_info(Conn *conn)
{
	int wlen;
	char *wbuf;
	int count = 0;
	MainServer *ms;
	ThreadServer *ts;
	RwConnInfo *conninfo;
	int i, j, ret;
	struct timeval end;
	int pass;

	ms = g_runtime->server;

	wlen = CMD_REPLY_HEAD_LEN + sizeof(RwConnInfo) * g_cf->max_conn;
	wbuf = conn_write_buffer(conn, wlen);
	char *data = wbuf + CMD_REPLY_HEAD_LEN;
	for (i = 0; i < g_cf->thread_num; i++) {
		ts = &ms->threads[i];
		for (j = 0; j < g_cf->max_conn; j++) {
			conninfo = &ts->rw_conn_info[j];
			if (conninfo->fd > 0) {
				memcpy(data + count, &(conninfo->fd), sizeof(int));
				count += sizeof(int);
				unsigned char len = strlen(conninfo->client_ip);
				memcpy(data + count, &len, sizeof(char));
				count += sizeof(char);
				memcpy(data + count, conninfo->client_ip, strlen(conninfo->client_ip));
				count += strlen(conninfo->client_ip);
				memcpy(data + count, &conninfo->port, sizeof(int));
				count += sizeof(int);
				gettimeofday(&end, NULL);
				//pass = timediff(&conninfo->start, &end);	

				pass = end.tv_sec - (conninfo->start).tv_sec;
				memcpy(data + count, &pass, sizeof(int));
				count += sizeof(int);
				memcpy(data + count, &conninfo->cmd_count, sizeof(int));
				count += sizeof(int);
			}
		}
	}
	count += CMD_REPLY_HEAD_LEN;
	DINFO("count: %d\n", count);
	ret = MEMLINK_OK;
	conn_write_buffer_head(conn, ret, count);
	return 1;
}

int write_conn_info(Conn *conn)
{
	int wlen;
	char *wbuf;
	int count = 0;
	WThread *wt;
	RwConnInfo *conninfo;
	int i, ret;
	struct timeval end;
	int pass;

	wt = g_runtime->wthread;
	wlen = CMD_REPLY_HEAD_LEN + sizeof(RwConnInfo) * g_cf->max_conn;
    wbuf = conn_write_buffer(conn, wlen);

	char *data = wbuf + CMD_REPLY_HEAD_LEN;

	for (i = 0; i < g_cf->max_conn; i++) {
		conninfo = &wt->rw_conn_info[i];	
		if (conninfo->fd > 0) {
			memcpy(data + count, &conninfo->fd, sizeof(int));
			count += sizeof(int);
			unsigned char len = strlen(conninfo->client_ip);
			memcpy(data + count, &len, sizeof(char));
			count += sizeof(char);
			memcpy(data + count, conninfo->client_ip, strlen(conninfo->client_ip));
			count += strlen(conninfo->client_ip);
			memcpy(data + count, &conninfo->port, sizeof(int));
			count += sizeof(int);

			gettimeofday(&end, NULL);
			//pass = timediff(&conninfo->start, &end);	

			pass = end.tv_sec - (conninfo->start).tv_sec;
			memcpy(data + count, &pass, sizeof(int));
			count += sizeof(int);
			memcpy(data + count, &conninfo->cmd_count, sizeof(int));
			count += sizeof(int);
		}
	}
	count += CMD_REPLY_HEAD_LEN;
	DINFO("count: %d\n", count);
	ret = MEMLINK_OK;
	conn_write_buffer_head(conn, ret, count);
	pack_unpack_check(wbuf, count);

	return 1;
}

int sync_conn_info(Conn *conn)
{
	int wlen;
	char *wbuf;
	int count = 0;
	SThread *st;
	SyncConnInfo *conninfo;
	int i, ret;
	struct timeval end;
	int pass;

	st = g_runtime->sthread;
	wlen = CMD_REPLY_HEAD_LEN + sizeof(SyncConnInfo) * g_cf->max_conn;
	wbuf = conn_write_buffer(conn, wlen);

	char *data = wbuf + CMD_REPLY_HEAD_LEN;
	for (i = 0; i < g_cf->max_conn; i++) {
		conninfo = &st->sync_conn_info[i];
		if (conninfo->fd > 0) {
			memcpy(data + count, &conninfo->fd, sizeof(int));
			count += sizeof(int);
			unsigned char len = strlen(conninfo->client_ip);
			memcpy(data + count, &len, sizeof(char));
			count += sizeof(char);
			memcpy(data + count, conninfo->client_ip, strlen(conninfo->client_ip));
			count += len;
			memcpy(data + count, &conninfo->port, sizeof(int));
			count += sizeof(int);

			gettimeofday(&end, NULL);
			//pass = timediff(&conninfo->start, &end);
			pass = end.tv_sec - (conninfo->start).tv_sec;
			memcpy(data + count, &pass, sizeof(int));
			count += sizeof(int);
			memcpy(data + count, &conninfo->cmd_count, sizeof(int));
			count += sizeof(int);
			
			memcpy(data + count, &conninfo->logver, sizeof(int));
			count += sizeof(int);
			
			memcpy(data + count, &conninfo->logline, sizeof(int));
			count += sizeof(int);

			memcpy(data + count, &conninfo->delay, sizeof(int));
			count += sizeof(int);
		}
	}
	count += CMD_REPLY_HEAD_LEN;
	DINFO("count: %d\n", count);
	ret = MEMLINK_OK;
	conn_write_buffer_head(conn, ret, count);

	return 1;
}

/**
 * @}
 */
