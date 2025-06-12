#include "game2048.h"
#include <stdlib.h>

int r[2]={2,4};
unsigned int randFromSeed(unsigned int seed) {
    return (1103515245 * seed + 12345) % (1U << 31);
}

int randInRange(unsigned int seed, int min, int max) {
    unsigned int r = randFromSeed(seed);
    return min + r % (max - min + 1);
}
int pushLeft(int a[4][4]) {
    int result = 0;
    int b[4], k;
    for (int i = 0; i < 4; i++) {
        k = 0;
        for (int j = 0; j < 4; j++) {
            if (a[i][j] != 0) b[k++] = a[i][j];
        }
        for (int j = k; j < 4; j++) b[j] = 0;
        for (int j = 0; j < 4; j++) {
            if (a[i][j] != b[j]) result = 1;
            a[i][j] = b[j];
        }
    }
    return result;
}

int leftAction(int a[4][4], unsigned int seed) {
    int core=0;
    int r1 = pushLeft(a);
    for (int i = 0; i < 4; i++) {
        for (int j = 0; j < 3; j++) {
            if (a[i][j] == a[i][j + 1]) {
                core+=2*a[i][j];
                a[i][j] += a[i][j + 1];
                a[i][j + 1] = 0;
            }
        }
    }
    int r2 = pushLeft(a);
    if (r1 || r2) {
        int c[16], k = 0;
        for (int i = 0; i < 4; i++) {
            for (int j = 2; j < 4; j++) {
                if (a[i][j] == 0) c[k++] = i * 4 + j;
            }
        }
        if (k > 0) {
            int h = c[randInRange(seed, 0, k - 1)];
            a[h / 4][h % 4] = r[(randInRange(seed + 1, 0, 7)>6?1:0)];
        }
    }
    return core;
}
int pushRight(int a[4][4]) {
    int result = 0;
    int b[4], k;
    for (int i = 0; i < 4; i++) {
        k = 3;
        for (int j = 3; j >= 0; j--) {
            if (a[i][j] != 0) b[k--] = a[i][j];
        }
        for (int j = k; j >= 0; j--) b[j] = 0;
        for (int j = 0; j < 4; j++) {
            if (a[i][j] != b[j]) result = 1;
            a[i][j] = b[j];
        }
    }
    return result;
}

int rightAction(int a[4][4], unsigned int seed) {
    int core=0;
    int r1 = pushRight(a);
    for (int i = 0; i < 4; i++) {
        for (int j = 3; j > 0; j--) {
            if (a[i][j] == a[i][j - 1]) {
                core+=2*a[i][j];
                a[i][j] += a[i][j - 1];
                a[i][j - 1] = 0;
            }
        }
    }
    int r2 = pushRight(a);
    if (r1 || r2) {
        int c[16], k = 0;
        for (int i = 0; i < 4; i++) {
            for (int j = 0; j < 2; j++) {
                if (a[i][j] == 0) c[k++] = i * 4 + j;
            }
        }
        if (k > 0) {
            int h = c[randInRange(seed, 0, k - 1)];
            a[h / 4][h % 4] = r[(randInRange(seed + 1, 0, 7)>6?1:0)];
        }
    }
    return core;
}
int pushUp(int a[4][4]) {
    int result = 0;
    int b[4], k;
    for (int i = 0; i < 4; i++) {
        k = 0;
        for (int j = 0; j < 4; j++) {
            if (a[j][i] != 0) b[k++] = a[j][i];
        }
        for (int j = k; j < 4; j++) b[j] = 0;
        for (int j = 0; j < 4; j++) {
            if (a[j][i] != b[j]) result = 1;
            a[j][i] = b[j];
        }
    }
    return result;
}

int upAction(int a[4][4], unsigned int seed) {
    int core=0;
    int r1 = pushUp(a);
    for (int i = 0; i < 4; i++) {
        for (int j = 0; j < 3; j++) {
            if (a[j][i] == a[j + 1][i]) {
                core+=2*a[j][i];
                a[j][i] += a[j + 1][i];
                a[j + 1][i] = 0;
            }
        }
    }
    int r2 = pushUp(a);
    if (r1 || r2) {
        int c[16], k = 0;
        for (int i = 2; i < 4; i++) {
            for (int j = 0; j < 4; j++) {
                if (a[i][j] == 0) c[k++] = i * 4 + j;
            }
        }
        if (k > 0) {
            int h = c[randInRange(seed, 0, k - 1)];
            a[h / 4][h % 4] = r[(randInRange(seed + 1, 0, 7)>6?1:0)];
        }
    }
    return core;
}
int pushDown(int a[4][4]) {
    int result = 0;
    int b[4], k;
    for (int i = 0; i < 4; i++) {
        k = 3;
        for (int j = 3; j >= 0; j--) {
            if (a[j][i] != 0) b[k--] = a[j][i];
        }
        for (int j = k; j >= 0; j--) b[j] = 0;
        for (int j = 0; j < 4; j++) {
            if (a[j][i] != b[j]) result = 1;
            a[j][i] = b[j];
        }
    }
    return result;
}

int downAction(int a[4][4], unsigned int seed) {
    int core=0;
    int r1 = pushDown(a);
    for (int i = 0; i < 4; i++) {
        for (int j = 3; j > 0; j--) {
            if (a[j][i] == a[j - 1][i]) {
                core+=2*a[j][i];
                a[j][i] += a[j - 1][i];
                a[j - 1][i] = 0;
            }
        }
    }
    int r2 = pushDown(a);
    if (r1 || r2) {
        int c[16], k = 0;
        for (int i = 0; i < 2; i++) {
            for (int j = 0; j < 4; j++) {
                if (a[i][j] == 0) c[k++] = i * 4 + j;
            }
        }
        if (k > 0) {
            int h = c[randInRange(seed, 0, k - 1)];
            a[h / 4][h % 4] = r[(randInRange(seed + 1, 0, 7)>6?1:0)];
        }
    }
    return core;
}
int isFinish(int a[4][4]) {
    for (int i = 0; i < 4; i++) {
        for (int j = 0; j < 4; j++) {
            if (a[i][j] == 0) return 0;
        }
    }
    for (int i = 0; i < 4; i++) {
        for (int j = 0; j < 4; j++) {
            if (j < 3 && a[i][j] == a[i][j + 1]) return 0;
            if (i < 3 && a[i][j] == a[i + 1][j]) return 0;
        }
    }
    return 1;
}

