#include <ctime>
#include <unistd.h>
#include <iostream>
#include <sstream>
#include <fstream>
#include "Schedule.h"

class Scheduler {
private:
    Schedule* schedule;
    enum timeofDay { Night, Morning, Afternoon, Evening };
    int day;
    std::string hrmin;
public:
    Scheduler();
    ~Scheduler();
    void checkDateTime(int &day, std::string &hrmin);
    void loadSchedule(Schedule* schedule);
    void setDTemp(int dtemp);
    void setMode(int modeNum);
};

using namespace std;

Scheduler::Scheduler(){
    // new Schedule type
    schedule = new Schedule[7];
    // load schedule to array
    loadSchedule(schedule);
    
    // get current day and time
    day = 0;
    hrmin = "";
    checkDateTime(day, hrmin);
    
    // based on current hour set desired temperature and mode from the imported 'schedule' array
    if (hrmin == "6:0") { // night
        setDTemp(schedule[day].getDTemp(Morning));
        setMode(schedule[day].getMode(Morning));
    } else if (hrmin == "12:0") { // morning
        setDTemp(schedule[day].getDTemp(Afternoon));
        setMode(schedule[day].getMode(Afternoon));
    } else if (hrmin == "18:0") { // afternoon
        setDTemp(schedule[day].getDTemp(Evening));
        setMode(schedule[day].getMode(Evening));
    } else if (hrmin == "23:0") { // evening
        setDTemp(schedule[day].getDTemp(Night));
        setMode(schedule[day].getMode(Night));
    }
}

Scheduler::~Scheduler(){
    delete[] schedule;
}

void Scheduler::checkDateTime(int &day, string &hrmin){
    
    time_t t = time(0);   // get time now
    struct tm * now = localtime( & t );
    
    stringstream ss;
    day = now->tm_wday;
    ss << now->tm_hour << ":" << now->tm_min;
    ss >> hrmin;
}

void Scheduler::loadSchedule(Schedule* schedule){
    // parse file and load into an array
    string contents;
    ifstream file;
    file.open("/var/www/thermo/schedule.csv");
    string data[7][8];
    int i = 0;
    while (!file.eof()) {
        getline(file, contents, ',');
        getline(file, contents);
        data[i][0] = contents;
        i++;
    }
    file.close();
    
    // turn string into 'data' array
    string list;
    for (int i = 0; i < 7; i++) {
        stringstream ss(data[i][0]);
        for (int j = 0; j < 8; j++) {
            getline(ss, list, ',');
            data[i][j] = list;
        }
    }
    
    // set schedule object from 'data' array
    for (int i = 0; i < 7; i++) {
        for (int j = 0; j < 4; j++) {
            schedule[i].setMode(j, stoi(data[i][j]));
            schedule[i].setDTemp(j, stoi(data[i][j + 4]));
        }
    }
}

void Scheduler::setDTemp(int dtemp){
    // write data to '/var/www/thermo/dtemp'
    string setdtemp_str ="/var/www/thermo/dtemp";
    ofstream setdtemp(setdtemp_str.c_str()); // open desired temperature file
    if (setdtemp < 0){
        cout << "OPERATION FAILED: Unable to set desired temperature." << endl;
    }
    
    setdtemp << dtemp; // write direction to direction file
    setdtemp.close(); // close direction file
}

void Scheduler::setMode(int modeNum){
    // write data to '/var/www/thermo/mode'
    string setmode_str ="/var/www/thermo/mode";
    ofstream setmode(setmode_str.c_str()); // open mode file
    if (setmode < 0){
        cout << "OPERATION FAILED: Unable to set mode." << endl;
    }
    
    setmode << modeNum; // write mode to mode file
    setmode.close(); // close mode file
}

int main(){
    bool keepGoing = true;
    while (keepGoing) {
        Scheduler();
        usleep(60 * 1000000); // pauses for 1 minute
    }
}
