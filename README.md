# Trustindex – Company Review Mini Application

A Symfony 7 based mini review-aggregator web application inspired by real-world Trustindex functionality.  
Users can submit public reviews for companies, browse reviews, and view aggregated company statistics including average ratings and review counts.

## Features

- Submit public company reviews
- Symfony Forms + Validation
- Review listing with star ratings
- Detailed review pages
- Company statistics page with:
  - average rating
  - review count
  - sorting by highest rated companies
- Doctrine ORM with migrations
- Repository-based query logic
- PHPUnit unit, integration and functional tests
- Bootstrap based responsive UI
- Clean Code + DRY principles

## Tech Stack

- PHP 8.2+
- Symfony 7
- Doctrine ORM
- Twig
- PHPUnit
- Docker
- PostgreSQL

## Extra Features

- Company name search
- Responsive modern UI
- Dockerized development environment
- Integration test

## Installation

1. If not already done, [install Docker Compose](https://docs.docker.com/compose/install/) (v2.10+)
2. Clone this repository
3. Run `docker compose build --pull --no-cache` to build fresh images
4. Run `docker compose up -d` to set up the container and the Symfony project
5. Set up database
  - docker compose exec php php bin/console doctrine:database:create
  - docker compose exec php php bin/console doctrine:migrations:migrate
7. Set up test database:
   - docker compose exec php php bin/console doctrine:migrations:migrate --env=test
   - docker compose exec php php bin/console doctrine:migrations:migrate
8. Open `https://localhost` in your favorite web browser and [accept the auto-generated TLS certificate](https://stackoverflow.com/a/15076602/1352334)
9. Run tests: docker compose exec php php bin/phpunit



## Working Diary

| Task | Description | Time Spent |
|---|---|---|
| Project initialization | Symfony project setup, Docker environment configuration, dependency installation, repository initialization | 35 min |
| Database configuration | PostgreSQL configuration, Doctrine setup, environment variables, database connection troubleshooting | 20 min |
| Review entity implementation | Created Review entity with PHP attribute Doctrine mapping, timestamps, validation rules | 35 min |
| Doctrine migrations | Generated and executed database migrations, configured test database | 15 min |
| Review repository | Implemented custom ReviewRepository methods for statistics, aggregation and sorting logic | 30 min |
| Review submission form | Implemented Symfony Form (ReviewType), validation handling, flash messages | 30 min |
| Review listing page | Created homepage review listing with Twig templates, Bootstrap styling and star ratings | 35 min |
| Review details page | Implemented detailed review page with dedicated route and controller action | 15 min |
| Company statistics page | Implemented `/companies` page with aggregated review counts and average ratings | 30 min |
| Search functionality | Added company name search functionality with filtering using javascript | 20 min |
| UI improvements | Responsive layout, reusable Twig components, base layout cleanup, UX improvements | 30 min |
| Automated timestamps | Added automatic `created_at` and `updated_at` handling | 10 min |
| Unit testing | Implemented repository unit test for rating validation | 25 min |
| Functional testing | Implemented functional tests for review submission and page rendering | 25 min |
| Integrational testing | Implemented integrational test for average rate calculation and ordering | 25 min |
| Documentation | README creation, setup instructions, command documentation, working diary | 20 min |

### Total Estimated Time

**~6 hours**

## Security Disclaimer

For ease of setup and testing, this repository includes predefined `.env` variables with default values.

These values are provided for local development only and must not be used in production. In a real deployment, all sensitive configuration values, such as database credentials, application secrets, API keys, and tokens, should be replaced with secure environment-specific values and stored outside the repository.

## Credits

Original docker container created by [Kévin Dunglas](https://dunglas.dev), co-maintained by [Maxime Helias](https://twitter.com/maxhelias) and sponsored by [Les-Tilleuls.coop](https://les-tilleuls.coop).
>>>>>>> 17ff9624ff4d2a557ca2c340f178d05a12c46a1a
