# Diploma Project Web Component

This is the web component of my thesis project. The complete documentation of the project can be accessed [here](https://drive.google.com/file/d/1jPP__q5RKWWyLzr7Srk6aSsLRF3sOD1q/view?usp=sharing).

## Project Description

The final component of this project is a web interface that extracts data from the database and displays it in a web application. This allows users to access the information collected by sensors through the web application.

For this application, I used the Symfony framework, which follows the MVC (Model-View-Controller) architecture. The database used is MariaDB. Data insertion into the sensor data table comes via a serial cable from the real sensor setup. This insertion is handled with the help of Node-RED.

This application plays a crucial role in the project because it significantly aids in visualizing the data transmitted via CAN in a much more user-friendly manner, replacing the inelegant visualization form provided by the serial monitor available in the Arduino IDE.

Additionally, this component was essential in achieving the project's objective of developing a market-ready product for the automotive industry.

## Key Features

- **MVC Architecture**: Built using the Symfony framework, following the Model-View-Controller design pattern.
- **Database**: Utilizes MariaDB for data storage.
- **Data Insertion**: Sensor data is inserted into the database via a serial cable from the sensor setup, facilitated by Node-RED.
- **Data Extraction**: Retrieves data from the database efficiently.
- **User Access**: Allows users to view sensor data through a web interface.
- **Enhanced Visualization**: Replaces the basic serial monitor visualization with a more sophisticated web-based display.
- **Automotive Focus**: Designed to meet the needs of the current automotive market.

For more detailed information, refer to the full documentation [here](https://drive.google.com/file/d/1jPP__q5RKWWyLzr7Srk6aSsLRF3sOD1q/view?usp=sharing).
