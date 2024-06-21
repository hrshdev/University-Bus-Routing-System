# University Bus Routing and Scheduling System

## Project Overview
The University Bus Routing and Scheduling System is designed to improve the efficiency of the University of Vavuniya's bus system by leveraging advanced algorithms and machine learning techniques. This project aims to optimize bus routes and schedules to reduce travel time and overcrowding, and implement a dynamic system that adapts to real-time changes. A user-friendly web application will be provided for students to access updated bus schedules and routes.

## Table of Contents
1. [Introduction](#introduction)
2. [Problem Identification](#problem-identification)
3. [Requirements Collection](#requirements-collection)
4. [Algorithm Design](#algorithm-design)
5. [Space and Time Complexity Analysis](#space-and-time-complexity-analysis)
6. [Proposed AI/ML/DL Algorithm for Efficiency Improvement](#proposed-aimldl-algorithm-for-efficiency-improvement)
7. [Comparison of Basic and Intelligent Algorithms](#comparison-of-basic-and-intelligent-algorithms)
8. [Conclusion](#conclusion)
9. [Contributions](#contributions)
10. [Setup Requirements and Instructions](#setup-requirements-and-instructions)

## Introduction
A University Bus Routing and Scheduling System is designed to efficiently manage the transportation needs of students, faculty, and staff within a university. This system ensures that buses are routed and scheduled in a way that maximizes convenience and minimizes travel time, while also considering cost-effectiveness and operational efficiency.

## Problem Identification
The University of Vavuniya currently faces several challenges with its bus transportation system:
- Inefficient routes leading to increased travel times.
- Inconsistent bus schedules causing delays and missed connections.
- Insufficient coverage of high-demand areas.
- Poor real-time tracking and lack of dynamic adjustments.

## Requirements Collection
### Requirements Collection
To address the identified problems, the following requirements were gathered through surveys and stakeholder meetings:
- Efficient route planning to cover all essential locations.
- Timetable creation that balances frequency and demand.
- Real-time bus tracking and dynamic scheduling adjustments.
- Cost-effective resource allocation including bus fleet and driver management.

### Problem Solving Approach
1. **Route Planning**: Map all critical locations within and around the university.
2. **Scheduling**: Develop timetables considering peak and off-peak times.
3. **Real-Time Monitoring**: Implement GPS and tracking systems.
4. **Resource Allocation**: Optimize bus fleet and driver schedules to ensure coverage and compliance.

## Algorithm Design
### Basic Algorithm
1. Identify all stops and map routes covering essential locations.
2. Use historical data to estimate demand for each stop.
3. Create initial timetables with more frequent services during peak hours.
4. Allocate buses and drivers based on the timetables and expected demand.
5. Implement GPS tracking on all buses for real-time monitoring.

## Space and Time Complexity Analysis
### Space Complexity
- **Route Mapping**: \(O(N^2)\) where \(N\) is the number of stops.
- **Timetable Storage**: \(O(T)\) where \(T\) is the number of time slots in the schedule.
- **GPS Data**: \(O(B)\) where \(B\) is the number of buses.

### Time Complexity
- **Route Planning**: \(O(N^2)\) due to mapping between stops.
- **Timetable Creation**: \(O(N \cdot T)\) for creating schedules for each stop and time slot.
- **Real-Time Adjustments**: \(O(1)\) for each adjustment, assuming efficient data handling.

## Proposed AI/ML/DL Algorithm for Efficiency Improvement
### Machine Learning Algorithm
We propose using a Reinforcement Learning (RL) algorithm to optimize bus routes and schedules dynamically.
1. Define the state space including current bus locations, passenger demand, and traffic conditions.
2. Define actions as route changes, schedule adjustments, and bus dispatches.
3. Implement a reward system based on minimizing travel time and maximizing coverage.
4. Use Q-Learning to train the model, allowing the system to learn optimal actions over time.

## Comparison of Basic and Intelligent Algorithms
### Basic Algorithm
- **Efficiency**: Limited to predefined routes and schedules.
- **Adaptability**: Static, requires manual adjustments for changes.
- **Cost**: Lower initial cost but higher long-term operational inefficiencies.

### Intelligent Algorithm
- **Efficiency**: Learns and adapts to optimize routes and schedules dynamically.
- **Adaptability**: High, adjusts in real-time to changes in demand and traffic.
- **Cost**: Higher initial cost for development and training but lower operational costs due to improved efficiency.

## Conclusion
Implementing a University Bus Routing and Scheduling System at the University of Vavuniya can significantly improve transportation efficiency, reduce travel time, and enhance user convenience. By leveraging AI and machine learning techniques, the system can dynamically adapt to changing conditions, providing a robust and cost-effective solution.

## Contributions
- **Problem Identification**: V. Harson (2020/ICT/59)
- **Requirements Collection**: S. Venuka (2020/ICT/70)
- **Algorithm Design**: K. R. Insafa (2020/ICT/80)
- **Complexity Analysis**: S. F. Sumaiya (2020/ICT/62)
- **AI/ML/DL Proposal**: C. V. Sushmitha (2020/ICT/53)
- **Comparison Analysis**: M. J. Ruzla (2020/ICT/82)

## Setup Requirements and Instructions

### Prerequisites
- A web server (e.g., Apache, Nginx)
- HTML, CSS, JavaScript
- Any server-side scripting language (e.g., PHP, Node.js)

### Installation

1. **Clone the repository**
    ```sh
    git clone https://github.com/username/university-bus-routing.git
    cd university-bus-routing
    ```

2. **Set up your web server**
    - Place the project files in the web server's root directory.
    - Ensure your web server is configured to serve the HTML files.

3. **Configure your server-side scripting**
    - If using PHP, ensure PHP is installed and configured on your server.
    - For other scripting languages, follow the respective setup instructions.

### Running the Application
1. **Start your web server**
    - Ensure your web server is running.
    - For Apache, you might use:
      ```sh
      sudo systemctl start apache2
      ```
    - For Nginx, you might use:
      ```sh
      sudo systemctl start nginx
      ```

2. **Access the application**
    - Open a web browser and go to `http://localhost` or your server's IP address.

### Configuration
- **Server Configuration**: Adjust your web server settings as needed in the configuration files (e.g., `httpd.conf` for Apache, `nginx.conf` for Nginx).
- **Environment Variables**: Use environment variables for any sensitive information.

### Deployment
Refer to the deployment documentation specific to your server environment (e.g., shared hosting, VPS).

### Testing
Ensure all pages are loading correctly and links are functioning as expected.

---

This README provides an overview and setup instructions for the University Bus Routing and Scheduling System. For any issues or contributions, please refer to the [CONTRIBUTING.md](CONTRIBUTING.md) file.
