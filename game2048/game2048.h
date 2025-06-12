#ifndef GAME2048_H
#define GAME2048_H

int leftAction(int a[4][4],unsigned int seed);
int rightAction(int a[4][4],unsigned int seed);
int upAction(int a[4][4],unsigned int seed);
int downAction(int a[4][4],unsigned int seed);
int isFinish(int a[4][4]);
#endif
