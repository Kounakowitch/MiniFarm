#include "ultrasonic.h"
#include <Arduino.h>

#define Trigpin 12 //connect trig to io12
#define Echopin 13 //connect echo to io13
int duration,distance;

void initUltrasonic(){
  pinMode(Trigpin,OUTPUT);  //set trig pin to output mode 
  pinMode(Echopin,INPUT);   //set echo pin to input mode
}

int readUltrasonic(){
  digitalWrite(Trigpin,LOW);
  delayMicroseconds(2);
  
  digitalWrite(Trigpin,HIGH);
  delayMicroseconds(10);	//Trigger the trig pin via a high level lasting at least 10us
  digitalWrite(Trigpin,LOW);
  long duration = pulseIn(Echopin,HIGH);	//the time of high level at echo pin
  //int distance = duration/58;		//convert into distance(cm)
  int distance = duration * 0.034 / 2;
  
  return distance;
}