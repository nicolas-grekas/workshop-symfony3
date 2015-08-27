# Migration Workshop

## Exercises

### Configuration

* Twig form themes setting.
* Enable deprecation error logging in PHP and `app/config/config_dev.yml` file.
* Remove usage of `pattern` key in `routing.yml` files.

### Controllers

* Inject the request into actions instead of pulling it from the base class.
* Use the new `security.authentication_utils` service.
* Remove usage of the `security.context` service.
* Remove usage of the `request` service.

### Views

* Remove usage of `app.security` global variables.
* Remove usage of `{% render %}` Twig tag.
* Remove usage of `form_enctype()` Twig function.

### Forms

* Remove usage of `bind()` and `isBound()` methods.
* Update usage of `setDefaultOptions()` method to `configureOptions()` method.

### Dependency Injection

* Remove services class as global parameters.
* Inject `request_stack` service instead of `request` service.
* Remove usage of `request` scope.
* Remove usage of `factory-*` attributes in services definitions.

### Validation

* Remove usage of `methods` option on `Callback` constraint.
* Update usage of building violation errors on `ExecutionContext`.

### Commands

* Remove usage of the `table` helper.
* Remove usage of the `progress` helper.
