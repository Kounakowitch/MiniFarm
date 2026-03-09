#include "LCD.h"

LiquidCrystal_I2C lcd(0x27, 16, 2);

void setup_LCD() {
  lcd.init();
  lcd.backlight();
}

void displayMsg(String msg) {
  lcd.clear();
  lcd.setCursor(0, 0);
  lcd.print(msg.substring(0, 16));
  lcd.setCursor(0, 1);
  if (msg.length() > 16) lcd.print(msg.substring(16, 32));
}