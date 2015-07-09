# timelog
check-in and check-out employee (or personal) tracking

This application is for logging employee's working hours for various HR or management needs, whether it be for pay roll or auditing purposes. 


Setting up the MySQL Databse:
<pre>

CREATE DATABASE `timedb` /*!40100 DEFAULT CHARACTER SET utf8 */$$

CREATE TABLE `tbl_logs` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `user_login` time NOT NULL,
  `user_logout` time NOT NULL,
  `log_time` int(11) NOT NULL,
  `log_date` date NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=1458 DEFAULT CHARSET=latin1$$

CREATE TABLE `tbl_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=119 DEFAULT CHARSET=latin1$$

CREATE TABLE `tbl_worklog` (
  `logno` int(11) NOT NULL AUTO_INCREMENT,
  `id` varchar(255) NOT NULL,
  `timespan` int(11) NOT NULL,
  `mode` varchar(255) NOT NULL,
  `logtime` datetime NOT NULL,
  PRIMARY KEY (`logno`)
) ENGINE=InnoDB AUTO_INCREMENT=476 DEFAULT CHARSET=latin1$$

</pre>


It features both an admin panel and user panel. 
<ul>
<li>The admin panel can view who has or hasn't checked in, search individual accounts, and export to either excel or access.</li>
<li>The user panel has the option to check-in and check-out, pause (for lunch!), and view the current work week's hours. </li>
</ul>


It also features both LDAP and regular authentication for logging in. 
<ul>
<li>-For LDAP, just substitute your active directory IP address and Port for access. </li>
  <ul>
    <li>EX: ("ip.address", Port)</li>
    <li>username: jdoe</li>
    <li>password: ADpassword</li>
  </ul>
</ul>
    

More admin features coming soon! 
 <ul>
  <li>Editing employees time on the front-end</li>
  <li>Choosing specific to-from dates for pay periods</li>
  <li>email notifications of employees who haven't checked in</li>
 </ul>
 
 
