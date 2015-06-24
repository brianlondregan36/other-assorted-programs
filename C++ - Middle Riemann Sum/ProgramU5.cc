/* 	
	PSP Program U5	
	Brian Londregan
	This program numerically integrates the Standard Normal 
	Distribution function using Middle Riemann Sum.  
*/

#include<iostream>
#include<fstream>
#include<string>
#include<cmath>

using namespace std;
typedef double ElementType;




bool Compare(ElementType number1, ElementType number2);                                                       
ElementType ComputeMRS(ElementType x, int y);
ElementType ComputeSND(ElementType temp);




int main()
{
	ElementType b;
	cout << "Enter b: " << endl;
	cin >> b;
	
	int n;
	cout << "Enter n: " << endl;
	cin >> n;

	ElementType MRS1;
	ElementType MRS2;
	bool stop = false; 



	//Keep computing 2 sums at a time until the amount of error is acceptable
	//Each new time, use the previous MRS(with n) and a new MRS(with double number of segments)
	while (stop == false)
	{
		MRS1 = ComputeMRS(b, n);
		MRS2 = ComputeMRS(b, 2*n);
		stop = Compare(MRS1, MRS2);
	}
	


	cout << "The Middle Riemann Sum is = " << MRS2 << endl;
	return 0;
}




bool Compare(ElementType number1, ElementType number2)
{
	ElementType E = 0.00001;
	ElementType MRS1 = number1;
	ElementType MRS2 = number2;
	bool accurate = false; 


	if((MRS1 - MRS2) < E)
		accurate = true;
	else 
		accurate = false;


	//Subtract the two sums, if the difference is less then the accepted error return true 
	return accurate;
}



ElementType ComputeMRS(ElementType x, int y)
{
	ElementType b = x;
	int n = y; 
	ElementType changeX = b / n;
	ElementType temp = 0;
	ElementType MRS = 0;


	//N times: calculate temp, use that as x in the SND formula, add result of formula to the sum 
	for(int k = 1; k <= n; k++)
	{
		temp = ((((2*k) - 1) * changeX) / 2);
		temp = ComputeSND(temp);
		MRS = MRS + temp;
	}

	
	return (MRS * changeX);
}



ElementType ComputeSND(ElementType temp)
{
	ElementType x = temp; 
	double pi = 3.141592653589;
 
	//Take x, put into the standard normal distribution formula, return it.
	return ((exp(-0.5 * (pow(x,2)))) / (sqrt(2 * pi)));
}