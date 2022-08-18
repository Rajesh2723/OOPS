#include <iostream>

using namespace std;

class Mybase{
    public:
    void show(){
        cout<<"Base class is called"<<endl;
    }
    virtual void print(){                                //here the virtual fuction we are mention thats why base class print function wont be called 
                                                          // it calls the derived class one and it decides at runtime so it is polymorphism example
        cout<<"base class print funtion class"<<endl;
    }
    
};
class Myderived:public Mybase{
    
    void show(){
        cout<<"derived class is called"<<endl;
    }
     void print(){
        cout<<"derived class print funtion class"<<endl;
    }
};

int main(){
    Mybase *baseptr;
    Myderived deriveobj;
    baseptr=&deriveobj;
    baseptr->print();
    baseptr->show();
    
}
