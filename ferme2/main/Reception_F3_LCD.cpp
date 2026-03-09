#include "connect.h"
#include <LiquidCrystal_I2C.h> // Nécessaire ici pour le type LiquidCrystal_I2C

// Variables globales RETIRÉES (maintenant dans global_config.cpp)

// L'objet lcd est désormais déclaré extern dans connect.h et défini dans global_config.cpp

void setup_LCD() {
  lcd.init();
  lcd.backlight();
}
// Le reste des fonctions (setup_wifi, callback, reconnect) est RETIRÉ