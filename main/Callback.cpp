
#include "connect.h"

void publishCountF4() {
  String topic = "fermes/" + FERME_ID + "/count-sheep";
  client.publish(topic.c_str(), String(countF4).c_str());
  Serial.println("F4 → publié : " + String(countF4));
}

void callback(char* topic, byte* payload, unsigned int length) {

  String msg;
  for (unsigned int i = 0; i < length; i++) {
    msg += (char)payload[i];
  }
  msg.trim();

  Serial.print("Message recu : ");
  Serial.println(msg);

  if (String(topic) == "fermes/ferme3/gel") {

    if (msg == "1") {

      gelActif = true;

      lcd.clear();
      lcd.setCursor(0,0);
      lcd.print("Attention Gel");
      lcd.setCursor(0,1);
      lcd.print("Nourriture F4");

      Serial.println("Gel detecte !");
    }
  }
}