#include<Arduino.h>
int button=13;
int led=6;
void setup()
{
  pinMode(button,INPUT);
  pinMode(led,OUTPUT);
}
void loop()
{
  int check_but=digitalRead(button);
  digitalWrite(led,check_but);
}