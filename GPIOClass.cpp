#include <fstream>
#include <string>
#include <iostream>
#include "GPIOClass.h"

using namespace std;

GPIOClass::GPIOClass(){
    GPIOClass::gpionum = "17"; //GPIO17 is default
}

GPIOClass::GPIOClass(string gnum){
    GPIOClass::gpionum = gnum;  //Instatiate GPIOClass object for GPIO pin number "gnum"
}

int GPIOClass::export_gpio(){
    string export_str = "/sys/class/gpio/export";
    ofstream exportgpio(export_str.c_str()); // Open "export" file. Convert C++ string to C string. Required for all Linux pathnames
    if (exportgpio < 0){
        cout << " OPERATION FAILED: Unable to export GPIO"<< GPIOClass::gpionum <<" ."<< endl;
        return -1;
    }
    
    exportgpio << GPIOClass::gpionum ; //write GPIO number to export
    exportgpio.close(); //close export file
    return 0;
}

int GPIOClass::unexport_gpio(){
    string unexport_str = "/sys/class/gpio/unexport";
    ofstream unexportgpio(unexport_str.c_str()); //Open unexport file
    if (unexportgpio < 0){
        cout << " OPERATION FAILED: Unable to unexport GPIO"<< GPIOClass::gpionum <<" ."<< endl;
        return -1;
    }
    
    unexportgpio << GPIOClass::gpionum ; //write GPIO number to unexport
    unexportgpio.close(); //close unexport file
    return 0;
}

int GPIOClass::setdir_gpio(string dir){
    
    string setdir_str ="/sys/class/gpio/gpio" + GPIOClass::gpionum + "/direction";
    ofstream setdirgpio(setdir_str.c_str()); // open direction file for gpio
    if (setdirgpio < 0){
        cout << " OPERATION FAILED: Unable to set direction of GPIO"<< GPIOClass::gpionum <<" ."<< endl;
        return -1;
    }
    
    setdirgpio << dir; //write direction to direction file
    setdirgpio.close(); // close direction file
    return 0;
}

int GPIOClass::setval_gpio(string val){
    
    string setval_str = "/sys/class/gpio/gpio" + GPIOClass::gpionum + "/value";
    ofstream setvalgpio(setval_str.c_str()); // open value file for gpio
    if (setvalgpio < 0){
        cout << " OPERATION FAILED: Unable to set the value of GPIO"<< GPIOClass::gpionum <<" ."<< endl;
        return -1;
    }
    
    setvalgpio << val ;//write value to value file
    setvalgpio.close();// close value file
    return 0;
}

int GPIOClass::getval_gpio(string& val){
    
    string getval_str = "/sys/class/gpio/gpio" + GPIOClass::gpionum + "/value";
    ifstream getvalgpio(getval_str.c_str());// open value file for gpio
    if (getvalgpio < 0){
        cout << " OPERATION FAILED: Unable to get value of GPIO"<< GPIOClass::gpionum <<" ."<< endl;
        return -1;
    }
    
    getvalgpio >> val ;  //read gpio value
    
    if(val != "0")
        val = "1";
    else
        val = "0";
    
    getvalgpio.close(); //close the value file
    return 0;
}

string GPIOClass::get_gpionum(){
    
    return GPIOClass::gpionum;
    
}