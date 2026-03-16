#ifndef SERVO_CONTROL_H
#define SERVO_CONTROL_H

#include <ESP32Servo.h>

extern Servo myservo;
extern bool trappeOuverte;
extern bool ouvrirTrappe;
extern bool fermerTrappe;
extern unsigned long tempsOuverture;
extern const unsigned long delaiTrappe;

void initServo();
void openTrappe();
void closeTrappe();

#endif