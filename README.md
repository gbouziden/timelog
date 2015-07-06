# timelog
check-in and check-out employee (or personal) tracking

This application is for logging employee's working hours for various HR or management needs, whether it be for pay roll or auditing purposes. 

It features both an admin panel and user panel. 
-The admin panel can view who has or hasn't checked in, search individual accounts, and export to either excel or access. 
-The user panel has the option to check-in and check-out, pause (for lunch!), and view the current work week's hours. 

It also features both LDAP and regular authentication for logging in. 
-For LDAP, just substitute your active directory IP address and Port for access. 
  EX: ("ip.address", Port)
    username: jdoe
    password: ADpassword
    

-More admin features coming soon. 
 -Editing employees time on the front-end
 -Choosing specific to-from dates for pay periods
 -email notifications of employees who haven't checked in
 
