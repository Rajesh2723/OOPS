#include<bits/stdc++.h>
#include <unistd.h>

void main(){
  int pi_d ;
  int pid ;
  pi_d = fork();
  if(pi_d == 0){
   cout<<getpid()<<getppid()<<endl;
  }
  if(pi_d > 0){
    pid = fork();
    if(pid > 0){
     cout<<getpid()<<getppid()<<endl;
    }
    else if(pid == 0){
     cout<<getpid()<<getppid()<<"child process"<<endl;
    }
  }
}
