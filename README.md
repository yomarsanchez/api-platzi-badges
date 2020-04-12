<p align="left">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Platzi Badges API

Rest API for the Platzi Badges project of the React course.

- [Curso de React.js](https://platzi.com/clases/react).

## API Routes

Crud **Badges**

| Endpoint              | Method     | Name           | Description                          |
| --------------------- | ---------- | -------------- | ------------------------------------ |
| `/api/badges`         | `GET|HEAD` | badges         | Retrieve all the badges              |
| `/api/badges`         | `POST`     | badges.store   | Create a new resource of badge       |
| `/api/badges/{badge}` | `GET|HEAD` | badges.show    | Retrieve an specific badge with `id` |
| `/api/badges/{badge}` | `PUT`      | badges.update  | Update an existing badge             |
| `/api/badges/{badge}` | `DELETE`   | badges.destroy | Remove a badge                       |

## License

The project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
