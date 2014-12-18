/*
    Application.cpp
    Created by Bobby Vogel on 12/6/14.
 
    Runs on Raspberry Pi as a background process to control HVAC unit.
 
    TODO:
        add pin garbage collection
        sanitize ctemp and dtemp values
 */

#include <iostream>
#include <unistd.h>
#include <fstream>
#include <sstream>
#include "GPIOClass.h"
#include "Application.h"

using namespace std;

Application::Application(){
    // initialize values and sets up GPIO pins
    mode = 0;
    desiredTemp = 66.0;
    currentTemp = 66.0;
    coolState = off;
    heatState = off;
    GPIOClass* cooling = setupGPIO("17", "out");
    GPIOClass* heating = setupGPIO("18", "out");
    
    bool alwayKeepGoing = true;
    while (alwayKeepGoing) {
        cout << "I print out every 15 seconds" << endl;
        // fetches mode, and temp values
        mode = getMode();
        desiredTemp = getDesiredTemp();
        currentTemp = getCurrentTemp();
        
        if (mode == 1) {
            // turns off Heat if it is on
            if (heatState == on) {
                setGPIOLow(heating, heatState);
            }
            if (currentTemp > desiredTemp) {
                if (coolState == off) {
                    //cout << "Turning on AC" << endl;
                    setGPIOHigh(cooling, coolState);
                } else {
                    //cout << "AC is on" << endl;
                }
            } else {
                if (coolState == off) {
                    //cout << "AC is off" << endl;
                } else {
                    //cout << "Turning off AC" << endl;
                    setGPIOLow(cooling, coolState);
                }
            }
        } else if (mode == 2) {
            // turns off AC if it is on
            if (coolState == on) {
                setGPIOLow(cooling, coolState);
            }
            if (currentTemp < desiredTemp) {
                if (heatState == off) {
                    //cout << "Turning on Heat" << endl;
                    setGPIOHigh(heating, heatState);
                } else {
                    //cout << "Heat is on" << endl;
                    setGPIOHigh(heating, heatState);
                }
            } else {
                if (heatState == off) {
                    //cout << "Heat is off" << endl;
                } else {
                    //cout << "Turning off Heat" << endl;
                    setGPIOLow(heating, heatState);
                }
            }
        } else {
            if (coolState == on) {
                //cout << "Turning off Air" << endl;
                setGPIOLow(cooling, coolState);
                setGPIOLow(heating, heatState);
            } else if (heatState == on) {
                //cout << "Turning off Air" << endl;
                setGPIOLow(cooling, coolState);
                setGPIOLow(heating, heatState);
            } else {
                //cout << "Air is off" << endl;
            }
        }
        pause(15); // pause for 15 seconds
    }
}

GPIOClass* Application::setupGPIO(string gpioNum, string direction){
    GPIOClass* relay = new GPIOClass(gpioNum); // create new GPIO object to be attached to GPIO
    
    relay->export_gpio(); // export GPIO
    
    relay->setdir_gpio(direction); // GPIO set to value of direction
    
    return relay;
}

void Application::setGPIOHigh(GPIOClass*& relay, highlow& state){
    relay->setval_gpio("1");
    state = on;
}

void Application::setGPIOLow(GPIOClass*& relay, highlow& state){
    relay->setval_gpio("0");
    state = off;
}

float Application::getDesiredTemp(){
    // pull data from '/var/www/thermo/dtemp'
    // if an error occurs set value to '66.0'
    float temp = 0.0;
    string gettemp_str = "/var/www/thermo/dtemp";
    ifstream gettemp(gettemp_str.c_str()); // open dtemp file
    if (gettemp < 0){
        cout << " OPERATION FAILED: Unable to get value of desired temperature."<< endl;
        // if file cannot be read sets dtmep to '66.0'
        temp = 66.0;
    }
    string dtemp = "";
    gettemp >> dtemp; // read dtemp value
    
    // TODO: sanitize dtemp value
    
    gettemp.close(); // close the dtemp file
    
    // convert string to float
    stringstream ss(dtemp);
    while (!ss.eof()) {
        ss >> temp;
    }
    
    return temp;
}

float Application::getCurrentTemp(){
    // pull data from '/var/www/thermo/ctemp'
    // if an error occurs set value to '66.0'
    float temp = 0.0;
    string gettemp_str = "/var/www/thermo/ctemp";
    ifstream gettemp(gettemp_str.c_str()); // open ctemp file
    if (gettemp < 0){
        cout << " OPERATION FAILED: Unable to get value of current temperature."<< endl;
        // if file cannot be read sets ctmep to '66.0'
        temp = 66.0;
    }
    string ctemp = "";
    gettemp >> ctemp; // read ctemp value
    
    // TODO: sanitize ctemp value
    
    gettemp.close(); // close the ctemp file
    
    // convert string to float
    stringstream ss(ctemp);
    while (!ss.eof()) {
        ss >> temp;
    }
    
    return temp;
}

int Application::getMode(){
    // pull data from '/var/www/thermo/mode'
    // if an error occurs set value to '0'
    int modeNum = 0;
    string getmode_str = "/var/www/thermo/mode";
    ifstream getmode(getmode_str.c_str()); // open mode file
    if (getmode < 0){
        cout << " OPERATION FAILED: Unable to get value of mode."<< endl;
        // if file cannot be read sets mode to '0'
        modeNum = 0;
    }
    string mode = "";
    getmode >> mode; // read mode value
    
    // sanitize mode value
    if (mode != "2" && mode != "1"){
        mode = "0";
    }
    
    getmode.close(); // close the mode file
    
    // convert string to int
    stringstream ss(mode);
    while (!ss.eof()) {
        ss >> modeNum;
    }
    
    return modeNum;
}

void Application::setDesiredTemp(float dtemp){
    // write data to '/var/www/thermo/dtemp'
    string setdtemp_str ="/var/www/thermo/dtemp";
    ofstream setdtemp(setdtemp_str.c_str()); // open desired temperature file
    if (setdtemp < 0){
        cout << "OPERATION FAILED: Unable to set desired temperature." << endl;
    }
    
    setdtemp << dtemp; // write direction to direction file
    setdtemp.close(); // close direction file
}

void Application::setCurrentTemp(float ctemp){
    // write data to '/var/www/thermo/ctemp'
    string setctemp_str ="/var/www/thermo/ctemp";
    ofstream setctemp(setctemp_str.c_str()); // open desired temperature file
    if (setctemp < 0){
        cout << "OPERATION FAILED: Unable to set current temperature." << endl;
    }
    
    setctemp << ctemp; // write current temperature to ctemp file
    setctemp.close(); // close ctemp file
}

void Application::setMode(int modeNum){
    // write data to '/var/www/thermo/mode'
    string setmode_str ="/var/www/thermo/mode";
    ofstream setmode(setmode_str.c_str()); // open mode file
    if (setmode < 0){
        cout << "OPERATION FAILED: Unable to set mode." << endl;
    }
    
    setmode << modeNum; // write mode to mode file
    setmode.close(); // close mode file
}

void Application::pause(int seconds){
    usleep(seconds * 1000000);
}

int main(){
    Application();
}