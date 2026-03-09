#include "connect.h"
#include <LiquidCrystal_I2C.h>

void setup_LCD() {
  lcd.init();
  lcd.backlight();
}

void displayCount() {
  lcd.clear();
  lcd.setCursor(0, 0);
  lcd.print("Moutons entres:");
  lcd.setCursor(0, 1);
  lcd.print(countF4);
}

void displayFinished() {
  lcd.clear();
  lcd.setCursor(0, 0);
  lcd.print("Comptage termine");
  lcd.setCursor(0, 1);
  lcd.print("Total: " + String(countF4));
}