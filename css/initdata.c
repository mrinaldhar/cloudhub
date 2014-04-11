#include <stdlib.h>

extern void initializeData(int *array, int size);

void initializeData(int *array, int size)
{
 int i;
	srand(time(NULL));
	for(i=0; i<size; ++i){
		array[i] = rand()%2;
	}
	
	for(i=0; i< size; ++i)
		printf("%d\n", array[i]);
	printf("===");
}


/*
int A[10];

main(int argc, int *argv)
{
 int i;
	initializeData(A, 10);
	for(i=0; i< 10; ++i)
		printf("%d\n", A[i]);
}
*/
