.extern printf
.extern scanf
.extern stdout

.data
.Lstrscan: .asciz "%s"
.align 2
.Lintscan: .asciz "%s"
.Lintprint: .asciz "%d\n"
.Lintprinthex: .asciz "0x%X\n"
.align 2
.Ltempword: .word 0x0
.align 2
.Lstdout: .word stdout

.macro fflush
	push {r0-r3,r12}
	ldr r0, =.Lstdout
	ldr r0, [r0]
	ldr r0, [r0]
	bl fflush	
        pop {r0-r3,r12}
.endm

.macro putstr strparam
        push {r0-r3,r12}
        ldr r0, =\strparam
	bl printf
	fflush
        pop {r0-r3,r12}
.endm

.macro getstr strparam
	push {r0-r3,r12}
	ldr r1, =\strparam
	ldr r0, =.Lstrscan
	bl scanf 
	pop {r0-r3,r12}
.endm

.macro putint  intparam
        push {r0-r3,r12}
	ldr r1,=\intparam
	ldr r1,[r1]
	ldr r0, =.Lintprint
	bl printf
        pop {r0-r3,r12}
.endm

.macro putinthex  intparam
        push {r0-r3,r12}
	ldr r1,=\intparam
	ldr r1,[r1]
	ldr r0, =.Lintprinthex
	bl printf
        pop {r0-r3,r12}
.endm

.macro putreg regparam
        push {r0-r3,r12}
	mov r1, \regparam
	ldr r0, =.Lintprint
	bl printf
        pop {r0-r3,r12}
.endm

.macro putreghex regparam
        push {r0-r3,r12}
	mov r1, \regparam
	ldr r0, =.Lintprinthex
	bl printf
        pop {r0-r3,r12}
.endm

.macro getreg regparam
        push {r0-r3,r12}
	ldr r1, =.Ltempword
	ldr r0, =.Lintscan
	bl scanf
        pop {r0-r3,r12}
	ldr r1, =.Ltempword
	ldr \regparam, [r1]
	
.endm

.macro getint intparam
	push {r0-r3, r12}
	ldr r1,=\intparam
	ldr r0, =.Lintscan
	bl scanf
	pop {r0-r3, r12}
.endm
