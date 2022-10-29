#include <iostream>

using namespace std;

class base{
    public:
    void getdata(){
        cout<<"base class"<<endl;
    }
};
class derived:public base{
    public:
    void getdata(){
       // cout<<"derived"<<endl;
       base::getdata();
    }
};
int main(){
    derived obj;
    obj.getdata();
}
