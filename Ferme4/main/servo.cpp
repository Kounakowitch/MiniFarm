#include <ESP32Servo.h>  //Import the library of servo on ESP32 board
#include <Arduino.h>
#include "servo.h"
Servo myservo;  // create servo object to control a servo
                // 16 servo objects can be created on the ESP32

#define ServoPin 26
#define SERVO_OUVERT 80
#define SERVO_FERME 180

bool trappeOuverte = false;
bool ouvrirTrappe = false;
bool fermerTrappe = false;
unsigned long tempsOuverture = 0;
const unsigned long delaiTrappe = 5000;

void initServo(){
  myservo.attach(ServoPin);   // attaches the servo on pin 26 to the servo object
  myservo.write(SERVO_FERME);   // trappe fermée au départ
  delay(2000);
}

void openTrappe() {
    if (!trappeOuverte) {
      myservo.write(SERVO_OUVERT);
      trappeOuverte = true;
    }
}

void closeTrappe() {
  if (trappeOuverte) {
    myservo.write(SERVO_FERME);
    trappeOuverte = false;
  }
}
