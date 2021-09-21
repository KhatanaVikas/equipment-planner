# Equipment-Planner

System Requirements : 
1. docker installed in your local pc.

Steps to run the app:
1. `make init-local`
2. Visit the app at `localhost:8080`
3. To update the sample data : Update the `src/DataFixtures/AppFixtures.php` and run   `make migrations-update`.
4. To acces the mysql via commandline : 
    a. `docker exec -it symfony-docker-boilerplate_mysql8-service_1 bash`
    b. mysql -uroot -ppassword
    c. use centraldb;
    d. show tables;




Extra Notes : 
1. TO create a symfony skeleton project
    a. Go inside the php container. `docker exec -it symfony-docker-boilerplate_php74-service_1 bash`
    b. Run the command to create skeleton project `composer create-project symfony/skeleton .`
2. For creating database : `php bin/console doctrine:database:create`
3. For creating migrations  : `php bin/console doctrine:migrations:migrate`
4. php bin/console doctrine:database:drop --force
5. php bin/console doctrine:database:create