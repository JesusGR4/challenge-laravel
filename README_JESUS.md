# INFORMATION ABOUT THE CHALLENGE

First, I have to thank you!, I'm learning a lot ;)

## Pre-requisites 

- VirtualBox
- Vagrant
- Postman

## Technologies 
 
- PHP 7.2
- Laravel 2.0.1
- MySQL
- PHPUnit

## Building the app


### Repo
Clone repo from https://bitbucket.org/promofarma_eng/jgarcia/src/master where you prefer 

The .env.example is useful for this test, so we have to change the name:

`mv .env.example .env`


### Homestead
First of all, we need to install VirtualBox if needed.
We are going to use Homestead, a development environment ready for developing PHP.

You must follow the instructions provided by Laravel Docu -> https://laravel.com/docs/5.8/homestead#installation-and-setup , just First steps sections (Installing The Homestead Vagrant Box & Installing Homestead)

Now, let's take a look to ~/Homestead/Homestead.yaml:
1. Change ip to --> ip: "192.168.10.10"
2. Add the following to folders section -->


`- map: /whereRepoHasBeenCloned`

   `to: /home/vagrant/code`


3. Add the following to sites section --> 

`- map: challenge.com`

   `to: /home/vagrant/code/public`
   
4. Add the following to databases section ->   

`- challenge`

Run the following where Homestead folder is:

`vagrant up`

Then run:

`vagrant ssh`

Now you will be in Homestead virtual environment :D

### Setting up

`composer update` Install dependencies

`php artisan key:generate` Generate keys

`composer require laravel/passport` Install Passport (needed for tokens)

`php artisan migrate` Create tables in database

`php artisan db:seed` Populate database

`php artisan passport:install` Create encryption keys

## Workflow
We need to use Postman for this API Calls:

### Sign up
- (POST) 192.168.10.10/api/auth/signup 

Parameters: 

{name, email, password}

Response expected: 'Usuario creado correctamente' (200)
### Login
- (POST) 192.168.10.10/api/auth/login 

Parameters: 

{email, password, remember_me = true}

In the response, we receive an access_token, save it, you'll need to add it to header Authorization like 'Beared $token' (200)


### Add to cart

- (POST) 192.168.10.10/api/cart/updateQuantity

Headers: Authorization Bearer $token

Parameters:

{id_product = 1, quantity = 2}

### Add to cart

- (POST) 192.168.10.10/api/cart/updateQuantity

Headers: Authorization Bearer $token

Parameters:

{id_product = 3, quantity = 2}

Response expected: 


### Commit buy

- (GET) 192.168.10.10/api/cart/commitBuy

Headers: Authorization Bearer $token

Response expected: Order created (200)


### Get orders

- (GET) 192.168.10.10/api/order/getOrders

Headers: Authorization Bearer $token

Response expected: all order info (200)





