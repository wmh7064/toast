#include "Rectangle.h"
#include <iostream>

using namespace std;

int main () {
    CRectangle rect;
    rect.set_values (3,4);
    cout << "area: " << rect.area() << std::endl;
    return 0;
}
