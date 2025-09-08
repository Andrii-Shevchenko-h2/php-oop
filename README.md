![GitHub repo size](https://img.shields.io/github/repo-size/Andrii-Shevchenko-h2/php-oop)

# Reason for this project
- This project is for me to learn PHP OOP, to learn by doing

# Project feat. classes:
- Enums (allows for dynamic adding of new "DLC" and centralized verify)
- Exceptions (Adds a web-friendly error handler with specialized logs)
- Geometry (Calculates automatically the shapes properties like area)
- Pages (Stores all the pages and their contents, deprecated)
- Router (Routes the incoming URI to the corresponding page)
- Tests (Unit tests, made for the CLI)
- User (Gives and generates some hypothetical information about user)
- New: View (to fit the MVC paradigm and further decouple interface)

Tests page
==========

*   To use the tests page, you need to adjust the URI.
*   All test-related functions are accessed via the /tests URI.

### Running Unit Tests

To run the unit tests, you must append the ?unit= query parameter to the /tests URI.

**Options:**
*   **All tests:**
    *   /tests?unit=all
*   **Specific tests:**
    *   /tests?unit=circle
    *   /tests?unit=square
    *   /tests?unit=user
*   **No test / Standard page:**
    *   /tests?unit
*   **Invalid parameter:**
    *   Any value other than the ones listed above will result in an error.

### Creating New Tests

To create a new test, you must append the ?create= query parameter to the /tests URI.
**Options:**
*   **View the test creation form:**
    *   /tests?create=new
    *   /tests?create (No value, or an empty value, defaults to showing the form)
*   **Create a test for a specific class:**
    *   /tests?create=new&new=Circle
    *   /tests?create&new=Square
*   **Create a test for a specific class with predefined variables:**
    *   /tests?create=new&new=Circle&radius=8 (or diameter, etc)
    *   /tests?create&new=Square&perimeter=78

You can add any number of parameters (e.g., area, radius) to the URL after the & to be used by the test creation logic. The system will handle these as long as they are valid.

# Github Project
Also view the [Github Project](https://github.com/users/Andrii-Shevchenko-h2/projects/1/views/1?system_template=feature_release) to see planned features and To-Dos
