bin      = "memlink"
defs     = []
includes = ['/Developer/usr/include', '.']
libpath  = ['/Developer/usr/lib']
libs     = ['event']
cflags   = "-ggdb -pthread -std=gnu99 -Wall -Werror"

env = Environment(CFLAGS=cflags, CPPDEFINES=defs, CPPPATH=includes, LIBPATH=libpath, LIBS=libs)
files = Glob("*.c")
env.Program(bin, files)
#env.StaticLibrary(bin, files)

