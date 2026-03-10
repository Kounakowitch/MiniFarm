#include "connect.h"

// ===== PUBLISH =====
void publishMessage(const String& ferme, const String& sensor, const String& msg) {
  String topic = "fermes/" + ferme + "/" + sensor;
  client.publish(topic.c_str(), msg.c_str());
  Serial.print("Envoyé sur ");
  Serial.print(topic);
  Serial.print(" → ");
  Serial.println(msg);
}
