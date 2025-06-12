#include "game2048.h"
#include <stdio.h>
#include <stdlib.h>
#include <time.h>
#include <conio.h> 
#include<math.h>

int value[4][4] = {
    {0,0,0,0},
    {2048,0,2,0},
    {0,0,4,4},
    {4,0,0,4}
}; 
int core=0;
void outPut(){
    printf("core: %d\n",core);
    printf("-------------------------\n");
   for (int i = 0; i < 4; i++) {
    for (int j = 0; j < 4; j++) {
        int v = value[i][j];
        if (v != 0) {
            if (v <= 1024) {
                printf("%d\t", v);
            } else {
                int exp = (int)(log2(v) + 0.5); 
                printf("2^%d\t", exp);
            }
        } else {
            printf(" \t");
        }
    }
    printf("\n\n");
}
    printf("-------------------------\n");
}

int main(){
    while (1) {
        system("cls");  // Xoá màn hình trên Windows
        outPut();

        if (isFinish(value)) {
            printf("Game Over! No more moves.\n");
            break;
        }

        printf("Use arrow keys to move (Esc to quit):\n");
        int ch = _getch();

        if (ch == 27) {
            printf("Game exited.\n");
            break;
        }

        if (ch == 0 || ch == 224) {
            int arrow = _getch();
            unsigned int seed = (unsigned int)time(NULL);

            switch (arrow) {
                case 72: // Up
                    core+=upAction(value, seed);
                    break;
                case 80: // Down
                    core+=downAction(value, seed);
                    break;
                case 75: // Left
                    core+=leftAction(value, seed);
                    break;
                case 77: // Right
                    core+=rightAction(value, seed);
                    break;
                default:
                    printf("Invalid key\n");
            }
        }
    }

    return 0;
}
