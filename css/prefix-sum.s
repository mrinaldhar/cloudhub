.include "io.h"

.extern initializeData

.equ size, 10
.data
.align 4
array: .skip size*4      @allocate memory for an array of words

.text
.global main

main:
	ldr r0, =array
	mov r1, #size
	bl initializeData

@ code for prefix sum goes here	
	
@int sys_exit(int status)
        mov r0, #0      @ Return code
        mov r7, #1      @ sys_exit
        svc 0x00000000
 
