#ifndef HUMIDITY_TEMPERATURE_H
#define HUMIDITY_TEMPERATURE_H

struct DHTData {
  double temperature;
  double humidity;
  bool valid;
};

void initHumidityTemperature();
DHTData readTemperatureHumidity();
double Fahrenheit(double celsius);
double Kelvin(double celsius);
double dewPoint(double celsius, double humidity);
double dewPointFast(double celsius, double humidity);

#endif