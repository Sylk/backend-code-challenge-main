# Pizza Planet
Pizza Planet serves out-of-this-world pizzas made only from the freshest ingredients. In recent years they’ve quickly grown to 100 restaurant locations. To ensure each restaurant lives up to their company reputation, Pizza Planet has hired two Regional Managers who oversee 50 locations each.

The Regional Managers noticed that some of the pizza ingredients being used are not always fresh. In response, they implemented an ingredient delivery program that records whether pizza ingredients purchased and delivered to the restaurants are fresh or not.

Now the Regional Managers need reporting, and your job is to provide reporting to each Regional Manager about the freshness of the ingredients their restaurants are buying.

# Email Report
The Pizza Planet web application keeps track of ingredients that are delivered to restaurant locations. If a delivered ingredient is not fresh, the system tracks that in the delivery ingredients `is_fresh` field in the database.

Send each Regional Manager a weekly report in an email that includes information about the freshness of the ingredients purchased by the restaurants that they oversee. The report should include the following information for each restaurant the manager oversees:

* The restaurant’s number and name concatenated (ex: Restaurant #1 - Acme Falls)
* Total number of fresh ingredients
* Total number of unfresh ingredients
* Percentage of ingredients that were fresh
* A concatenated list of all of the unique ingredient names that where not fresh for each restaurant

The base project includes models, migrations and factories for the data needed (restaurants, regional managers, deliveries, products).

## Technical considerations
* The report data could be either in the email body, or attached as a CSV.
* If an email fails for any reason, it might be helpful if there were some way of keeping track of this and potentially resending the email later.
* Don’t worry too much about the look / style of the email. This can be a very simple, bare-bones email.
* While the test data set is relatively small, we would expect the production data set to be much larger, and so we will likely want to think about how your solution scales.

## Instructions
To start the challenge, create a new empty repository with an initial commit and share it with a member of the VOLTAGE development team using github, bitbucket or gitlabs.

VOLTAGE will provide a zipped folder of the Laravel web application. Spend no more than 4 hours accomplishing email report and make another commit titled "Four hour mark". VOLTAGE will be able to see that your initial commit and 4-hour commit are no more than 4 hours apart.

There are some suggestions in the README on setting up your local environment, but you can also set up your environment any way that you’d like (Homestead, Sail, Valet, etc.). Feel free to make regular commits and make comments that illustrate your thought process as you work on the prompt. Be prepared to walk us through your updates with a peer code review afterwards.

### Local Setup
You can set up this app any way you'd like (Homestead, Sail, Valet, etc.). 
The recommended environment is Laravel Sail. 

#### Laravel Sail
Using Laravel Sail requires Docker Desktop on your machine.
For more information, please see the documentation on Laravel Sail
https://laravel.com/docs/8.x/sail#introduction. 

```
cd <project>

cp .env.example .env

docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/opt \
    -w /opt \
    laravelsail/php80-composer:latest \
    composer install --ignore-platform-reqs

./vendor/bin/sail up -d

```

You can then run Sail commands from within the Sail shell.

```
sail shell
php artisan migrate:refresh --seed
```

Or you can run Sail commands from outside the container.

```
sail artisan migrate:refresh --seed
```

## Data
To set up the data for the app, you can run the migrations and seeder.

```
sail artisan migrate:refresh --seed
```

## Tests
Tests can be run using.

```
sail artisan test
```
