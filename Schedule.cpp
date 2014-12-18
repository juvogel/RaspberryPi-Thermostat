//
//  Schedule.cpp
//
//
//  Created by Bobby Vogel on 12/11/14.
//
//

#include "Schedule.h"

Schedule::Schedule(){
    for (int i = 0; i < 4; i++) {
        mode[i] = -1;
        dtemp[i] = 0;
    }
}

void Schedule::setMode(int pos, int mode){
    Schedule::mode[pos] = mode;
}

void Schedule::setDTemp(int pos, int dtemp){
    Schedule::dtemp[pos] = dtemp;
}

int Schedule::getMode(int pos){
    return Schedule::mode[pos];
}

int Schedule::getDTemp(int pos){
    return Schedule::dtemp[pos];
}
