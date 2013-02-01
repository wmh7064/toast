
LDPATH=\
       -L. \

INCLUDE=\
	-I. \
	-I/usr/include\

CC = gcc
GCC = g++

ifeq ($(coverage), yes)
CFLAG = -g -Wall --coverage $(INCLUDE)
CLINKER  = --coverage
else
CFLAG = -g -Wall $(INCLUDE)
endif    

all: Rectangle.o RectangleTest

Rectangle.o:
	$(GCC) $(LDPATH) -c -o $@ Rectangle.cpp ${CFLAG}

RectangleTest:
	$(GCC) $(LDPATH) -o $@ RectangleTest.cpp ${CFLAG} ${CLINKER} Rectangle.o

clean:
	rm -f *.o
	rm -f *.a
	rm -f *.gcda
	rm -f *.gcno
	rm -f RectangleTest
