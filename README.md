
# OpenHAB Data Fetcher README

## Overview

This Laravel application fetches sensor data from an OpenHAB installation and saves it to a JSON file. It is designed to run within a VPN-secured network environment, ensuring secure remote access to the OpenHAB installation.

## Prerequisites

- PHP 7.4 or higher
- Composer
- Laravel 8
- Access to an OpenHAB installation
- A VPN client supporting OpenVPN

## Getting Started

### Step 1: Setup Environment

1. **Clone the repository** to your local machine or server.
2. **Install dependencies** using Composer by running `composer install` in the project directory.
3. **Copy `.env.example` to `.env`** and configure your environment settings, including database connections if necessary.
4. **Generate an application key** using `php artisan key:generate`.

### Step 2: Configure VPN

1. **Import the `anastasiou.ovpn` file** into your VPN client. This file contains the configuration needed to connect to the network where the OpenHAB installation is located.
2. **Connect to the VPN** to securely access the OpenHAB installation.

### Step 3: Run the Application

1. **Start the Laravel server** using `php artisan serve`. This will host your application locally.
2. **Access the API endpoint** `/api/sensor-data` to fetch sensor data from OpenHAB and save it as a JSON file.

## Fetching Sensor Data

- The data can be fetched by accessing `http://your-laravel-app-domain/api/sensor-data`.
- The JSON file is accessible at `http://your-laravel-app-domain/storage/sensor_data.json`.

## Important Notes

- Ensure the OpenHAB installation is accessible over the VPN network.
- The IP address in the `SensorDataController` may need to be updated to match your OpenHAB installation's address.
- The `storage/app/public` directory must be writable by the Laravel application.
