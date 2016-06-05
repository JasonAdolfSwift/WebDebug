#include <stdio.h>

int main()
{
    int a = 100;
    int b = 200;

    int *p1 = &a;
    int *p2 = &b;

    printf("a=%d,&a=0x%08x\n   b=%d,&b=0x%08x\n", a, p1, b, p2);

    return 0;
}