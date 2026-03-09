#ifndef LCD_H
#define LCD_H

#include <LiquidCrystal_I2C.h>
extern LiquidCrystal_I2C lcd;

void setup_LCD();
void displayMsg(String msg);

#endif