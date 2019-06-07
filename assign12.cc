/*************************************************
  Luis Aguinaga
  z1811673
  CSCI466 Assignment 12
  05/04/2018
*************************************************/
#include <iostream>
#include <sstream>
#include <iomanip>
#include <mysql.h>
#include <string>
using namespace std;

int main()
{
  MYSQL *conn, mysql;
  conn = mysql_init(&mysql);

  //establishing connection to databse
  if(!mysql_real_connect(conn,"courses","z1811673","1994Jul27","z1811673",0,NULL,0))
    cout << "Failed to connect to Database. Error: " << mysql_error(conn);
 //data types to handle marina return sets
  MYSQL_RES *returnMarina;
  MYSQL_ROW rowMarina;
//data tyoes to handle owner return sets
  MYSQL_RES *owners;
  MYSQL_ROW rowOwners;
//data types to handle boat return sets
  MYSQL_RES *boat;
  MYSQL_ROW rowBoat;
//data types to handel service return sets
  MYSQL_RES *service;
  MYSQL_ROW rowService;

//select query to get all values in Marina table
  mysql_query(conn,"SELECT * FROM Marina;");
  returnMarina = mysql_store_result(conn);
//headetr for Marinas
  cout << "Marina Num:     Name:                  City:            State:" << endl;
  cout << "-------------------------------------------------------------" << endl;
  while((rowMarina = mysql_fetch_row(returnMarina)) != NULL)
  {
    //printing out Marina data
    cout << setw(7) << rowMarina[0] << setw(24) << rowMarina[1] <<setw(15) << rowMarina[3] <<setw(10) << rowMarina[4] << endl << endl;
    ostringstream os;
    //select query to get owners associated with the Marinas
    os << "SELECT OwnerTbl.OwnerNum, OwnerTbl.FirstName, OwnerTbl.LastName, OwnerTbl.City FROM OwnerTbl INNER JOIN MarinaSlip ON OwnerTbl.OwnerNum = MarinaSlip.OwnerNum WHERE MarinaNum = " << rowMarina[0];
//converting the os object to string
    mysql_query(conn, os.str().c_str());
    owners = mysql_store_result(conn);

    while((rowOwners = mysql_fetch_row(owners)) != NULL)
    {
      //printing out owners names and city
      cout << setw(20) << "Name: " << rowOwners[1] << " " << rowOwners[2] << " City: " << rowOwners[3] << endl << endl;
      ostringstream os;
      //query to get boat names with the corresponding owner names
      os << "SELECT BoatName From MarinaSlip WHERE OwnerNum = " << rowOwners[0];
      //converting to string
      mysql_query(conn, os.str().c_str());
      boat = mysql_store_result(conn);
      //while loop to print all boat names
      while((rowBoat = mysql_fetch_row(boat)) != NULL)
      {
        cout << "Boat Name: " << rowBoat[0] << endl << endl;
        ostringstream os;
        //query to get service request for each boat
        os << "SELECT ServiceRequest.Description, ServiceRequest.Status FROM ServiceRequest INNER JOIN MarinaSlip ON ServiceRequest.SlipID = MarinaSlip.SlipID WHERE (BoatName = '" << rowBoat[0] <<"' AND ServiceRequest.Description IS NOT NULL);";
        //convert to string
        mysql_query(conn,os.str().c_str());
        service = mysql_store_result(conn);
        //while loop to print out services
        if(mysql_num_rows(service) == 0)
        {
          while(rowService = mysql_fetch_row(service))
          {
            cout << "Description: " << rowService[0] << endl << endl;
            cout << "Status: " << rowService[1] << endl << endl;
          }
        }
        else
          {
            cout << "No Service has been done to this Boat." << endl << endl;
          }
      }
    }
    cout << "***********************************************************************************" << endl;
  }
  //freeing the result queries
  mysql_free_result(returnMarina);
  mysql_free_result(owners);
  mysql_free_result(boat);
  mysql_free_result(service);
  //closing the database connection
  mysql_close(conn);
  return 0;
}
