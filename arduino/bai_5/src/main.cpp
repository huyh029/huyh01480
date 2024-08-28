#include<Arduino.h>
int led=13;
int button_1=2;
int button_2=3;
void setup()
{
  pinMode(led,OUTPUT);
  pinMode(button_1,INPUT);
  pinMode(button_2,INPUT);
}
void loop()
{
  digitalWrite(led,digitalRead(button_1)&&digitalRead(button_2));
}