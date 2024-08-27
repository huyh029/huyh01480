#include <Arduino.h>
int led[]={8,9,10,11,12};
void sangdan(int thoigian);
void tatdan(int thoigian);
void setup()
{
  for(int i=9;i<5;i++)
  {
    pinMode(led[i],OUTPUT);
  }
  sangdan(0);
  delay(1000);
  tatdan(0);
  sangdan(200);
}
void sangdan(int thoigian)
{
  for(int i=0;i<5;i++)
  {
    digitalWrite(led[i],HIGH);
  if(thoigian>0)  delay(thoigian);
  }
}
void tatdan(int thoigian)
{
  for(int i=0;i<5;i++)
  {
    digitalWrite(led[i],LOW);
    if(thoigian>0)  delay(thoigian);
  }
}
void loop()
{

}