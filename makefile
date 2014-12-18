Application: GPIOClass.o Application.o
	g++ GPIOClass.o Application.o -o Application
GPIOClass.o: GPIOClass.cpp GPIOClass.h
	g++ -c GPIOClass.cpp
Application.o: Application.cpp Application.h GPIOClass.h
	g++ -c Application.cpp
Schedule.o: Schedule.cpp Schedule.h
	g++ -c Schedule.cpp
Scheduler.o: Scheduler.cpp Schedule.h
	g++ -c Scheduler.cpp
Scheduler: Schedule.o Scheduler.o
	g++ Schedule.o Scheduler.o -o Scheduler
clean:
	rm -f *.o
uninstall:
	rm Application