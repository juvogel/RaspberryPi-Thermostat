/*
    Application.cpp
    Created by Bobby Vogel on 12/6/14.
 
    Runs on Raspberry Pi as a background process to control HVAC unit.
 
    TODO:
        add pin garbage collection
        sanitize ctemp and dtemp values
 */

#include "GPIOClass.h"

class Application {
private:
    enum highlow { off, on } heatState, coolState;
    float desiredTemp;
    float currentTemp;
    int mode;
public:
    Application();
    GPIOClass* setupGPIO(std::string gpioNum, std::string direction);
    void setGPIOHigh(GPIOClass*& relay, highlow& state);
    void setGPIOLow(GPIOClass*& relay, highlow& state);
    float getDesiredTemp();
    float getCurrentTemp();
    int getMode();
    void setDesiredTemp(float dtemp);
    void setCurrentTemp(float ctemp);
    void setMode(int modeNum);
    void pause(int seconds);
};