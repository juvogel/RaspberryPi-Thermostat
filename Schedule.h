//
//  Schedule.h
//  
//
//  Created by Bobby Vogel on 12/11/14.
//
//

#ifndef SCHEDULE_H_EXISTS
#define SCHEDULE_H_EXISTS

class Schedule {
protected:
    int mode[4];
    int dtemp[4];
public:
    Schedule();
    void setMode(int pos, int mode);
    void setDTemp(int pos, int dtemp);
    int getMode(int pos);
    int getDTemp(int pos);
};

#endif /* defined(SCHEDULE_H_EXISTS) */
