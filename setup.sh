#!/bin/bash

echo "Setting up your Laravel project..."

# Check for Composer
if ! [ -x "$(command -v composer)" ]; then
  echo "Error: Composer is not installed. Please install Composer and try again." >&2
  exit 1
fi

# Check for Node.js and npm
if ! [ -x "$(command -v npm)" ]; then
  echo "Error: Node.js and npm are not installed. Please install them and try again." >&2
  exit 1
fi

echo "Installing Composer dependencies..."
composer install
if [ $? -ne 0 ]; then
  echo "Failed to install Composer dependencies. Exiting..."
  exit 1
fi

echo "Installing npm dependencies..."
npm install
if [ $? -ne 0 ]; then
  echo "Failed to install npm dependencies. Exiting..."
  exit 1
fi

echo "Building frontend assets..."
npm run build
if [ $? -ne 0 ]; then
  echo "Failed to build frontend assets. Exiting..."
  exit 1
fi

echo "Setup complete. You can now run the Laravel application."
exit 0
