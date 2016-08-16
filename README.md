# Degrees of GitHub Separation

Calculate the shortest distance by project between any 2 GitHub contributors by repository path

## Install

This project uses Vagrant to provision a Virtual Machine (VM) to run the application within. Please install Vagrant and VirtualBox and then provision the VM

    vagrant up

Please install the Silex micro framework and other dependencies this projects requires using Composer from /var/www within the VM

    cd /var/www
    composer install
    
## Tests

PhpSpec and Behat are using to test the application on a unit and behavioural level. Please run the tests within the VM from /var/www

    cd /var/www
    bin/phpspec run
    bin/behat

## Operation

This API has a single endpoint which takes 2 GitHub users within the URI

    curl -X GET "http://localhost/separation/[User1]/[User2]"
    
To access the API from outside the VM please use the forwarded port 9080

    curl -X GET "http://localhost:9080/separation/[User1]/[User2]"
    
Currently only the following call returns a successful response

    curl -X GET  http://localhost:9080/separation/Stof/Seldaek
    
This should return a response either showing the path and distance between the users

    {
      "data": {
        "distance": 1,
        "path": [
          "User1/Repository"
        ]
      },
      "metadata": {
         "user1": "User1",
         "user2": "User2"
      }
    }
    
Alternatively it will show an error explaining why this is not possible
    
    {
      "error": "Path could not be found as User1 has no repositories to traverse"
    }