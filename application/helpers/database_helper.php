<?php
function install_database()
{
	$values = array();
$values[] = "Install script started, 0/13 Steps done.";
$username = 'root';
$password = '';
$host = 'localhost';
$database = 'joelklinglerEventDataBase';
$conn = new mysqli($host, $username, $password);
$sql = 'CREATE DATABASE ' . $database . ';';
$sqlDrop = 'DROP DATABASE IF EXISTS ' . $database . ';';
if(!$conn->connect_error)
{
	if($conn->query($sqlDrop) === TRUE)
	{
		$values[] = "<p>Database Deleted";
	}
	$values[] = "<br />(0/13) Connected to localhost";
	if($conn->query($sql) === TRUE)
	{
		$values[] = "<br />(1/13) Database '" . $database . "' created.";
		$conn = new mysqli('localhost', $username, '', $database); 
		$sql = 'CREATE TABLE Users (
			Id INT(6) AUTO_INCREMENT PRIMARY KEY,
			Name VARCHAR(60) NOT NULL,
			FirstName VARCHAR(60) NOT NULL,
			Email VARCHAR(60) NOT NULL,
			Telephone VARCHAR(30),
			Password VARCHAR(60) NOT NULL)';
		if($conn->query($sql) === TRUE)
		{
			$values[] = "<br />(2/13) Table 'Users' created.";
			$sql = 'CREATE TABLE Roles (
			Id INT(6) AUTO_INCREMENT PRIMARY KEY,
			ShortName VARCHAR(60) NOT NULL)';
			if($conn->query($sql) === TRUE)
			{
				$values[] = "<br />(3/13) Table 'Roles' created.";
				$sql = 'CREATE TABLE UserRoles (
					IdUser INT(6),
					IdRole INT(6),
					FOREIGN KEY (IdRole) REFERENCES Roles(Id),
					FOREIGN KEY (IdUser) REFERENCES Users(Id));';
				if($conn->query($sql) === TRUE)
				{
					$values[] = "<br />(4/13) Table 'UserRoles' created";
					$sql = 'CREATE TABLE EventType (
								Id INT(6) AUTO_INCREMENT PRIMARY KEY,
								ShortName VARCHAR(60) NOT NULL)';
					
					if($conn->query($sql) === TRUE)
					{
						$values[] = "<br />(5/13) Table 'EventType' created";
						$sql = 'CREATE TABLE Events (
									Id INT(6) AUTO_INCREMENT PRIMARY KEY,
									ShortName VARCHAR(60) NOT NULL,
									Description TEXT NOT NULL,
									Image VARCHAR(60),
									TicketCost VARCHAR(60) NOT NULL,
									TicketQuantity INT(6) NOT NULL,
									TicketsLeft INT(6),
									Location VARCHAR(60),
									EventStartDate VARCHAR(60) NOT NULL,
									EventEndDate VARCHAR(60) NOT NULL,
									Artist VARCHAR(60) NOT NULL,
									isHot BOOLEAN,
									IdUser INT(6) NOT NULL,
									FOREIGN KEY (IdUser) REFERENCES Users(Id))';
						if($conn->query($sql) === TRUE)
						{
							$values[] = "<br />(6/13) Table 'Events' created";
							$sql = 'CREATE TABLE Ticket (
								Id INT(6) AUTO_INCREMENT PRIMARY KEY,
								IdUser INT(6) NOT NULL,
								IdEvent INT(6) NOT NULL,
								FOREIGN KEY (IdUser) REFERENCES Users(Id),
								FOREIGN KEY (IdEvent) REFERENCES Events(Id))';
							if($conn->query($sql) === TRUE)
							{
								$values[] = "<br /> (7/13) Table 'Tickets' created";
								$sql = 'CREATE TABLE EventTypes (
									Id INT(6) AUTO_INCREMENT PRIMARY KEY,
									IdEvent INT(6),
									IdEventType INT(6),
									FOREIGN KEY (IdEvent) REFERENCES Events(Id),
									FOREIGN KEY (IdEventType) REFERENCES EventType(Id));';
								if($conn->query($sql) === TRUE)
								{
									$values[] = "<br />(7/13) Table 'EventTypes' created"								;
									$sql = "INSERT INTO users (Name, FirstName, Email, Telephone, Password) VALUES ('Klingler', 'Dewi', 'dewi@klingler.com', '0799259493', '".sha1(trim(strtolower('123')))."'),('Klingler', 'Gina', 'gina@klingler.com', '0799250493', '".sha1(trim(strtolower('123')))."');";
									if($conn->query($sql) === TRUE)
									{
										$values[] = "<br />(8/13) Test User's created.";
										$sql = "SELECT Id FROM users WHERE Name like 'Kunde';";
										$result = $conn->query($sql);
										$userId = $result->fetch_assoc();
        								$sql = "INSERT INTO roles (ShortName) VALUES ('Veranstalter'), ('Kunde');";
        								if($conn->query($sql) === TRUE)
        								{
        									$values[] = "<br />(9/13) Test Roles created";
    	    								$kundeId = "SELECT Id FROM users WHERE FirstName like 'Dewi';";
	        								$veranstalterId = "SELECT Id FROM users WHERE FirstName like 'Gina';";
        									$kundeId = $conn->query($kundeId)->fetch_assoc();
        									$veranstalterId = $conn->query($veranstalterId)->fetch_assoc();
        									$kundeRoleId = "SELECT Id FROM roles WHERE ShortName like 'Veranstalter';";
        									$veranstalterRoleId = "SELECT Id FROM roles WHERE ShortName like 'Kunde';";
        									$kundeRoleId = $conn->query($kundeRoleId)->fetch_assoc();
        									$veranstalterRoleId = $conn->query($veranstalterRoleId)->fetch_assoc();
        									$sql = "INSERT INTO userroles (IdUser, IdRole) VALUES (". $kundeId["Id"] . ", ".$kundeRoleId["Id"]."), (".$veranstalterId["Id"].",".$veranstalterRoleId["Id"].");";
        									if($conn->query($sql) === TRUE)
        									{
    	    									$values[] = "<br />(10/13) Userroles set.";
	        									$sql = "INSERT INTO eventtype (ShortName) VALUES ('Party'),('Festival'),('Konzert'),('Musical'),('Kino'),('Essen / Gastronomie'),('Kunst / Kultur'),('Sport');";
        										if($conn->query($sql) === TRUE)
        										{
        											$values[] = "<br />(11/13) Eventtypes set.";
        											$sql = "CREATE TABLE Orders (
													Id INT(6) AUTO_INCREMENT PRIMARY KEY,
													IdUser INT(6) NOT NULL,
													IdEvent INT(6) NOT NULL,
													IdTicket INT(6),
													CreditCardNumber VARCHAR(30),
													OrderDate TIMESTAMP,
													FOREIGN KEY (IdUser) REFERENCES users(Id),
													FOREIGN KEY (IdEvent) REFERENCES events(Id),
													FOREIGN KEY (IdTicket) REFERENCES ticket(Id));";
													if($conn->query($sql) === TRUE)
													{
														$values[] = "<br />(12/13) Table 'Orders' created";
														// Create Test-Events
														$sql = "INSERT INTO events (ShortName, Description, Image, TicketCost, TicketQuantity, TicketsLeft, Location, EventStartDate, EventEndDate, Artist, isHot, IdUser) 
														VALUES ('Qlimax 2016','Once again, Q-dance is calling out to all freaks! Let’s end 2015 together with your fellow ravers and celebrate the start of an unforgettable 2016.','qlimax.png','250','40000','10000',
														'Netherlands','10.10.2016','11.10.2016','Q-Dance',0,1), 
														('Electric Love Festival','Dieses unglaubliche Publikum ist einzigartig, da ist sich selbst die Weltelite der DJ Szene einig. Kombiniert mit der wunderschönen Location im Seenland des Salzkammergutes, inmitten der Natur und der Liebe zum Detail, hält das Electric Love Festival heuer bereits zum dritten Mal Einzug','el.jpeg','200','130000','30000',
														'Salzburg, Österreich','06.07.2016','09.07.2016','Revolution Event',0,1) , 
														('Defqon 1 Weekend Festival','Weeeee are the champions, my friends! And we will keep on fighting till the eeeeend...','defqon1.jpg','500','200000','100000',
														'Netherlands','27.07.2016','30.07.2016','Q-Dance',0,1),
														('Openair St.Gallen 2016','Das OpenAir findet 2016 zum 40. Mal statt! Dieses Jubiläum werden wir gebührend feiern. Wie und wo, das erfährst du in den kommenden Monaten.','oasgLogo.jpg','350','30000','17000',
														'St.Gallen, Sittertobel','29.06.2016','03.07.2016','OASG OK',0,1);";
														if($conn->query($sql) === TRUE)
														{
															$values[] = '<br />(13/13) Testdata created</p>';
														}
														else
														{
															$values[] = $conn->error;
														}
													}
													else
													{
														$values[] = $conn->error;
													}
        										}
        										else
        										{
        											$values[] = $conn->error;
        										}
        									}
        									else
        									{
        										$values[] = $conn->error;
        									}
        								}
    	    							else
	        							{
        									$values[] = $conn->error;
        								}
									}
									else
									{
										$values[] = $conn->error;
									}
								}
								else
								{
									$values[] = $conn->error;
								}
							}
							else
							{
								$values[] = $conn->error;
							}
						}
						else
						{
							$values[] = $conn->error;
						}
					}
					else
					{
						$values[] = $conn->error;
					}
				}
				else
				{
					$values[] = $conn->error;
				}
			}
			else
			{
				$values[] = $conn->error;
			}
		}
		else
		{
			$values[] = $conn->error;
		}
	}
	else
	{
		$values[] = $conn->error;
	}
}
else
{
	$values[] = $conn->error;
}
return $values;
}
?>