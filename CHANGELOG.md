# Changelog

All notable changes to the package will be documented in this file.

## v1.0.0 - 2024-08-06

- Add BodyParams for use in POST, PUT and PATCH requests
- Fix QueryParams::setOrderBy()
- Add more unit tests
- Improve README documentation

## v0.2.0 - 2024-08-02

- Widen PHP version support to:
  - 7.4
  - 8.0
  - 8.1
  - 8.2
  - 8.3
- Add library exceptions
  - Wrap connection errors in a custom exception
  - Throw restful exceptions for API error responses
  - Add config var to disable restful exceptions

## v0.1.0 - 2024-07-24

- Initial PHP 8.2 beta release
- Add core logic for making API requests and working with responses
- Add services for managing client data
