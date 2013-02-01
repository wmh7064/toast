// classes example
#include "Rectangle.h"

using namespace std;


void CRectangle::set_values (int a, int b) {
    x = a;
    y = b;
}

int CRectangle::area () {
    return (x*y);
}

int CRectangle::lenth () {
    return (x+y)*2;
}

