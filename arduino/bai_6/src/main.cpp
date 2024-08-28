#include<Arduino.h>
int latchPin=8;
int lockPin=12;
int dataPin=11;
byte ledstatus=0b00000001;
void setup()
{
  pinMode(latchPin,OUTPUT);
  pinMode(lockPin,OUTPUT);
  pinMode(dataPin,OUTPUT);
}
void loop()
{
  digitalWrite(latchPin,LOW);
  shiftOut(dataPin,lockPin,MSBFIRST,ledstatus);
  digitalWrite(latchPin,HIGH);
  ledstatus=ledstatus*2+1;
  if(ledstatus==0b11111111)
  {
    delay(100);
    digitalWrite(latchPin,LOW);
    shiftOut(dataPin,lockPin,MSBFIRST,ledstatus);
    digitalWrite(latchPin,HIGH);
    ledstatus=0b00000001;
  }
  delay(100);
}
